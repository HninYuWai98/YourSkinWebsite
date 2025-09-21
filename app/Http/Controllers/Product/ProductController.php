<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Models\SubCategory\SubCategory;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\SubCategory\SubCategoryRepository;
use App\Repositories\SubCategory\SubCategoryRepositoryInterface;
use App\Services\Product\ProductService;

class ProductController extends Controller
{

    public function __construct(
        protected ProductService $productService,
        protected SubCategoryRepositoryInterface $subCategoryRepository,
        protected BrandRepositoryInterface $brandRepository
    ) {}

    public function index(Request $request)
    {
        $products = $this->productService->getAll($request);

        return view('product.index')->with([
            'products' => $products,
        ]);
    }

    public function create()
    {
        $subCategories = $this->subCategoryRepository->all();
        $brands = $this->brandRepository->all();
        return view('product.create')->with([
            'subCategories' => $subCategories,
            'brands' => $brands
        ]);;
    }

    public function store(Request $request)
    {

        $response = $this->productService->store($request);

        if ($response == 1) {

            return redirect()->route('products.index')->withSuccess('Data Created Successfully.');
        } else {
            return redirect()->route('products.index')->withError('Something wrong');
        }
    }

    public function edit($uuid)
    {

        $product = $this->productService->getDataByUuid($uuid);
        $subCategories = $this->subCategoryRepository->all();
        $brands = $this->brandRepository->all();

        return view('product.edit')->with([
            'product' => $product,
            'subCategories' => $subCategories,
            'brands' => $brands
        ]);
    }

    public function update(Request $request, $id)
    {
        $response = $this->productService->update($request, $id);

        if ($response == 1) {
            return redirect()->route('products.index');
        } else {
            return redirect()->route('products.index')->withError('Something wrong');
        }
    }

    public function destroy($uuid)
    {
        $response = $this->productService->delete($uuid);

        if ($response == 1) {

            return redirect()->route('products.index')->withSuccess('Data Deleted Successfully.');
        } else {
            return redirect()->route('products.index')->withError('Something wrong');
        }
    }
}