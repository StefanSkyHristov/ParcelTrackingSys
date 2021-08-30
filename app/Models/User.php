<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use App\Http\Traits\Hashidable;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'avatar',
        'email',
        'password',
        'city',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function parcels()
    {
        return $this->hasMany('App\Models\Parcel');
    }

    public function branches()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function getAvatarAttribute($value)
    {
        if(strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE)
            {
                return $value;
            }
        return asset('storage/' . $value);
    }

    public function isAdmin()
    {
        $roles = $this->roles;

        foreach($roles as $role)
        {
            if($role->name == "Administrator")
            {
                return true;
            }
        }

        return false;
    }

    public function hasRole($role_passed)
    {
        foreach($this->roles as $role)
        {
            if($role_passed == $role->name)
            {
                return true;
            }
        }

        return false;
    }

    public function getRouteKey()
    {
        return Hashids::connection(User::class)->encode($this->getKey());
    }
}
