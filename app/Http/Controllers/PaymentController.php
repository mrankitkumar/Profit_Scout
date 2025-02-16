<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\UserSubscriptionHistory;
use App\Models\SubscriptionPackage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentController extends Controller
{
    // Create Stripe Checkout Session
    public function createCheckoutSession(Request $request)
    {
       // print_r($request->all());
        try {
            // Set the Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Store price and package id in the session
            session(['paymentdata' => ['price' => $request->price, 'packageid' => $request->packageid]]);

            // Create a Stripe Checkout Session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => [
                                'name' => 'Purchase Item',
                                'description' => 'Payment for selected items',
                            ],
                            'unit_amount' => $request->price * 100,
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => url('/user/purchaseitempaymentstripe/success?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => url('/user/mysubscription'),
                'customer_email' => Auth::user()->email,
            ]);
            //dd($session->url);
            return response()->json(['url' => $session->url], 200);
        } catch (Exception $e) {
            Log::error('Stripe Checkout Session Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    // Handle the payment success callback
    public function purchaseitempaymentstripesuccess(Request $request)
    {
        try {
            // Set the Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $data = session('paymentdata', null);

            // Retrieve the Stripe session
            $session = Session::retrieve($request->session_id);
            //dd($session);

            $transaction = UserSubscriptionHistory::where('payment_method_id', $session->payment_intent)->first();
            //dd($transaction);
            if ($transaction) {
                return redirect()->route('mysubscription');
            } else {
                $userSubscriptionHistory = UserSubscriptionHistory::create([
                    'subscription_id' => $data['packageid'],
                    'customber_id' => Auth::user()->id,
                    'start_date' => now(),
                    'payment_date' => now(),
                    'ammount' => $data['price'],
                    'subscription_status' => 'Cancelled',
                    'payment_status' => 'Failed',
                    'payment_method' => 'Stripe',
                    'payment_method_id' => $session->payment_intent,

                ]);
              //  dd($userSubscriptionHistory);
            }
            // Retrieve the payment data from the session





            if ($session && $data) {

                // Check if the payment is successful
                if ($session->payment_status === 'paid') {

                    DB::beginTransaction();

                    // Fetch the subscription package from the database
                    $package = SubscriptionPackage::findOrFail($data['packageid']);


                    // Calculate the end date based on the subscription type
                    if ($package->subscription_type === 'Annual') {
                        $endDate = now()->addYears($package->interval_period);
                    }

                    if ($package->subscription_type === 'Monthly') {
                        $endDate = now()->addMonths($package->interval_period);
                    }

                    if ($package->subscription_type === 'Days') {
                        $endDate = now()->addDays($package->interval_period);
                    }

                    // Format the Carbon instance as a string (Y-m-d format)
                    $endDateFormatted = $endDate->format('Y-m-d');


                    //dd($session->payment_intent);
                    // Create a new subscription history record
                    //dd( $endDateFormatted,$data['price'], $data['packageid'],Auth::user()->id);
                    $transaction2 = UserSubscriptionHistory::where('payment_method_id', $session->payment_intent)
                      ->where('subscription_id', $data['packageid'])
                        ->where('subscription_status', 'Cancelled')
                        ->where('payment_method', 'Stripe')
                        ->where('payment_status', 'Failed')
                        ->where('customber_id', Auth::user()->id)
                        ->first();
                    //dd($transaction2);
                    if ($transaction2) {
                        $transaction2->update([
                            'subscription_id' => $data['packageid'],
                            'customber_id' => Auth::user()->id,
                            'end_date' =>  $endDateFormatted,
                            'start_date' => now(),
                            'payment_date' => now(),
                            'ammount' => $data['price'],
                            'subscription_status' => 'Active',
                            'payment_status' => 'Success',
                            'payment_method' => 'Stripe',
                            'payment_method_id' => $session->payment_intent,
                        ]);
                    }
                    else{
                        $errorMessage = 'Payment failed or canceled.';
                       return view('welcome', compact('errorMessage'));
                    }


                    $subscription = UserSubscriptionHistory::where('customber_id', Auth::user()->id)
                        ->where('subscription_status', 'Active')
                        ->first();

                    if ($subscription) {
                        $subscription->subscription_status = 'Inactive';
                        $subscription->save();
                    }




                    DB::commit();


                    session(['payment_successful' => true]);

                    session()->forget('paymentdata');
                    session()->forget('payment_successful');
                    $successMessage = 'Payment successful!';

                    return view('user.mysubscription', compact('successMessage'));
                } else {
                    $errorMessage = 'Payment failed or canceled.';
                    return view('user.dashboard', compact('errorMessage'));
                }
            } else {
                return redirect()->route('mysubscription');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during payment success handling: ' . $e->getMessage());
            return redirect()->route('landingpage')->with('error', 'There was an error with your payment.');
        }
    }
}
