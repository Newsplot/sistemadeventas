<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class BillController extends Controller
{
    public function index()
    {
        return view('bills.index', [
            'bills' => Bill::paginate(10)
        ]);
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();
        return view('bills.create', compact('products', 'clients', 'employees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subtotal' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/|gt:0',
            'total' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/|gt:0',
            'client_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);

        Bill::create($data);

        return back()->with('message', 'Bill created.');
    }

    public function edit(Bill $bill)
    {
        $products = Product::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();
        return view('bills.edit', compact('products', 'clients', 'employees'));
    }

    public function update(Bill $bill, Request $request)
    {
        $data = $request->validate([
            'subtotal' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/|gt:0',
            'total' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/|gt:0',
            'client_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);

        $bill->update($data);

        return back()->with('message', 'Bill updated.');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();

        return back()->with('message', 'Bill Deleted');
    }
}
