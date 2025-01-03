<?php

namespace App\Http\Controllers\Admin\Import;

use App\Data\DataTableParamsData;
use App\Data\ImportLogData;
use App\Enums\ImportStatusEnum;
use App\Helpers\ImportConfigHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Import\StoreRequest;
use App\Http\Resources\ImportLogResource;
use App\Jobs\ImportJob;
use App\Models\DynamicConfig;
use App\Models\ImportLog;
use App\Repositories\Interfaces\ImportRepositoryInterface;
use App\Services\Import\CreateImportLogService;
use App\Services\Import\DownloadImportService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IndexContoller extends Controller
{
    public function __construct(
        private readonly CreateImportLogService $createImportLogService,
        private readonly ImportRepositoryInterface $importRepository,
        private readonly DownloadImportService $downloadImportService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = $this->importRepository->table();
        $records = ImportLogData::collection($records)->items();

        return view('admin.imports.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = ImportConfigHelper::getFiles();
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
        return redirect()->route('imports.create')->with('warning', __('messages.import_in_progress'));
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
    public function edit(ImportLog $import)
    {
        return response()->json(['importLog' => ImportLogResource::make($import)], Response::HTTP_OK);
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

    public function download(ImportLog $importLog)
    {
        if (
            !$importLog ||
            in_array(
                $importLog->status,
                [ImportStatusEnum::IN_PROGRESS->value, ImportStatusEnum::SUCCESS->value]
            )
        ) {
            return redirect()->back();
        }

        $this->downloadImportService->execute($importLog);
        return '';
    }
}
