<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ParcelController extends Controller
{
    public function create()
    {
        $branches = Branch::all();
        return view('parcel.create', compact('branches'));
    }

    public function index()
    {
        $parcels = Parcel::paginate(10);
        return view('parcel.index', compact('parcels'));
    }

    public function submitted()
    {
        $submittedParcels = Parcel::where('status', 0)->paginate(10);

        return view('parcel.submitted', compact('submittedParcels'));
    }

    public function track()
    {
        $parcels = Parcel::all();
        return view('parcel.track', compact('parcels'));
    }

    public function progress()
    {
        $trackingNumber = request('tracking_number');

        $parcel = Parcel::where('tracking_number', $trackingNumber)->first();
        if(!$parcel)
        {
            Session::flash('not_found_message', 'The following parcel does not exist. Please check your tracking number.');
            return redirect()->route('parcel.track');
        }
        else
        {
            $status = $parcel->status;
            if($status == 0)
            {
                return view('parcel.progress.submitted');
            }
            else if($status == 1)
            {
                return view('parcel.progress.collectedfordelivery');
            }
            else if($status == 2)
            {
                return view('parcel.progress.shippedToBranch');
            }
            else if($status == 4)
            {
                return view('parcel.progress.shippedToAddress');
            }
            else if($status == 99)
            {
                return view('parcel.progress.failedDelivery');
            }
            else
            {
                return view('parcel.progress.collected');
            }
        }
    }

    public function withCourrier()
    {
        $collectedParcels = Parcel::where('status', 1)->paginate(10);

        return view('parcel.withCourrier', compact('collectedParcels'));
    }

    public function toBeCollected()
    {
        $parcelsToCollect = Parcel::where('status', 2)->paginate(10);
        return view('parcel.toBeCollected', compact('parcelsToCollect'));
    }

    public function failedDelivery()
    {
        $failedParcels = Parcel::where('status', 99)->paginate(10);
        return view('parcel.deliveryFailed', compact('failedParcels'));
    }

    public function numberExists($number)
    {
        return Parcel::where('tracking_number', $number)->exists();
    }

    public function generateTrackingNumber()
    {
        $number = mt_rand(000000000, 999999999);

        if($this -> numberExists($number))
        {
            return $this -> generateTrackingNumber();
        }

        return $number;
    }

    public function store()
    {
       $inputs = request()->validate([
            'sender_name'=>'required|max:100',
            'recipient_name'=>'required|max:100',
            'sender_address'=>'required|min:10|max:255',
            'recipient_address'=>'required|min:10|max:255',
            'sender_contact'=>'required|min:10|max:17',
            'recipient_contact'=>'required|min:10|max:17',
            'branch_id' =>'required_if:delivery_type,=,0',
            'length'=>'required',
            'width'=>'required',
            'height'=>'required',
            'weight'=>'required',
        ]);

        if(request('delivery_type') == true)
        {
             $deliveryType = 1;
        }
        else
        {
             $deliveryType = 0;
        }

        if(request('branch_selection') == 'Select Branch')
        {
            $branchId = 0;
        }
        else
        {
            $branchId = request('branch_selection');
        }

        $trackingNumber = $this -> generateTrackingNumber();

        $parcel = new Parcel;
        $parcel->sender_name = request('sender_name');
        $parcel->recipient_name = request('recipient_name');
        $parcel->sender_address = request('sender_address');
        $parcel->recipient_address = request('recipient_address');
        $parcel->sender_contact = request('sender_contact');
        $parcel->recipient_contact = request('recipient_contact');
        $parcel->delivery_type = $deliveryType;
        $parcel->branch_id = $branchId;
        $parcel->length = request('length');
        $parcel->width = request('width');
        $parcel->height = request('height');
        $parcel->weight = request('weight');
        $parcel->user_id = Auth::user()->id;
        $parcel->updated_by = Auth::user()->id;
        $parcel->tracking_number = $trackingNumber;
        $parcel->price = request('length') * 0.2 + request('width') * 0.1 + request('height') * 0.3 +
             request('weight') * 0.5;
        // Parcel::create([
        //     'sender_name' => request('sender_name'),
        //     'recipient_name' => request('recipient_name'),
        //     'sender_address' => request('sender_address'),
        //     'recipient_address' => request('recipient_address'),
        //     'sender_contact' => request('sender_contact'),
        //     'recipient_contact' => request('recipient_contact'),
        //     'delivery_type' => $deliveryType,
        //     'branch_id' => $branchId,
        //     'length' => request('length'),
        //     'width' => request('width'),
        //     'height' => request('height'),
        //     'weight' => request('weight'),
        //     'user_id' => Auth::user()->id,
        //     'updated_by' => Auth::user()->id,
        //     'tracking_number' => $trackingNumber,
        //     'price' => request('length') * 0.2 + request('width') * 0.1 + request('height') * 0.3 +
        //     request('weight') * 0.5
        // ]);

        // Session::flash('created_message', 'Order submitted successfully. Check your mailbox to see your
        // tracking number');

        // $data = [
        //     'title' => 'Parcel delivery details',
        //     'content' => 'Hello '. request('sender_name').'!'."\r\n".'Your order has been submitted successfully and
        //     your tracking number is: '. $trackingNumber. '.'. "\r\n". 'You can track the progress of your
        //     order on the company website.'. "\r\n". "\r\n". 'Stay safe!'
        // ];

        // Mail::send('emails.test', $data, function($message) {
        //     $message->to(Auth::user()->email, 'Stefan')->subject('Parcel delivery details');
        // });

        //return back();
        $encryptedParcel = encrypt($parcel);
        return redirect()->route('payment.index')->with(['parcel'=>$parcel]);
        // return redirect()->action([PaymentController::class, 'index'], ['parcel'=>$parcel]);
    }

    public function save()
    {
        $parcelSession = Session::get('parcel');
        $parcel = json_decode($parcelSession);

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

        $data = [
            'title' => 'Parcel delivery details',
            'content' => 'Hello '. request('sender_name').'!'."\r\n".'Your order has been submitted successfully and
            your tracking number is: '. $parcel->tracking_number. '.'. "\r\n". 'You can track the progress of your
            order on the company website.'. "\r\n". "\r\n". 'Stay safe!'
        ];

        Mail::send('emails.test', $data, function($message) {
            $message->to(Auth::user()->email, 'Stefan')->subject('Parcel delivery details');
        });

        Session::flash('message', 'Order submitted successfully. Check your mailbox to see your
        tracking number');
        return back();
    }

    public function edit(Parcel $parcel)
    {
        $branches = Branch::all();
        return view('parcel.edit', compact('parcel', 'branches'));
    }

    public function updateStatus(Parcel $parcel)
    {
        $parcel->status_description = request('status_description');
        $currentStatus = $parcel->status;
        switch(request('status_description'))
        {
            case "Collected by Courrier":
                $parcel->status = 1;
                break;
            case "Shipped to Branch":
                $parcel->status = 2;
                break;
            case "Collected from Branch":
                $parcel->status = 3;
                break;
            case "Shipped to Address":
                $parcel->status = 4;
                break;
            case "Failed Delivery":
                $parcel->status = 99;
                break;
            default:
                $parcel->status = $currentStatus;
        }

        if($parcel->isDirty('status_description'))
        {
            $parcel->updated_by = Auth::user()->id;
            $parcel->save();
            Session::flash('updated_status_message', 'Status of '.$parcel->tracking_number.' updated successfully.');
        }
        else
        {
            Session::flash('updated_status_message', 'Status of '.$parcel->tracking_number.' has not been changed.');
        }
        return back();
    }

    public function update(Parcel $parcel)
    {
        $parcel->sender_name = request('sender_name');
        $parcel->recipient_name = request('recipient_name');
        $parcel->sender_address = request('sender_address');
        $parcel->recipient_address = request('recipient_address');
        $parcel->sender_contact = request('sender_contact');
        $parcel->recipient_contact = request('recipient_contact');
        $parcel->weight = request('weight');
        $parcel->width = request('width');
        $parcel->height = request('height');
        $parcel->length = request('length');

        //If toggle button is clicked, compare previous toggle values to change toggle value properly.
        if(request('delivery_type') == true)
        {
            if($parcel->delivery_type == 0)
            {
                $parcel->delivery_type = 1;
            }
        }
        else
        {
            if($parcel->delivery_type == 1)
            {
                $parcel->delivery_type = 0;
            }
        }

        if(request('branch_selection'))
        {
            $parcel->branch_id = request('branch_selection');
        }

        $parcel->save();
        Session::flash('updated_message', 'Details of '.$parcel->tracking_number. ' updated successfully.');
        return redirect()->route('parcel.index');
    }

    public function destroy(Parcel $parcel)
    {
        $parcel->delete();
        Session::flash('deleted_message', 'Parcel '.$parcel->tracking_number. ' has been deleted successfully.');

        return redirect()->route('parcel.index');
    }
}
