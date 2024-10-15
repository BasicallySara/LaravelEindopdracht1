<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        //Pakt alle producten uit de database
        $products = Product::all(); 
    
        return view('products.list', [
            'products' => $products
        ]);
    }
    
    // Create pagina tonen
    public function create()
    {
        return view('products.create');
    }

    // Product opslaan in de database
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            'publish_date' => 'nullable|date', // Validatie voor publish_date
            'image' => 'image|nullable|max:1999'
        ];

        // Valideert alles
        $validator = Validator::make($request->all(), $rules);


        // als de validatie faalt, redirect naar de create pagina met de errors
        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // Product opslaan in de database
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->publish_date = $request->publish_date; 

        if ($request->hasFile('image')) {
            if (!file_exists(public_path('uploads/products'))) {
                mkdir(public_path('uploads/products'), 0755, true); // Maak de map aan met de juiste permissies
            }

            // Afbeelding opslaan
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension(); // Verkrijg de bestandsuitbreiding
            $imageName = time() . '.' . $ext; // GenereerT een unieke naam voor de afbeelding

            // Verplaatst het bestand naar de map uploads/products
            $image->move(public_path('uploads/products'), $imageName);

            // Slaat de naam van de afbeelding op in de database
            $product->image = $imageName;
        }

        // Sla het product op in de database
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    // Edit pagina tonen
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    // Deze methode gaat een product updaten in de database
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        // Validatieregels
        $rules = [
            'name' => 'required|min:3',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            'publish_date' => 'nullable|date', 
            'image' => 'image|nullable|max:1999',
        ];

        // Valideert de invoer
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        // Update de productgegevens
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->publish_date = $request->publish_date; 
        
        // Controleer of er een nieuwe afbeelding is geüpload
        if ($request->hasFile('image')) {
            // Verwijder de oude afbeelding als deze bestaat
            if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }

            // Upload de nieuwe afbeelding
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension(); // pakt de foto
            $imageName = time() . '.' . $ext; // Genereert een unieke naam voor de afbeelding

            // Verplaats het bestand naar de map uploads/products
            $image->move(public_path('uploads/products'), $imageName);

            // Sla de naam van de afbeelding op in de database
            $product->image = $imageName;
        }

        // Sla het product op in de database
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // Deze methode gaat een product verwijderen uit de database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Verwijderd de oude afbeelding als deze bestaat
        File::delete(public_path('uploads/products/' . $product->image));
        // Verwijderd het product van de database
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
