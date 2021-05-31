<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = ['tracking_number', 'branch_id', 'sender_name', 'recipient_name',
    'sender_address', 'recipient_address', 'sender_contact','recipient_contact', 'delivery_type', 'length',
    'width', 'height', 'weight', 'price', 'user_id', 'updated_by', 'status', 'status_description'];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function branches()
    {
        return $this->belongsTo('App\Models\Branch', 'id');
    }
}
