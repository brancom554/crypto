<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // get all data from menu.json file
        $adminMenuJson = file_get_contents(base_path('resources/data/menu-data/adminMenu.json'));
        $adminMenuData = json_decode($adminMenuJson);
		$userMenuJson = file_get_contents(base_path('resources/data/menu-data/userMenu.json'));
        $userMenuData = json_decode($userMenuJson);
        // Share all menuData to all the views
        \View::share('menuData', [$adminMenuData]);
		\View::share('usermenuData', [$userMenuData]);
    }
}
