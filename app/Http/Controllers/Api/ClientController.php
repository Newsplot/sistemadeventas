<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todos los clientes
        $clients = Client::query();

        // Filtrar por nombre si se proporciona el parámetro de consulta 'name'
        if ($request->has('name')) {
            $clients->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Filtrar por email si se proporciona el parámetro de consulta 'email'
        if ($request->has('email')) {
            $clients->where('email', $request->input('email'));
        }

        // Obtener los clientes paginados
        $perPage = $request->input('per_page', 15);
        $clients = $clients->paginate($perPage);

        // Devolver los clientes paginados en formato JSON
        return response()->json([
            'status' => true,
            'clients' => $clients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients,email',
            // Otros campos requeridos o reglas de validación si es necesario
        ]);

        $client = Client::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Client created successfully!",
            'client' => $client
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client);
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
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(null);
    }
}
