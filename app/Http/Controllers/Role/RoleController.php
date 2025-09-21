<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use App\Services\Role\RoleService;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct(
        protected RoleService $roleService
    ) {}

    public function index(Request $request)
    {
        $permissions = Permission::all();
        $roles = $this->roleService->getAll($request);
        return view('role.index')->with([
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create')->with(['permissions' => $permissions]);
        // return view('category.create')->with(['brands'=>$brands]);
    }

    public function store(Request $request)
    {

        $response = $this->roleService->store($request);

        if ($response == 1) {
            return redirect()->route('roles.index')->withSuccess('New Role is added successfully');
        } else {
            return redirect()->route('roles.create')->withError('Something wrong');
        }
    }

    public function edit($id)
    {
        $role = $this->roleService->getDataById($id);
        $permissions = Permission::all();
        return view('role.edit')->with([
            'role' => $role
        ])->with(['permissions' => $permissions]);
    }

    public function update(Request $request, $id)
    {
        $response = $this->roleService->update($request, $id);

        if ($response == 1) {

            return redirect()->route('roles.index')->withSuccess('Data Updated Successfully.');
        } else {
            return redirect()->route('roles.index')->withError('Something wrong');
        }
    }

    public function destroy($id)
    {
        $response = $this->roleService->delete($id);

        if ($response == 1) {

            return redirect()->route('roles.index')->withSuccess('Data Deleted Successfully.');
        } else {
            return redirect()->route('roles.index')->withError('Something wrong');
        }
    }
}
