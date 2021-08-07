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
            Parcel::create([
                'sender_name' => $parcel->sender_name,
                'recipient_name' => $parcel->recipient_name,
                'sender_address' => $parcel->sender_address,
                'recipient_address' => $parcel->recipient_address,
                'sender_contact' => $parcel->sender_contact,
                'recipient_contact' => $parcel->recipient_contact,
                'delivery_type' => $parcel->delivery_type,
                'branch_id' => $parcel->branch_id,
                'length' => $parcel->length,
                'width' => $parcel->width,
                'height' => $parcel->height,
                'weight' => $parcel->weight,
                'user_id' => $parcel->user_id,
                'updated_by' => $parcel->updated_by,
                'tracking_number' => $parcel->tracking_number,
                'price' => $parcel->price
            ]);
        }
        catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }

        Session::flash('message', 'Product purchased successfully!');
        return back();
    }
}
