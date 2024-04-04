<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class CreateService
{  

    public function createProduct(Request $request)
    {  
        try {
            $product = Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'location' => $request->input('location')
            ]);
        
    
            return $product;
        } catch (QueryException $e) {
           
            return response()->json(['error' => 'An error occurred while creating the product: ' . $e->getMessage()], 500);
        }
    }


    




}
