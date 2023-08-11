<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index', [
            'clients' => Client::paginate(10)
        ]);
    }

    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('clients.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'identification' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'city_id' => 'required|integer',
        ]);

        Client::create($data);

        return back()->with('message', 'Client created.');
    }

    public function edit(Client $client)
    {
        $cities = City::orderBy('name')->get();
        return view('clients.edit', compact('client', 'cities'));
    }

    public function update(Client $client, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'identification' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'city_id' => 'required|integer',
        ]);
        $client->update($data);

        return back()->with('message', 'Client updated.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return back()->with('message', 'Client deleted.');
    }
}
