<?php

namespace App\Http\Controllers\Admin\Permissions;

use App\Data\DataTableParamsData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\CreateRequest;
use App\Http\Requests\Permission\UpdateRequest;
use App\Http\Resources\PermissionResource;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class IndexController extends Controller
{
    public function __construct(
        private readonly PermissionRepositoryInterface $permissionRepository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.permissions.index');
    }

    public function getData(Request $request)
    {
        $params = DataTableParamsData::fromRequest($request);
        $data = $this->permissionRepository->table($params);

        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {
            $permission = Permission::create($request->validated());
            // return response()->json(PermissionResource::make($permission), Response::HTTP_CREATED);
            return redirect()->route('permissions.index')->with('success', __('messages.data_saved'));
        } catch (\Exception $e) {
            return response()->json(['error' => __('messages.data_not_saved')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return response()->json(PermissionResource::make($permission));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $html = view('admin.permissions.edit', ['permission' => $permission])->render();

        // Vratite JSON odgovor sa renderovanim HTML-om
        return response()->json([
            'html' => $html
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Permission $permission)
    {
        try {
            $permission->update($request->validated());
            return response()->json(['message' => __('messages.data_saved')], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['generalError' => __('messages.data_not_saved')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {
            DB::transaction(function () use ($permission) {
                $permission->roles()->detach();
                $permission->users()->detach();

                $permission->delete();
            });

            return response()->json([], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['generalError' => __('messages.data_not_saved')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
