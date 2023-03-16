<?php
use App\Models\Product;
use Illuminate\Http\Request;
use App\http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/products', function () {
    return Product::all();
});
Route::get('/category', function () {
    return Product::select('category')->get();
});
Route::post('/Addproducts',[ProductController::class,'store']);
Route::put('/products/{id}',[ProductController::class, 'update']);
Route::get('Product/{id}', [ProductController::class, 'show']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
