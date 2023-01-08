<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $Produits = Produit::all();
        return [
            "status" => 200,
            "produits" => $Produits
                ];
    }

    public function getcategories()
    {
        $category = Produit::distinct()->get("category");;
        return [
            "status" => 200,
            "categories" => $category
                ];
    }


    public function store(Request $request)
    {
        // La validation de données
    
        $validatedData = $request->validate([
            'name' => 'required',
        'category' => 'required',
        'sku' => 'required',
        'price' => 'required',
        'quantity' => 'required'
        ]);
    
    // On crée un nouvel produit
    $produit = Produit::create([
        'name' => $request->name,
        'category' => $request->category,
        'sku' => $request->sku,
        'price' => $request->price,
        'quantity' => $request->quantity,
    ]);

    // On retourne les informations du nouvel produit en JSON
    return response()->json($produit, 201);
    }

    public function show($id)
    {
        $produit = Produit::find($id);
        if (is_null($produit)) {
            return response()->json('Data not found', 404); 
        }
        return [
            "status" => 200,
            "produit" => $produit
                ];
    }

    public function update(Request $request, Produit $produit)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        'category' => 'required',
        'sku' => 'required',
        'price' => 'required',
        'quantity' => 'required'
        ]);
    
        // On crée un nouvel produit
        $produit->update([
            'name' => $request->name,
            'category' => $request->category,
            'sku' => $request->sku,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return [
            "status" => 1,
            "data" => $produit
        ];
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();

    // On retourne la réponse JSON
    return response()->json();
    }
}
