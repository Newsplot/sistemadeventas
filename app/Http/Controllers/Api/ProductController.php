<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todos los productos
        $products = Product::query();

        // Filtrar por nombre si se proporciona el parámetro de consulta 'name'
        if ($request->has('name')) {
            $products->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Filtrar por precio mínimo si se proporciona el parámetro de consulta 'min_price'
        if ($request->has('min_price')) {
            $products->where('price', '>=', $request->input('min_price'));
        }

        // Filtrar por precio máximo si se proporciona el parámetro de consulta 'max_price'
        if ($request->has('max_price')) {
            $products->where('price', '<=', $request->input('max_price'));
        }

        // Obtener los productos paginados
        $perPage = $request->input('per_page', 15);
        $products = $products->paginate($perPage);

        // Devolver los productos paginados en formato JSON
        return response()->json([
            'status' => true,
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Product created successfully!",
            'product' => $product
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show ($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request ->validate([
            'status' => true,
            'message' => "Product created successfully!",
            'product' => $product
        ]);
        $product->update($request->all());

        return response()->json($product);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null);
    }
}
