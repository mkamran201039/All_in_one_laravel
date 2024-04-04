<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class DeleteService
{  


   
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
