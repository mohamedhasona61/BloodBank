<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\DonationRequest;
class AppServiceProvider extends ServiceProvider
{
 
    public function register()
    {
        
    }

 
    public function boot()
    {
        $settings=Setting::first();
        view()->share(compact('settings'));

        // $donations=DonationRequest::first();
        // view()->share(compact('donation'));
    }
}
