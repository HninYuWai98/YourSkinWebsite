<?php

namespace App\Services\Order;

use Exception;
use App\Models\Order\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getAllOrder()
    {
        $orders = Order::with(['customer', 'product'])->get();
        return $orders;
    }

    public function storeOrder($data)
    {
        try{

            DB::beginTransaction();

            $order = Order::create($data);

            DB::commit();
        }catch(Exception $exception){
            DB::rollback();
        }
        return $order;
    }

    public function editOrder($id)
    {
        $order = Order::findOrFail($id);
        return $order;
    }

    public function updateOrder($data, $id)
    {
        try{

            DB::beginTransaction();

            $order = Order::findOrFail($id);

            $order->update($data);

            DB::commit();
        }catch(Exception $exception){
            DB::rollback();
        }
        return $order;
    }

    public function deleteOrder($id)
    {
        try{

            DB::beginTransaction();

            $order = Order::findOrFail($id);

            $order->delete();

            DB::commit();
        }catch(Exception $exception){
            DB::rollback();
        }
        return $order;
    }


}






