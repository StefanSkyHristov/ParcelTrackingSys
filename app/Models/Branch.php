<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact',
        'email',
        'city',
        'country',
    ];

    public function users()
    {
        return $this->hasMany('App\Model\User');
    }

    public function parcels()
    {
        return $this->hasMany('App\Model\Parcel', 'id');
    }
}
