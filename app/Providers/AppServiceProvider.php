<?php

namespace App\Providers;

use App\Models\AdminNotification;
use App\Models\CryptoCurrency;
use App\Models\Deposit;
use App\Models\Extension;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\Page;
use App\Models\SupportTicket;
use App\Models\User;
use App\Models\Watchlist;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Jetstream::ignoreRoutes();
        Fortify::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        $general = GeneralSetting::first();
        $viewShare['general'] = $general;
        view()->share($viewShare);


        view()->composer('panels.sidebar', function ($view) {
            $view->with([
                'banned_users_count'           => User::banned()->count(),
                //'email_unverified_users_count' => User::emailUnverified()->count(),
                //'sms_unverified_users_count'   => User::smsUnverified()->count(),
                'pending_ticket_count'         => SupportTicket::whereIN('status', [0,2])->count(),
                'pending_deposits_count'    => Deposit::pending()->count(),
                'pending_withdraw_count'    => Withdrawal::pending()->count(),
            ]);
        });
        view()->composer('user.panels.navbar', function ($view) {
            $view->with([
                'user' => Auth::user(),
                'deposit' => auth()->user()->deposits()->sum('amount'),
                'cryptos' => CryptoCurrency::where('status', 1)->get(),
            ]);
        });

        view()->composer('panels.navbar', function ($view) {
            $view->with([
                'adminNotifications'=>AdminNotification::where('read_status',0)->with('user')->orderBy('id','desc')->get(),
            ]);
        });
        view()->composer('panels.user.navbar', function ($view) {
            $view->with([
                'watchlists'=>Watchlist::where('user_id', auth()->user()->id)->get(),
            ]);
        });

        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });
        if(App::call('App\Http\Controllers\Admin\UpdateController@check_local_license_exist') == false){
            abort(406);
        }

        if($general->force_ssl){
            URL::forceScheme('https');
        }

    }
}
