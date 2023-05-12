<?php

namespace App\Http\Middleware\custom;


use Closure;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
     {
        if (App()->maintenance['maintenance']?->active && App()->maintenance['maintenance']?->if_auth && Auth::check()) {
            return $next($request);
        }

        if (!App()->maintenance['maintenance']?->active) {
            return $next($request);
        } elseif ($request->is(config('base.admin_path') . '/*') || $request->is(config('base.admin_path')) || $request->is(App()->maintenance['maintenance']?->route . '/*') || $request->is('maintenance')) {
            return $next($request);
        } elseif (
            Session::has('preview_token') &&
            Session::has('preview_expired_at') &&
            App()->maintenance['maintenance']?->preview
        ) {

            if (
                !App()->maintenance_token
                ||
                session('preview_expired_at') <= \Carbon\Carbon::now()
                ||
                session('preview_token') != App()->maintenance_token?->token
                ||
                !App()->maintenance['maintenance']->preview
                ||
                !App()->maintenance_token?->active
            ) {
                Session::forget('preview_token');
                Session::forget('preview_expired_at');
                Artisan::call('optimize:clear');
                abort(redirect('maintenance'));
            }
            return $next($request);
        } else {
            if (Session::has('preview_token') && Session::has('preview_expired_at')) {
                Session::forget('preview_token');
                Session::forget('preview_expired_at');
                Artisan::call('optimize:clear');
            }
            abort(redirect('maintenance'));
        }
        abort(redirect('maintenance'));
    }
}
