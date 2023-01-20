<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Paymentmethodinfo;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings =Paymentmethodinfo::orderBy('id','desc')->first();
        if(!empty($settings))
        {
            Config::set("sslcommerz.apiCredentials", [
                "store_id" => $settings->store_id,
                "store_password" =>$settings->store_password,
            ]);
        }
       
        Schema::defaultStringLength(191);
    }
}
