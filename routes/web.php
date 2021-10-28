<?php

use App\Http\Controllers\Blogs\BlogController;
use App\Http\Controllers\Faqs\FaqController;
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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::prefix('dokkoblog')->group(function () {
    Route::get('/{query?}/{parameter?}', [BlogController::class, 'index'])->name('blog');
    Route::post('/create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::post('/{id}/update', [BlogController::class, 'addContent'])->name('blog.addContent');
    Route::put('/content/{id}/edit', [BlogController::class, 'editContent'])->name('blog.editContent');
    Route::delete('/{blog}/delete', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::delete('/content/{content}/delete', [BlogController::class, 'deleteContent'])->name('blog.deleteContent');
});
Route::prefix('dokkofaq')->group(function () {
    Route::get('/', [FaqController::class, 'index'])->name('faq');
    Route::post('/create', [FaqController::class, 'create'])->name('faq.create');
});

// Route::get('shaping', [BlogController::class, 'shaping']);
