<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Foundations\Routing\Controller;
use App\Repositories\Role\RoleRepositoryInterface;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected RoleRepositoryInterface $roleRepository,
    ) {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {

        $users =  $this->userService->getAll($request);
        return view('user.index')->with([
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = $this->roleRepository->all();
        return view('user.create')->with(['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $response = $this->userService->store($request);

        if ($response == 1) {
            return redirect()->route('users.index')->withSuccess('New Staff is added successfully');
        } else {
            return redirect()->route('users.create')->withError('Something wrong');
        }
    }

    // public function show($id)
    // {

    //     $user = $this->userService->show($id);

    //     return view('user.show')->with(['user'=>$user]);
    // }

    public function edit($id)
    {

        $user = $this->userService->getDatayById($id);
        $roles = $this->roleRepository->all();
        return view('user.edit')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $uuid)
    {
        $response = $this->userService->update($request, $uuid);

        if ($response == 1) {
            return redirect()->route('users.index')->withSuccess('Data Updated Successfully.');
        } else {
            return redirect()->route('user.edit')->withError('Something wrong');
        }
    }

    public function destroy($uuid)
    {
        $response = $this->userService->delete($uuid);

        if ($response == 1) {

            return redirect()->route('users.index')->withSuccess('Data Updated Successfully.');
        } else {
            return redirect()->route('users.index')->withError('Something wrong');
        }

    }
}
