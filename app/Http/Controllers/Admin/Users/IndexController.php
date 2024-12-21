<?php

namespace App\Http\Controllers\Admin\Users;

use App\Data\DataTableParamsData;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class IndexController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    public function getData(Request $request)
    {
        $params = DataTableParamsData::fromRequest($request);
        $data = $this->userRepository->table($params);

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->getData();
        $user = $this->userRepository->create($data->toCreate());
        $role = Role::where('id', $request->role)->first();
        $user->assignRole($role);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->getData();
        $user->update($data->toUpdate());
        $role = Role::where('id', $request->role)->first();
        $user->roles()->sync($role);

        return redirect()->route('users.edit', ['user' => $user])->with('success', __('messages.successfuly_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message'=>__('messages.data_not_saved')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
