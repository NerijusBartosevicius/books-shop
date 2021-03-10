<?php

namespace App\Http\Controllers\Payment;

use App\Facades\Cart as CartFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Stripe\Checkout\Session;
use Stripe\Event;
use Stripe\Stripe;
use UnexpectedValueException;

class PaymentController extends Controller
{
    public function charge()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::create($this->getPaymentData());
        return response()->json(['id' => $session->id]);
    }

    public function preview()
    {
        return view('payment.preview');
    }

    public function paymentSuccess()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payload = @file_get_contents('php://input');

        $event = null;

        try {

            $event = Event::constructFrom(

                json_decode($payload, true)

            );

        } catch(UnexpectedValueException $e) {

            // Invalid payload

            echo '⚠️  Webhook error while parsing basic request.';

            http_response_code(400);

            exit();

        }

        // Handle the event

        switch ($event->type) {

            case 'payment_intent.succeeded':

                $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent

                // Then define and call a method to handle the successful payment intent.

                // handlePaymentIntentSucceeded($paymentIntent);

                break;

            case 'payment_method.attached':

                $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod

                // Then define and call a method to handle the successful attachment of a PaymentMethod.

                // handlePaymentMethodAttached($paymentMethod);

                break;

            default:

                // Unexpected event type

                echo 'Received unknown event type';

        }

        http_response_code(200);
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
}
