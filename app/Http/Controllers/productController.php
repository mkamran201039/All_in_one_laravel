<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CreateService;
use App\Services\UpdateService;
use App\Services\DeleteService;
use App\Http\Requests\StoreProductRequest;
use OpenApi\Annotations as OA;

class ProductController extends Controller
{
    protected $productService;

    protected $createService;

    protected $updateService;

    protected $deleteService;

    public function __construct(ProductService $productService, CreateService $createService, UpdateService $updateService, DeleteService $deleteService)
    {
        $this->productService = $productService;
        $this->createService = $createService;
        $this->updateService = $updateService;
        $this->deleteService = $deleteService;
    }

 


    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Returns all products",
     *     description="Returns a map of status codes to quantities",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             @OA\AdditionalProperties(
     *                 type="integer",
     *                 format="int32"
     *             )
     *         )
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     * )
     */

    public function index()
    {
        return Product::all();
    }


    

  /**
     * @OA\Get(
     *     path="/api/products/{orderId}",
     *     tags={"Products"},
     *     summary="Returns product by ID",
     *     description="For valid response try integer IDs with value >= 1 and <= 10. Other values will generated exceptions",
     *     operationId="getOrderById",
     *     @OA\Parameter(
     *         name="orderId",
     *         in="path",
     *         description="ID of pet that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             maximum=10,
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *       
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Order not found"
     *     )
     * )
     */


     public function show($id)
     {
         return Product::findOrFail($id);
     }





        /**
         * @OA\Post(
         *     path="/api/products",
         *     tags={"Products"},
         *     summary="Add product",
         *     operationId="placeOrder",
         *     @OA\Response(
         *         response=200,
         *         description="successful operation"
         *     ),
         *     @OA\RequestBody(
         *         required=true,
         *         description="Data for creating a new product",
         *         @OA\JsonContent(
         *             required={"name", "price", "location"},
         *             @OA\Property(property="name", type="string", example="Product Name"),
         *             @OA\Property(property="price", type="number", format="float", example=10.99),
         *             @OA\Property(property="location", type="string", example="Product Location")
         *         )
         *     )
         * )
         */


    public function store(StoreProductRequest $request)
    {
        return $this->createService->createProduct($request); //using service pattern
    }




    /**
     * @OA\Put(
     *      path="/api/products/{id}",
     *      operationId="update",
     *      tags={"Products"},
     *      summary="Update an existing product",
     *      description="Update an existing product",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Product ID",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Data for updating an existing product",
     *          @OA\JsonContent(
     *              required={"name", "price", "location"},
     *              @OA\Property(property="name", type="string", example="Updated Product Name"),
     *              @OA\Property(property="price", type="number", format="float", example=20.99),
     *              @OA\Property(property="location", type="string", example="Updated Product Location")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Product updated successfully"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Product not found"
     *      )
     * )
     */



    public function update(StoreProductRequest $request, $id)
    {
        return response()->json($this->updateService->updateProduct($request, $id));  //using service pattern 
    }

    /**
     * @OA\Delete(
     *      path="/api/products/{id}",
     *      operationId="destroy",
     *      tags={"Products"},
     *      summary="Delete a product",
     *      description="Delete a product",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Product ID",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Product deleted successfully",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Product not found",
     *      ),
     * )
     */
    public function destroy($id)
    {
        return response()->json($this->deleteService->deleteProduct($id)); // using service pattern
    }
}
