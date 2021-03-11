<?php

namespace App\Http\Controllers\Payment;

use App\Facades\Cart as CartFacade;
use App\Http\Controllers\Controller;
use Str;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function charge()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::create($this->getPaymentData());
        return response()->json(['id' => $session->id]);
    }

    private function getPaymentData()
    {
        $cartData['payment_method_types'] = ['card'];
        $cartData['customer_email'] = (auth()->check()) ? auth()->user()->email : null;
        $cartData['mode'] = 'payment';
        $cartData['success_url'] = route('payment.success');
        $cartData['cancel_url'] = route('cart');

        $CartProducts = collect(CartFacade::get()['books']);

        foreach ($CartProducts as $product) {
            $cartData['line_items'][] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->title,
                        'description' => Str::of($product->description)->limit(200),
                        'images' => [
                            $product->cover_full_path
                        ],

                    ],
                    'unit_amount' => $product->price_after_discount * 100,
                ],
                'quantity' => 1,
            ];
        }

        return $cartData;
    }

    public function paymentSuccess()
    {
        return view('payment.success');
    }
}
