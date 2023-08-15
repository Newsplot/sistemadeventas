<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json([
            'status' => true,
            'employees' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = Employee::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Employee created successfully!",
            'employee' => $employee
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        $employee->update($request->all());

        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(null);
    }
}
