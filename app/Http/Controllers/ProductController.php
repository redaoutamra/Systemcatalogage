<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\http\Requests\CreateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsCollection;
use App\Http\Resources\CategoryResources;
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
        try{
        return new ProductResource(Product::findorFail($id));
        }catch(ModelNotFoundException $e){
            return response()->json(['No product is on that has this id ' => $id],404);
        }
    }
    public function getProducts(){
        return ProductsCollection::Collection(Product::all());
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
     * Returns list
     */
    public function getCategories()
    {
         return CategoryResources::collection(Product::all());
    }
}
