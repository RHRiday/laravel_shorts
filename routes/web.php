<?php

use App\Http\Controllers\BankStatementController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Faq\FaqController;
use App\Http\Controllers\StdAttController;
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
})->name('home');
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
Route::get('contacts-download', [ContactController::class, 'download'])->name('contacts.download');
Route::resource('contacts', ContactController::class);
Route::resource('statements', BankStatementController::class);
Route::get('attendances/{student}', [StdAttController::class, 'show'])->name('attendances.show');
Route::post('attendances/{stdAtt}', [StdAttController::class, 'destroy'])->name('attendances.destroy');
Route::resource('attendances', StdAttController::class)->only(['index', 'store']);
