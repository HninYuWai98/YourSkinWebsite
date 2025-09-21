<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerService;
use App\Services\Order\OrderService;
use App\Services\Product\ProductService;

class OrderController extends Controller
{
    protected $orderService;
    protected $customerService;
    protected $productService;

    public function __construct(
        OrderService $orderService,
        CustomerService $customerService,
        ProductService $productService
    )
    {
        $this->orderService = $orderService;
        $this->customerService=$customerService;
        $this->productService= $productService;
    }

    public function index()
    {
        $orders = $this->orderService->getAllOrder();
        $customers = $this->customerService->getAllCustomers();
        $products = $this->productService->getAllProduct();

        return view('order.index')->with([
            'orders'=>$orders,
            'customers'=>$customers,
            'products'=>$products
    ]);
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('order.create')->with([
            'customers'=>$customers,
            'products'=>$products]);
    }

    public function store(Request $request)
    {
        $data =$request->validate([
            'name'=>'required',
            'customer_id'=>'required',
            'product_id'=>'required'
        ]);

        $data=$request->all();

        $order = $this->orderService->storeOrder($data);

        return redirect()->route('orders.index')->withSuccess('Order Added Successfully');
    }

    public function edit($id)
    {
        $order = $this->orderService->editOrder($id);
        $customers = Customer::all();
        $products = Product::all();
        return view('order.edit')->with([
            'order'=>$order,
            'customers'=>$customers,
            'products'=>$products
        ]);

    }

    public function update(Request $request, $id)
    {
        $data =$request->validate([
            'name'=>'required',
            'customer_id'=>'required',
            'product_id'=>'required'
        ]);

        $order= $this->orderService->updateOrder($data, $id);

        return redirect()->route('orders.index')->withSuccess('Order Updated Successfully');
    }

    public function destroy($id)
    {
        $order= $this->orderService->deleteOrder($id);

        return redirect()->route('orders.index')->withSuccess('Order Deleted Successfully');
    }
}


