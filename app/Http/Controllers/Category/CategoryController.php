<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Foundations\Routing\Controller;
use App\Services\Category\CategoryService;

class CategoryController extends Controller
{

    public function __construct(
        protected CategoryService $categoryService
    ) {}

    public function index(Request $request)
    {
        $categories = $this->categoryService->getAll($request);
        return view('category.index')->with([
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('category.create');
        // return view('category.create')->with(['brands'=>$brands]);
    }

    public function store(Request $request)
    {

        $response = $this->categoryService->store($request);

        if ($response == 1) {
            return redirect()->route('categories.index')->withSuccess('New Data is added successfully');
        } else {
            return redirect()->route('categories.create')->withError('Something wrong');
        }
    }

    public function edit($uuid)
    {
        $category = $this->categoryService->getDataByUuid($uuid);
        return view('category.edit')->with([
            'category' => $category
        ]);
    }

    public function update(Request $request, $uuid)
    {
        $response = $this->categoryService->update($request, $uuid);

        if ($response == 1) {

            return redirect()->route('categories.index')->withSuccess('Data Updated Successfully.');
        } else {
            return redirect()->route('categories.index')->withError('Something wrong');
        }
    }

    public function destroy($uuid)
    {
        $response = $this->categoryService->delete($uuid);

        if ($response == 1) {

            return redirect()->route('categories.index')->withSuccess('Data Deleted Successfully.');
        } else {
            return redirect()->route('categories.index')->withError('Something wrong');
        }
    }
}
