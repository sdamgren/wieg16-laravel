<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Address;

class CustomerController extends Controller
{
    public function showCustomer()
    {
        return response()->json(Customer::all());

    }

    public function oneId($id)
    {
        $customer = Customer::find($id);

        if ($customer != null) {
            return response()->json($customer);

        } else {
            return response()->json(["message" => "Customer not found"], 404);
        }
    }

    public function showIdAndAddress($customer_id) {

        $address = Address::find($customer_id);

        if ($address != null) {
            return response()->json($address);

        } else {
            return response()->json(["message" => "Customer not found "], 404);
        }
    }

    public function customersByCompany_id($company_id)
    {
        $customerCompany = Customer::find($company_id);

        if ($customerCompany != null) {
            return response()->json($customerCompany);

        } else {
            return response()->json(["message" => "Customer not found "], 404);
        }
    }
}