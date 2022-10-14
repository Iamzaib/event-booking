<?php

namespace App\Providers;

use App\Models\FaqCategory;
use App\Models\Setting;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $settings=Setting::all();
        foreach ($settings as $setting){
            if($setting->setting_type=='true-false'){
                $setting->setting_value= $setting->setting_value==1;
            }
            define($setting->setting_key,$setting->setting_value);
        }
        View::share('setting', $settings);
        View::share('faq_cats', FaqCategory::all());

        Paginator::useBootstrapFive();
        //
    }
}
