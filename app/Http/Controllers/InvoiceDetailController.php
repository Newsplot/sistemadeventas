<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Bill;

class InvoiceDetailController extends Controller
{
    public function index()
    {
        return view('invoice_details.index', [
            'invoicedetails' => InvoiceDetail::paginate(10)
        ]);
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        $bills = Bill::orderBy('total')->get();
        return view('invoice_details.create', compact('products', 'bills'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/|gt:0',
            'amount' => 'required|max:255',
            'product_id' => 'required|integer',
            'bill_id' => 'required|integer',
        ]);

        InvoiceDetail::create($data);

        return back()->with('message', 'Invoice Detail created.');
    }

    public function edit(InvoiceDetail $invoiceDetail)
    {
        $products = Product::orderBy('name')->get();
        $bills = Bill::orderBy('name')->get();
        return view('invoice_details.edit', compact('products', 'bills'));
    }

    public function update(InvoiceDetail $invoiceDetail, Request $request)
    {
        $data = $request->validate([
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/|gt:0',
            'amount' => 'required|max:255',
            'product_id' => 'required|integer',
            'bill_id' => 'required|integer',
        ]);

        $invoiceDetail->update($data);

        return back()->with('message', 'Invoice Detail updated.');
    }

    public function destroy(InvoiceDetail $invoiceDetail)
    {
        $invoiceDetail->delete();

        return back()->with('message', 'Invoice Detail deleted');
    }
}
