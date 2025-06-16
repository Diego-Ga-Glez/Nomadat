<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Exception;
use Log;


class ProductController extends Controller
{
    /**
     * Muestra la lista de productos.
     * 
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try{
            $products = Product::all();
            return view('products.index', compact('products'));
        }catch(Exception $e){
            Log::error($e);
            return redirect()->route('products.index')->with([
                'message' => 'Product list could not be loaded.',
                'class' => 'text-bg-danger'
            ]);
        }
    }

    /**
     * Muestra el formulario para crear nuevos productos.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('products.form', ['action' => 'create', 'product' => new Product()]);
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        // Validar los datos enviados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'stock' => 'required|integer|min:0|max:2147483647',
        ]);

        try{
            Product::create($validated);
            
            return redirect()->route('products.index')->with([
                'message'=> 'Product created.',
                'class' => 'text-bg-success'
            ]);

        } catch(Exception $e){
            Log::error($e);
            return redirect()->route('products.index')->with([
                'message' => 'Error creating product.',
                'class' => 'text-bg-danger'
            ]);
        }
    }

    /**
     * Muestra los detalles de un producto en especifico.
     * 
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(int $id)
    {
        try{
            $product = Product::findOrFail($id);
            return view('products.form', ['action' => 'show', 'product' => $product]);

        } catch(Exception $e){
            Log::error($e);
            return redirect()->route('products.index')->with([
                'message' => 'Error loading product.',
                'class' => 'text-bg-danger'
            ]);
        }
    }

    /**
     * Muestra el formulario para editar un producto existente.
     * 
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(int $id)
    {
        
        try{
            $product = Product::findOrFail($id);
            return view('products.form', ['action' => 'edit', 'product' => $product]);

        } catch(Exception $e){
            Log::error($e);
            return redirect()->route('products.index')->with([
                'message' => 'Error loading edit form.',
                'class' => 'text-bg-danger'
            ]);
        }
    }

    /**
     * Actualizar el producto especificado en el almacenamiento.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        // Validar los datos enviados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0|max:999999.99',
            'stock' => 'required|integer|min:0|max:2147483647',
        ]);
        
        try{
            // Buscar el producto o lanzar error
            $product = Product::findOrFail($id);
            $product->update($validated);

            return redirect()->route('products.index')->with([
                'message' => 'Product updated.',
                'class' => 'text-bg-success'
            ]);

        } catch(Exception $e){
            Log::error($e);
            return redirect()->route('products.index')->with([
                'message' => 'Could not update the product.',
                'class' => 'text-bg-danger'
            ]);
        }

    }

    /**
     * Eliminar un producto especificado del almacenamiento.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        try{
            // Buscar el producto o lanzar error 404 si no existe
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('products.index')->with([
                'message' => 'Product deleted.',
                'class' => 'text-bg-success'
            ]);
        } catch(Exception $e){

            Log::error($e);
            return redirect()->route('products.index')->with([
                'message' => 'Could not delete the product.',
                'class' => 'text-bg-danger'
            ]);
        }
    }
}
