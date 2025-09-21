<?php

namespace App\Services\Role;

use Exception;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Foundations\Exceptions\FatalErrorException;
use App\Foundations\Exceptions\CustomGeneralException;
use App\Foundations\Exceptions\NotFoundResourceException;


class RoleService extends CommonService
{
    public function __construct(protected RoleRepositoryInterface $roleRepository) {}

    /**
     * @param $request
     * @return mixed
     */
    public function getAll($request): mixed
    {

        $params = $request->all();

        $roles = $this->roleRepository->all($params);

        return $roles;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws FatalErrorException
     */
    public function store(Request $request): mixed
    {

        $input = $request->validate([
            'name' => 'required|string|min:3',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        try {

            DB::beginTransaction();

            $role = $this->roleRepository->insert($input);

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            throw new FatalErrorException($exception->getMessage());
        }

        return 1;
    }

    public function getDataByUuid(string $uuid): mixed
    {
        $data = $this->roleRepository->getDataByUuid($uuid);

        if (!$data) {
            throw new NotFoundResourceException('Data Not Found');
        }

        return $data;
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundResourceException
     */
    public function getDataById($id): mixed
    {
        $data = $this->roleRepository->getDataById($id);

        if (!$data) {
            throw new NotFoundResourceException('Data Not Found');
        }

        return $data;
    }


    public function update(Request $request, $id): mixed
    {
        $input = $request->validate([
            'name' => 'required|string|min:3',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name', // using names
        ]);

        try {
            DB::beginTransaction();

            // Update role name
            $this->roleRepository->update(['name' => $input['name']],  $id);

            $role = $this->getDataById($id);
            // Sync permissions if provided, otherwise remove all
             $permissions = $input['permissions'] ?? [];
            $role->syncPermissions($permissions);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            throw new FatalErrorException($exception->getMessage());
        }

        return 1;
    }

    public function delete($id)
    {
        try {

            DB::beginTransaction();

            $this->inActiveStatus($id);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            return 500;
        }

        return 1;
    }

    public function inActiveStatus($id)
    {
        $data = $this->roleRepository->getDataById($id);

        if (!$data) {
            throw new FatalErrorException('Data Not Found');
        }

        try {
            DB::beginTransaction();

            $input['is_active'] = 0;

            $this->roleRepository->update($input, $data->id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            throw new CustomGeneralException('Something went wrong');
        }
        return 1;
    }
}
