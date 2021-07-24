<?php

namespace App\Models;

use App\Http\Traits\Hashidable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parcel extends Model
{
    use HasFactory;
    use Hashidable;

    protected $fillable = ['tracking_number', 'branch_id', 'sender_name', 'recipient_name',
    'sender_address', 'recipient_address', 'sender_contact','recipient_contact', 'delivery_type', 'length',
    'width', 'height', 'weight', 'price', 'user_id', 'updated_by', 'status', 'status_description'];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function branches()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }
}
