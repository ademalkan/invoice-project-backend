<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::get('/inovices', [InvoiceController::class, 'index']);
Route::get('/inovice/{invoiceId}', [InvoiceController::class, 'show']);
Route::post('/inovice/edit/{invoiceId}', [InvoiceController::class, 'editInvoice']);
Route::post('/inovice/create', [InvoiceController::class, 'createInvoice']);

Route::post('/inovice/{invoiceId}', [InvoiceController::class, 'destroy']);
Route::post('/inovice/set-invoice-paid/{invoiceId}', [InvoiceController::class, 'setInvoicePaid']);


Route::post('posts', function () {
    return "adem";
})->middleware('auth:sanctum');
