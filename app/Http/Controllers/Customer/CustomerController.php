<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerService;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(
        CustomerService $customerService
    )
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $customers = $this->customerService->customerList();

        return view('customer.index')->with(['customers'=>$customers]);
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'name'=>'required|string|min:3',
            'phone'=>'required'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/customers/', $filename);
            $data['image'] = $filename;
        }

        $customer = $this->customerService->storeCustomer($data);

        return redirect()->route('customers.index')->withSuccess('Customer Added Successfully');
    }

    public function edit($id)
    {
        $customer = $this->customerService->editCustomer($id);

        return view('customer.edit')->with(['customer'=>$customer]);

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'image'=>'nullable',
            'name'=>'required',
            'phone'=>'required'
        ]);

        $data= $request->all();

        $customer = $this->customerService->updateCustomer($data, $id);

        return redirect()->route('customers.index')->withSuccess('Customer Updated Successfully');
    }

    public function destroy($id)
    {
        $customer = $this->customerService->deleteCustomer($id);

        return redirect()->route('customers.index')->withSuccess('Customer Updated Successfully');
    }
}
