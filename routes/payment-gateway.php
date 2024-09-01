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









Route::get('/payment-gateway', function () {
    return response()->json(['message' => 'Payment gateway'], 200);
});








Route::post('sslcommerz/success','PaymentController@success')->name('payment-success');

Route::post('sslcommerz/failure','PaymentController@failure')->name('payment-failure');

Route::post('sslcommerz/cancel','PaymentController@cancel')->name('payment-cancel');

Route::post('sslcommerz/ipn','PaymentController@ipn')->name('payment-ipn');

