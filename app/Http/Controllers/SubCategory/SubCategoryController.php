<?php

namespace App\Http\Controllers\SubCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\SubCategory\SubCategoryService;

class SubCategoryController extends Controller
{
    public function __construct(
        protected SubCategoryService $subCategoryService,
        protected CategoryRepositoryInterface $categoryRepository
    ) {}

    public function index(Request $request)
    {
        $subCategories = $this->subCategoryService->getAll($request);
        return view('subCategory.index')->with([
            'subCategories' => $subCategories
        ]);
    }

    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('subCategory.create')->with(['categories' => $categories]);
    }

    public function store(Request $request)
    {

        $response = $this->subCategoryService->store($request);

        if ($response == 1) {
            return redirect()->route('subCategories.index')->withSuccess('New Data is added successfully');
        } else {
            return redirect()->route('subCategories.create')->withError('Something wrong');
        }
    }

    public function edit($uuid)
    {
        $subCategory = $this->subCategoryService->getDataByUuid($uuid);
        $categories = $this->categoryRepository->all();
        return view('subCategory.edit')->with([
            'subCategory' => $subCategory,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $uuid)
    {
        $response = $this->subCategoryService->update($request, $uuid);

        if ($response == 1) {

            return redirect()->route('subCategories.index')->withSuccess('Data Updated Successfully.');
        } else {
            return redirect()->route('subCategories.index')->withError('Something wrong');
        }
    }

    public function destroy($uuid)
    {
        $response = $this->subCategoryService->delete($uuid);

        if ($response == 1) {

            return redirect()->route('subCategories.index')->withSuccess('Data Deleted Successfully.');
        } else {
            return redirect()->route('subCategories.index')->withError('Something wrong');
        }
    }
}
