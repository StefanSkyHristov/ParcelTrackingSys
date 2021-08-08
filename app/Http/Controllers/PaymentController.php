<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Cashier\Exceptions\IncompletePayment;

class PaymentController extends Controller
{
    public function index()
    {
        $parcel = Session::get('parcel');
        $intent = auth()->user()->createSetupIntent();
        return view('parcel.checkout', compact('intent'))->with(['parcel'=>$parcel]);
    }

    public function checkout()
    {
        $parcelSession = request('parcel');
        $parcel = json_decode($parcelSession);
        $user = request()->user();
        $paymentMethod = request('payment_method');

        try
        {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($parcel->price * 100, $paymentMethod);
        }
        catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }

        return redirect()->route('parcel.save')->with(['parcel' => $parcelSession]);
    }
}
