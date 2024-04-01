<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
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



    public function updateProduct(Request $request, $id)
    {
        try {
         
            $product = Product::findOrFail($id);
        
          
            $product->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'location' => $request->input('location')
            ]);
        
     
            return "Product updated successfully";
        } catch (ModelNotFoundException $e) {
     
            return response()->json(['error' => 'Product not found.'], 404);
        } catch (Exception $e) {
         
            return response()->json(['error' => 'An error occurred while updating the product: ' . $e->getMessage()], 500);
        }
        
        // return response()->json([
        //     'message' => 'Product updated successfully',
        //     'product' => $product
        // ], Response::HTTP_OK);
    }




 
    public function deleteProduct($id)
    {
        try {
            
            $product = Product::findOrFail($id);

   
            $product->delete();

            return "Product deleted successfully";

        } catch (ModelNotFoundException $e) {
           
            return response()->json(['error' => 'Product not found.'], 404);
        } catch (Exception $e) {
          
            return response()->json(['error' => 'An error occurred while deleting the product: ' . $e->getMessage()], 500);
        }
    }





}
