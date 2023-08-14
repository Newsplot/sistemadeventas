<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        return view('providers.index', [
            'providers' => Provider::paginate(10)
        ]);
    }

    public function create()
    {
        $cities = City::orderBy('name')->get();
        return view('providers.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'city_id' => 'required|max:255',
        ]);

        Provider::create($data);

        return back()->with('message', 'Provider created.');
    }

    public function edit(Provider $provider)
    {
        $cities = City::orderBy('name')->get();
        return view('providers.edit', compact('provider', 'cities'));
    }

    public function update(Provider $provider, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'city_id' => 'required|max:255',
        ]);
        $provider->update($data);

        return back()->with('message', 'Provider updated.');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();

        return back()->with('message', 'Provider deleted.');
    }
}
