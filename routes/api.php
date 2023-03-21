<?php
use App\Models\Product;
use Illuminate\Http\Request;
use App\http\Controllers\UserController;
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
Route::post('/register', [UserController::class,'register']);
Route::get('/category', function () {
    return Product::select('category')->get();
});
Route::middleware(['auth:sanctum'])->group(function () {
Route::post('/Addproduct',[ProductController::class,'store']);
Route::put('/product/{id}',[ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class,'destroy']);
});

Route::get('product/{id}', [ProductController::class, 'show']);
Route::post('/login',[UserController::class,'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
