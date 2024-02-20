<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todas las ciudades
        $cities = City::query();

        // Filtrar por nombre si se proporciona el parámetro de consulta 'name'
        if ($request->has('name')) {
            $cities->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Filtrar por departamento si se proporciona el parámetro de consulta 'department_id'
        if ($request->has('department_id')) {
            $cities->where('department_id', $request->input('department_id'));
        }

        // Obtener las ciudades paginadas
        $perPage = $request->input('per_page', 15);
        $cities = $cities->paginate($perPage);

        // Devolver las ciudades paginadas en formato JSON
        return response()->json([
            'status' => true,
            'cities' => $cities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $city = City::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "City created successfully!",
            'city' => $city
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::findOrFail($id);
        return response()->json($city);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'department_id' => 'required|integer',
        ]);
        $city->update($request->all());

        return response()->json($city);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json(null);
    }
}
