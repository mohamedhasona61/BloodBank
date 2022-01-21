<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\DonationRequest;
use App\Models\BloodType;
use App\Models\City;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(){
        $posts= Post::take(9)->get();
        $donations= DonationRequest::take(3)->get();
        $blood_type= BloodType::get();
        $city=City ::get();

 
        return view('front.home',compact('posts','donations','blood_type','city'));

    }
    public function about(){
        return view('front.who-are-us');
    }
}
