<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use TCG\Voyager\Traits\AlertsMessages;
use Illuminate\Support\Facades\Artisan;

class UpgradeAppController extends Controller
{
    use AlertsMessages;
    public function download()
    {
        Artisan::call('optimize:clear');

        $also = DIRECTORY_SEPARATOR === '/' ? ';' : '&&';

        if (config('base.app_local')) {
            $output = shell_exec('git pull 2>&1');
            if (Str::contains($output, 'Already up to date.')) {
                return redirect()->back()->with($this->alertSuccess('Already up to date.'));
            }

            $output = shell_exec("cd " . base_path() . $also . " composer install --optimize-autoloader --no-progress --no-suggest --no-interaction 2>&1");

            Artisan::call('vendor:publish --force --no-interaction');
        } else {

            $output1 = shell_exec('git pull origin develop 2>&1');
            $output1 = shell_exec('git pull origin master 2>&1');

            //$output2 = shell_exec('git merge develop 2>&1');

            if (Str::contains($output1, 'Already up to date.')) {
                return redirect()->back()->with($this->alertSuccess('Already up to date.'));
            }

            // if (Str::contains($output2, 'conflict')) {
            //     return redirect()->back()->with($this->alertSuccess('Branch has a conflict'));
            // }

            $output = shell_exec("cd " . base_path() . $also . " composer install --optimize-autoloader --no-dev 2>&1");

            Artisan::call('route:cache');

            Artisan::call('view:cache');

            Artisan::call('config:cache');
        }

        return redirect()->route('voyager.bread.index')->with($this->alertSuccess('Successfully updated.'));
    }
}
