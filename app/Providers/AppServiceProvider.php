<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\Facades\DB;

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
        //ADDED_VMJ
        //Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {   proLib na, seeders check one by one, then migrations

            //if (\Auth::check()){
                //---Get Setting
                $setting = Setting::find(1)->first(); //one record only in DB
                    $view->with('global_setting_version', $setting->version);
                    $view->with('global_setting_logo', $setting->logo);
                    //$view->with('global_setting_app_name', $setting->app_name);  // GET FROM .env
                    $view->with('global_setting_developed_from', $setting->developed_from);
                    $view->with('global_setting_developed_by', $setting->developed_by);
                    $view->with('global_setting_company_name', $setting->company_name);
                    $view->with('global_setting_year', $setting->year);

                //---Get Role DISABLED_VMJ 09/19/2022
                // if (\Auth::check()){
                //     $role = DB::table('roles')
                //         ->leftJoin('role_user', 'roles.id', 'role_user.role_id')
                //         ->where('role_user.user_id', \Auth::id())
                //         ->select('roles.*')
                //         ->first();
                //     if (!empty($role)) //this prevents error for the newly registered and not activated user
                //         $view->with('global_user_roletitle', $role->title);   
                // }        
            //}        
        });
    }
}
