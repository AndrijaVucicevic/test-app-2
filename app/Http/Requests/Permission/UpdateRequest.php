<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'guard_name' => [
                'required',
                'string',
                'max:255',
                Rule::in(['web', 'api']),
                function ($attribute, $value, $fail) {
                    $permission = $this->route('permission');

                    if (Permission::where('name', $permission->name)
                        ->where('guard_name', $value)
                        ->where('id', '<>', $permission->id)
                        ->exists()
                    ) {
                        $fail(__('validation.unique', ['attribute' => 'guard name']));
                    }
                },
            ],
        ];
    }

    protected function prepareForValidation()
    {
        // $this->merge(['permission' => $this->route('permission')]);
    }
}
