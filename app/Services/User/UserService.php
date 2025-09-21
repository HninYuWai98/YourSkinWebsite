<?php

namespace App\Services\User;

use Exception;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\User\UserRepositoryInterface;
use App\Foundations\Exceptions\FatalErrorException;
use App\Foundations\Exceptions\CustomGeneralException;
use App\Foundations\Exceptions\NotFoundResourceException;
use Illuminate\Support\Facades\Hash;

class UserService extends CommonService
{
    public function __construct(protected UserRepositoryInterface $userRepository) {}


    public function getAll($request): mixed
    {

        $params = $request->all();

        $params = array_merge($params, [
            'order_by' => ['id' => 'desc']
        ]);

        $dealerGroups = $this->userRepository->all($params);

        return $dealerGroups;
    }


    public function store(Request $request): mixed
    {
        $input = $request->only(
            $this->userRepository->connection()->getFillable()
        );

        try {

            DB::beginTransaction();

            $this->userRepository->insert($input);

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
        $category = $this->userRepository->getDataByUuid($uuid);

        if (! $category) {
            throw new NotFoundResourceException();
        }

        return $category;
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundResourceException
     */
    public function getDatayById($id): mixed
    {
        $data = $this->userRepository->getDataById($id);

        if (!$data) {
            throw new NotFoundResourceException();
        }

        return $data;
    }

    public function update(Request $request, $uuid): mixed
    {
        $request = $request->only(
            $this->userRepository->connection()->getFillable()
        );

        $input = array_merge($request, [
            'password' => Hash::make($request['password']),
        ]);

        $data = $this->getDataByUuid($uuid);

        try {
            DB::beginTransaction();

            $this->userRepository->update($input, $data->id);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            throw new FatalErrorException($exception->getMessage());
        }

        return 1;
    }

    public function delete($uuid)
    {
        try {

            DB::beginTransaction();

            $this->inActiveStatus($uuid);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            return 500;
        }

        return 1;
    }

    public function inActiveStatus($uuid)
    {
        $data = $this->userRepository->getDataByUuid($uuid);

        if (!$data) {
            throw new FatalErrorException('Data Not Found');
        }

        try {
            DB::beginTransaction();

            $input['is_active'] = 0;

            $this->userRepository->update($input, $data->id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            throw new CustomGeneralException('Something went wrong');
        }
        return 1;
    }
}
