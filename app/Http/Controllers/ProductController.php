<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\http\Requests\CreateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
            $product = new Product;
            $product->name = $request->name;
            $product->category = $request->category;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->save();

            return response()->json([
                'data' => $product ,
                'message' => 'product created seccessfully'

            ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if(!$product){
            return  response()->json([
                'message' => "the product you chosed dosen't exist" ],404
            );
        }
        return response()->json([
            'data' => $product ,
            'message' => 'product found'
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json([
                'message' => 'product not found'
            ], 200);
        }
        $product->name = $request->name;
        $product->category = $request->category;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();
        return response()->json([
            'message' => 'product updated seccessflly',
            'data' => $product,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
              $product = Product::Findorfail($id);
              $product->delete();
              return response()->json([
                "message" => "Product deleted "
              ]

                  , 200);
           }catch(ModelNotFoundException $e){
            return response()->json([
                "message" => "product not found"
            ], 404);

           }


    }
    /**
     * @OA\Get(
     *      path="/api/category",
     *      operationId="getCategoryList",
     *      tags={"Categories"},
     *      summary="Get list of categories",
     *      description="Returns list of categories",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       )
     *     )
     *
     *
     * Returns list of categories
     */
    public function getCategories()
    {
          $categories = Product::pluck('category');
          return response()->json($categories, 200);
        // return ProductResource::collection(Product::pluck('category'));
    }
}
