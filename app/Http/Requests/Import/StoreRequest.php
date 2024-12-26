<?php

namespace App\Http\Requests\Import;

use App\Models\DynamicConfig;
use App\Rules\ImportTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Maatwebsite\Excel\Facades\Excel;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        $importType = $this->input('import_type');
        $array = explode('_', $importType);

        $config = DynamicConfig::where("key", $array[0])->firstOrFail();
        $permission = json_decode($config->value, true)['permission_required'];

        return auth()->user()->hasPermissionTo($permission);
    }

    public function rules()
    {
        return [
            'import_type' => ['required', new ImportTypeRule()],
            'file' => [
                'required',
                'file',
                'mimetypes:text/plain,text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                function ($attribute, $value, $fail) {
                    $extension = $value->getClientOriginalExtension();

                    if (!in_array($extension, ['csv', 'xlsx'])) {
                        $fail('The file must be a CSV or XLSX file.');
                    }
                },
            ],

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $importType = $this->input('import_type');
            $array = explode('_', $importType);

            $config = DynamicConfig::where("key", $array[0])->firstOrFail();

            // Validacija naslova fajla
            $file = $this->file('file');
            $data = Excel::toArray([], $file);
            $headers = array_values($data[0][0] ?? []);

            $fileHeaders = json_decode($config->value, true)['files'][$array[1]];

            $requiredHeaders = array_values($fileHeaders['required_headers'] ?? []);
            if (array_diff($requiredHeaders, $headers)) {

                $validator->errors()->add('import_file', 'Fajl nema potrebne naslove: ' . implode(', ', $requiredHeaders));
            }
        });
    }
}
