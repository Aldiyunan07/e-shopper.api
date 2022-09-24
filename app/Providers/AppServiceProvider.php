<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('types')) {
            View::share('countType', Type::count());
        }
        if (Schema::hasTable('brands')) {
            View::share('countBrand', Brand::count());
        }
        if (Schema::hasTable('transactions')) {
            View::share('countTransaction', Transaction::where('read_at', null)->get());
        }
        if (Schema::hasTable('settings')) {
            View::share('setting', Setting::first());
        }

        if (Schema::hasTable('transactions')) {
            View::share('transaction', Transaction::orderby('read_at','desc')->orderby('created_at','desc')->take(10));
        }

    }
}
