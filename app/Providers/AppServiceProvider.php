<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

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
        $setting = Setting::get();
        $settingVal = [];
        foreach ($setting as  $item) {
            $settingVal[$item->key] = $item->val;
        }

        config()->set('settings', $settingVal);

        URL::forceRootUrl(env('APP_URL'));
        URL::forceScheme(parse_url( env('APP_URL'), PHP_URL_SCHEME ));
    }
}
