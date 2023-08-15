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
    public function index()
    {
        $clients = Client::all();
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
