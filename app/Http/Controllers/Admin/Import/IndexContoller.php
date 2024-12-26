<?php

namespace App\Http\Controllers\Admin\Import;

use App\Data\ImportLogData;
use App\Enums\ImportStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Import\StoreRequest;
use App\Jobs\ImportJob;
use App\Models\DynamicConfig;
use App\Models\Import;
use App\Services\Import\CreateImportLogService;
use Illuminate\Http\Request;

class IndexContoller extends Controller
{
    public function __construct(
        private readonly CreateImportLogService $createImportLogService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $importTypes = DynamicConfig::all();
        foreach ($importTypes as $record) {
            $key = $record->key;
            $files = json_decode($record->value, true)['files'];

            foreach ($files as $fileKey => $fileInfo) {
                $data[] = [
                    'key' => $key,
                    'file_key' => $fileKey,
                    'label' => __('messages.import_types.' . $key) . ' - ' . $fileInfo['label'],
                    'required_headers' => implode(',', $fileInfo['required_headers']),
                ];
            }
        }
        return view('admin.imports.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $importType = $request->input('import_type');
        $data = ImportLogData::fromRequest(
            [
                'import_type' => $importType,
                'status' => ImportStatusEnum::IN_PROGRESS->value
            ]
        );
        $newImportReport = $this->createImportLogService->execute($data);

        $config = DynamicConfig::where("key", explode('_', $importType)[0])->first();

        if (!$newImportReport) {
            return redirect()->back()->with('error', __('messages.data_not_saved'));
        }
        $file = $request->file('file');
        $filePath = storage_path('app/import/' . $newImportReport->id . '.' . $file->getClientOriginalExtension());
        file_put_contents(
            $filePath,
            file_get_contents($file->getPathname())
        );

        $newImportReport->update(['file_csv' => $filePath, 'config' => $config]);

        ImportJob::dispatch($newImportReport);
        return redirect()->route('imports.create')->with('success', __('messages.data_saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getHeaders(string $header)
    {
        $imports = dynamicConfig($header);
    }
}
