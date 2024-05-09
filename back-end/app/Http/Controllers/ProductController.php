<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response(
            ["data"=>Product::all(),
        "message"=>"getting products effectively "],200);
        } catch (Exception $e) {
          return response(["message"=>"internal error"],500);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'=>"required",
                "price"=>"required",
                "dectription"=>"required"
            ]);
            Product::create($request->all());
            return response(
            ["message"=>"adding product succefly "],201);
        } catch (Exception $e) {
          return response(["message"=>"internal error"],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            return response(
            ["data"=>Product::findorFail($id),
        "message"=>"getting product effectively "],200);
        } catch (Exception $e) {
          return response(["message"=>"internal error"],500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $request->validate([
                'name'=>"required",
                "price"=>"required",
                "dectription"=>"required"
            ]);
        try {
            $product=Product::findorFail($id);
            $product->update($request->all());
            return response(
            ["message"=>"update product effectively "],201);
        } catch (Exception $e) {
          return response(["message"=>"internal error"],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product=Product::findorFail($id);
            $product->delete();
            return response(
            ["message"=>"deleted product succefuly "],200);
        } catch (Exception $e) {
          return response(["message"=>"internal error"],500);
        }
    }
}
