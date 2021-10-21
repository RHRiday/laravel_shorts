<?php

use App\Http\Controllers\Blog\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
    return view('welcome');
});
Auth::routes();

Route::prefix('dokkoblog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog');
    Route::post('/create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::post('/{id}/update', [BlogController::class, 'addContent'])->name('blog.addContent');
    Route::put('/content/{id}/edit', [BlogController::class, 'editContent'])->name('blog.editContent');
    Route::delete('/{blog}/delete', [BlogController::class, 'destroy'])->name('blog.destroy');
});

Route::post('test', function (Request $request)
{
   dd($request->states); 
});
