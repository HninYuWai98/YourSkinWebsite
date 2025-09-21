<?php

namespace App\Http\Controllers\Brand;


use Illuminate\Http\Request;
use App\Services\Brand\BrandService;
use App\Foundations\Routing\Controller;

class BrandController extends Controller
{
    public function __construct(
        protected BrandService $brandService
    ) {}

    public function index(Request $request)
    {
        $brands = $this->brandService->getAll($request);
        return view('brand.index')->with([
            'brands' => $brands
        ]);
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {

        $response = $this->brandService->store($request);

        if ($response == 1) {

            return redirect()->route('brands.index')->withSuccess('Data Created Successfully.');
        } else {
            return redirect()->route('brands.index')->withError('Something wrong');
        }
    }

    public function edit($uuid)
    {

        $brand =$this->brandService->getDataByUuid($uuid);
        return view('brand.edit')->with(['brand' => $brand]);
    }

    public function update(Request $request, $id)
    {
        $response = $this->brandService->update($request, $id);

        if ($response == 1) {
            return redirect()->route('brands.index');
        } else {
            return redirect()->route('brands.index')->withError('Something wrong');
        }
    }

    public function destroy($uuid)
    {
        $response = $this->brandService->delete($uuid);

        if ($response == 1) {

            return redirect()->route('brands.index')->withSuccess('Data Deleted Successfully.');
        } else {
            return redirect()->route('brands.index')->withError('Something wrong');
        }
    }
}
