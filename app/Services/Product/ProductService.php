<?php

namespace App\Services\Product;

use Exception;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Foundations\Exceptions\FatalErrorException;
use App\Foundations\Exceptions\CustomGeneralException;
use App\Foundations\Exceptions\NotFoundResourceException;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductService extends CommonService
{
    public function __construct(protected ProductRepositoryInterface $productRepository) {}

    /**
     * @param $request
     * @return mixed
     */
    public function getAll($request): mixed
    {

        $params = $request->all();

        $params = array_merge($params, [
            'with' =>
            [
                'subCategory',
                'brand',
                'created_user:id,name',
                'modified_user:id,name',
            ],
            'order_by' => ['id' => 'desc']
        ]);

        $dealerGroups = $this->productRepository->all($params);

        return $dealerGroups;
    }


    public function store(Request $request): mixed
    {
        $input = $request->only(
            $this->productRepository->connection()->getFillable()
        );

        $input = array_merge($input, [
            'image' => uploadFilePath($request->file('image'), null, 'products'),
            'created_by' => auth()->user()->id,
            'modified_by' => auth()->user()->id
        ]);

        try {

            DB::beginTransaction();

            $this->productRepository->insert($input);

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
        $data = $this->productRepository->getDataByUuid($uuid);

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
        $data = $this->productRepository->getDataById($id);

        if (!$data) {
            throw new NotFoundResourceException();
        }

        return $data;
    }

    public function update(Request $request, $uuid): mixed
    {
        $input = $request->only(
            $this->productRepository->connection()->getFillable()
        );

        $data = $this->getDataByUuid($uuid);

        $input = array_merge($input, [
            'image' => uploadFilePath($request->file('image'), $data->image, 'products'),
            'modified_by' => auth()->user()->id
        ]);

        try {
            DB::beginTransaction();

            $this->productRepository->update($input, $data->id);

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
        $data = $this->productRepository->getDataByUuid($uuid);

        if (!$data) {
            throw new FatalErrorException('Data Not Found');
        }

        try {
            DB::beginTransaction();

            $input['is_active'] = 0;

            $this->productRepository->update($input, $data->id);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            throw new CustomGeneralException('Something went wrong');
        }
        return 1;
    }
}