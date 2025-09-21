<?php

namespace App\Services\SubCategory;

use Exception;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Foundations\Exceptions\FatalErrorException;
use App\Foundations\Exceptions\CustomGeneralException;
use App\Foundations\Exceptions\NotFoundResourceException;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;

class SubCategoryService extends CommonService
{

    public function __construct(protected SubCategoryRepositoryInterface $subCategoryRepository) {}

    public function getAll($request): mixed
    {

        $params = $request->all();

        $params = array_merge($params, [
            'with' => [
                'category',
                'created_user',
                'modified_user'
            ]
        ]);

        $data = $this->subCategoryRepository->all($params);

        return $data;
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
            'category_id' => 'required|exists:categories,id'
        ]);

        try {

            DB::beginTransaction();

            $input = array_merge($input, [
                'created_by' => auth()->user()->id,
                'modified_by' => auth()->user()->id,
            ]);

            $this->subCategoryRepository->insert($input);

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
        $data = $this->subCategoryRepository->getDataByUuid($uuid);

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
        $data = $this->subCategoryRepository->getDataById($id);

        if (!$data) {
            throw new NotFoundResourceException('Data Not Found');
        }

        return $data;
    }


    public function update(Request $request, $uuid): mixed
    {
        $input = $request->only(
            [
                'name',
            ]
        );

        $data = $this->getDataByUuid($uuid);

        try {
            DB::beginTransaction();

            $this->subCategoryRepository->update($input, $data->id);

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
        $data = $this->subCategoryRepository->getDataByUuid($uuid);

        if (!$data) {
            throw new FatalErrorException('Data Not Found');
        }

        try {
            DB::beginTransaction();

            $input['is_active'] = 0;

            $this->subCategoryRepository->update($input, $data->id);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage() . " at " . __FILE__ . ' on line ' . __LINE__ . ' within the class ' . get_class());
            throw new CustomGeneralException('Something went wrong');
        }
        return 1;
    }
}
