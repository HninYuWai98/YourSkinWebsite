<?php

namespace App\Services\Brand;

use Exception;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Foundations\Exceptions\FatalErrorException;
use App\Foundations\Exceptions\CustomGeneralException;
use App\Foundations\Exceptions\NotFoundResourceException;
use App\Repositories\Brand\BrandRepositoryInterface;

class BrandService extends CommonService
{
    public function __construct(protected BrandRepositoryInterface $brandRepository) {}


    public function getAll($request): mixed
    {

        $params = $request->all();

        $params = array_merge($params, [
            'with' =>
            [
                'created_user:id,name',
                'modified_user:id,name',
            ],
            'order_by' => ['id' => 'desc']
        ]);

        $products = $this->brandRepository->all($params);

        return $products;
    }


    public function store(Request $request): mixed
    {
        $input = $request->only(
            $this->brandRepository->connection()->getFillable()
        );

        $input = array_merge($input, [
            'image' => uploadFilePath($request->file('image'), null, 'brands'),
            'created_by' => auth()->user()->id,
            'modified_by' => auth()->user()->id
        ]);

        try {

            DB::beginTransaction();

            $this->brandRepository->insert($input);

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
        $data = $this->brandRepository->getDataByUuid($uuid);

        if (!$data) {
            throw new NotFoundResourceException();
        }

        return $data;
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundResourceException
     */
    public function getDatayById($id): mixed
    {
        $data = $this->brandRepository->getDataById($id);

        if (!$data) {
            throw new NotFoundResourceException();
        }

        return $data;
    }

    public function update(Request $request, $uuid): mixed
    {
        $input = $request->only(
            $this->brandRepository->connection()->getFillable()
        );

        $data = $this->getDataByUuid($uuid);

        $input = array_merge($input, [
            'image' => uploadFilePath($request->file('image'), $data->image, 'brands'),
            'modified_by' => auth()->user()->id
        ]);



        try {
            DB::beginTransaction();

            $this->brandRepository->update($input, $data->id);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            throw new FatalErrorException($exception->getMessage());
        }

        return 1;
    }

    public function delete($uuid): int
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

    public function inActiveStatus($uuid): int
    {
        $data = $this->brandRepository->getDataByUuid($uuid);

        if (!$data) {
            throw new FatalErrorException('Data Not Found');
        }

        try {
            DB::beginTransaction();

            $input['is_active'] = 0;

            $this->brandRepository->update($input, $data->id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            throw new CustomGeneralException('Something went wrong');
        }
        return 1;
    }
}