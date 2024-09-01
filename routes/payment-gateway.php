<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\PaymentController;









Route::get('/payment-gateway', function () {
    return response()->json(['message' => 'Payment gateway'], 200);
});








Route::post('sslcommerz/order',[PaymentController::class, 'order'])->name('payment-order');

Route::post('sslcommerz/success',[PaymentController::class, 'success'])->name('payment-success');

Route::post('sslcommerz/failure',[PaymentController::class, 'failure'])->name('payment-failure');

Route::post('sslcommerz/cancel',[PaymentController::class, 'cancel'])->name('payment-cancel');

Route::post('sslcommerz/ipn',[PaymentController::class, 'ipn'])->name('payment-ipn');

