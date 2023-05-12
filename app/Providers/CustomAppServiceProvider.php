<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Models\Language;
use App\Models\Theme;
use App\Models\Footer;
use App\Models\About;
use App\Models\Communication;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Cookie;
use App\Models\Maintenance;
use App\Models\MaintenanceToken;
use App\Models\Plan;
use App\Models\Post;
use App\Models\Seal;
use App\Models\Service;
use App\Models\Team;
use App\Models\Teatimonial;
use Illuminate\Support\Facades\Session;

class CustomAppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        App::singleton('maintenance', function () {
               $maintenance = Maintenance::first();
            collect($maintenance)->merge($maintenance?->tokens);
            return ['maintenance' => $maintenance];
        });
        App::singleton('maintenance_token', function () {
            if (Session::has('preview_token')) {
                $token = null;
                $token = MaintenanceToken::where('token', session('preview_token'))->first();
                if ($token) {
                    return $token;
                } else {
                    return false;
                }
            }
        });

        App::singleton('contacts', function () {

            return Contact::where('active', true)
                ->orderBy('order', 'ASC')
                ->get();
        });

        App::singleton('cookies', function () {
            return Cookie::where('is_active', true)->first();
        });

        App::singleton('footers', function () {
            $footers = [];
            $footers = new Footer;
            return
                [
                    'info' => $footers->where('info', true)->first(),
                    'data' => $footers->where('info', false)->get()
                ];
        });

        App::singleton('themes', function () {
            return Theme::get()->pluck('title', 'key');
        });

        App::singleton('abouts', function () {
            return About::first();
        });
        App::singleton('communications', function () {
            return Communication::first();
        });

        App::singleton('teatimonials', function () {
            return $teatimonials = Teatimonial::all();
        });

        App::singleton('teams', function () {
            $teams = Team::all();
            return
            [
                'info' => $teams->where('info', true)->first()->background ??'',
                'data' => $teams
            ];
        });

        App::singleton('plans', function () {
            return Plan::whereHas('options')->orderBy('id', 'ASC')
                ->get();
        });
        App::singleton('communication', function () {
            return Communication::orderBy('id', 'ASC')
                ->first();
        });
        App::singleton('services', function () {
            return Service::where('slug', '!=', null)
                            ->where('name', '!=',  null)
                            ->orderBy('created_at', 'DESC')->get();
        });

        App::singleton('seals', function () {
            return Seal::where('isActive', true)->get();
            // return ['seals' => $seals];
        });
    }

    public function boot()
    {
    }
}
