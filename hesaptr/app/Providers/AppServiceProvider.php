<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Route;
use App\Models\Product;
use App\Models\Category;
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
        config(['app.name' => Cache::get('site_name','FilAdminPRO')]);
        config(['app.locale' => Cache::get('language', 'en')]);
        config(['app.url' => Cache::get('site_url', 'http://localhost')]);
        config(['app.currency' => Cache::get('currency', 'USD')]);
        config(['app.currency_symbol' => Cache::get('currency_symbol', '$')]);

        config(['mail.mailers.smtp.host' => Cache::get('smtp_host')]);
        config(['mail.mailers.smtp.port' => Cache::get('smtp_port')]);
        config(['mail.mailers.smtp.username' => Cache::get('smtp_username')]);
        config(['mail.mailers.smtp.password' => Cache::get('smtp_password')]);
        config(['mail.mailers.smtp.encryption' => Cache::get('smtp_encryption')]);
        config(['mail.from.address' => Cache::get('smtp_from_address')]);
        config(['mail.from.name' => Cache::get('site_name')]);

        config(['services.google.client_id' => Cache::get('google_oauth_client_id')]);
        config(['services.google.client_secret' => Cache::get('google_oauth_client_secret')]);
        config(['services.google.redirect' => Cache::get('google_oauth_redirect')]);
        
        Paginator::useBootstrapFive();

        View::composer(['front.layouts.app'], function ($view) {
            $app_categories =  Category::orderByDesc('created_at')->get();
            $app_products = Product::where('draft',null)->inRandomOrder()->take(12)->get();
            $footer_menus = DB::table('footer_menus')->orderByDesc('updated_at')->get();
            $view->with(compact('app_categories', 'app_products', 'footer_menus'));

        });



    }
}
