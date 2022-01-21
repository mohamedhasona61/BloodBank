<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'd_o_b', 'blood_type_id', 'last_donation_date', 'city_id', 'mobile_num', 'password', 'pin_code','is active');
    

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }
    public function favourites()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function contactUsMessage()
    {
        return $this->belongsTo('ContactUs');
    }

    public function governorates()
    {
        return $this->morphedByMany(Governorate::class, 'clientable');
    }

    public function notifications()
    {
        return $this->belongstomany('Notification', 'clientable')->withPivot('is_read');
    }

    public function posts()
    {
        return $this->morphedByMany('Post', 'clientable');
    }

    // public function bloodTypes()
    // {
    //     return $this->belongstomany('BloodType', 'clientable');
    // }
   public function bloodTypes()
    {
        return $this->morphedByMany(BloodType::class, 'clientable');
    }
    public function tokens()
    {
        return $this->hasmany('Tokens');
    }
    protected $hidden = [
        'password','api_token'

    ];

}
