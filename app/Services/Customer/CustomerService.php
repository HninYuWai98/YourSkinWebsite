<?php



namespace App\Services\Customer;

use Exception;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\ExecutableFinder;

class CustomerService
{
    public function customerList()
    {
        $customers = Customer::all();
        return $customers;
    }

    public function getAllCustomers()
    {
        $customers = Customer::get();

        return $customers;
    }

    public function storeCustomer($data)
    {
        try{

            DB::beginTransaction();

            $customer = Customer::create($data);

            DB::commit();
        }catch(Exception $exception){
            DB::rollback();
        }
        return $customer;
    }

    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return $customer;
    }

    public function updateCustomer($data, $id)
    {
        try{

            DB::beginTransaction();

            $customer = Customer::findOrFail($id);

            $customer->update($data);

            DB::commit();
        }catch(Exception $exception){
            DB::rollback();
        }
        return $customer;
    }

    public function deleteCustomer($id)
    {
        try{

            DB::beginTransaction();

            $customer = Customer::findOrFail($id);

            $customer->delete();

            DB::commit();
        }catch(Exception $exception){
            DB::rollback();
        }
        return $customer;
    }
}
