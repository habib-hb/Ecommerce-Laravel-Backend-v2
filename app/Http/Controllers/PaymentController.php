<?php

namespace App\Http\Controllers;

use DGvai\SSLCommerz\SSLCommerz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function order(Request $request)
    {

        //  DO YOU ORDER SAVING PROCESS TO DB OR ANYTHING

        $request->validate([
            $request->email => 'required',
            $request->total_quantity => 'required',
            $request->total_amount => 'required',
        ]);

        //Generate Random Number
        $trxid = rand(100000, 999999);

        $sslc = new SSLCommerz();
        $sslc->amount(intval($request->total_amount))
            ->trxid($trxid)
            ->product($request->total_quantity . 'Items for ' . $request->total_amount . 'Tk')
            ->customer('Awesome Customer', $request->email);

        return $sslc->make_payment();

        /**
         *
         *  USE:  $sslc->make_payment(true) FOR CHECKOUT INTEGRATION
         *
         * */
    }

    public function success(Request $request)
    {
        $validate = SSLCommerz::validate_payment($request);
        if($validate)
        {
            $bankID = $request->bank_tran_id;   //  KEEP THIS bank_tran_id FOR REFUNDING ISSUE

            //  Do the rest database saving works
            //  take a look at dd($request->all()) to see what you need

            return response()->json(['Message' => 'Success route - payment  validated :)']);

        }

        return response()->json(['Message' => 'Success route - payment not validated']);
    }

    public function failure(Request $request)
    {

        //  do the database works
        //  also same goes for cancel()
        //  for IPN() you can leave it untouched or can follow
        //  official documentation about IPN from SSLCommerz Panel

        return response()->json(['Message' => 'Failure route']);

    }


    public function cancel(Request $request)
    {
        // Handle cancel scenario
        // You might want to log this event or update the order status in your database
        // For example:
        // $order = Order::where('transaction_id', $request->tran_id)->first();
        // if ($order) {
        //     $order->status = 'cancelled';
        //     $order->save();
        // }

        return response()->json(['Message' => 'Cancel route']);
    }


    public function ipn(Request $request)
    {
        // Handle IPN (Instant Payment Notification) scenario
        // This is usually called by SSLCommerz to notify your system of any payment status change
        // You may validate and update the order status accordingly
        // $validate = SSLCommerz::validate_ipn($request);
        // if ($validate) {
            // Do the database update or processing needed for IPN
            // For example:
            // $order = Order::where('transaction_id', $request->tran_id)->first();
            // if ($order) {
            //     $order->status = 'completed'; // or whatever status you want to update to
            //     $order->save();
            // }
        // }

        return response()->json(['Message' => 'IPN route']);
    }

}
