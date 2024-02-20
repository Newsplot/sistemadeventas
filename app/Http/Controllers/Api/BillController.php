<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todas las facturas
        $bills = Bill::query();

        // Filtrar por número de factura si se proporciona el parámetro de consulta 'invoice_number'
        if ($request->has('invoice_number')) {
            $bills->where('invoice_number', $request->input('invoice_number'));
        }

        // Filtrar por cliente si se proporciona el parámetro de consulta 'client_id'
        if ($request->has('client_id')) {
            $bills->where('client_id', $request->input('client_id'));
        }

        // Obtener las facturas paginadas
        $perPage = $request->input('per_page', 15);
        $bills = $bills->paginate($perPage);

        // Devolver las facturas paginadas en formato JSON
        return response()->json([
            'status' => true,
            'bills' => $bills
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bill = Bill::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Bill created successfully!",
            'bill' => $bill
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bill = Bill::findOrFail($id);
        return response()->json($bill);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();

        return response()->json(null);
    }
}
