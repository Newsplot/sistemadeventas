<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todos los departamentos
        $departments = Department::query();

        // Filtrar por nombre si se proporciona el parámetro de consulta 'name'
        if ($request->has('name')) {
            $departments->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Filtrar por código si se proporciona el parámetro de consulta 'code'
        if ($request->has('code')) {
            $departments->where('code', $request->input('code'));
        }

        // Obtener los departamentos paginados
        $perPage = $request->input('per_page', 15);
        $departments = $departments->paginate($perPage);

        // Devolver los departamentos paginados en formato JSON
        return response()->json([
            'status' => true,
            'departments' => $departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $department = Department::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Department created successfully!",
            'department' => $department
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $deparment = Department::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
        ]);
        $deparment->update($request->all());

        return response()->json($deparment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json(null);
    }
}
