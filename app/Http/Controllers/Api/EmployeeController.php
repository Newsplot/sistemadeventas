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
    public function index(Request $request)
    {
        // Obtener todos los empleados
        $employees = Employee::query();

        // Filtrar por nombre si se proporciona el parámetro de consulta 'name'
        if ($request->has('name')) {
            $employees->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Filtrar por cargo si se proporciona el parámetro de consulta 'position'
        if ($request->has('position')) {
            $employees->where('position', 'like', '%' . $request->input('position') . '%');
        }

        // Obtener los empleados paginados
        $perPage = $request->input('per_page', 15);
        $employees = $employees->paginate($perPage);

        // Devolver los empleados paginados en formato JSON
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
