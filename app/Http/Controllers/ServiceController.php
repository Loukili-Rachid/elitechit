<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class ServiceController extends Controller
{
    public function index(){

        // Meta tags Generator
        SEOMeta::setTitle(setting('site.title'));
        SEOMeta::setDescription(setting('site.description'));
        SEOMeta::addKeyword(['Computer Repair Services', 'elitch', 'Mobile','Laptop']);
        // Opengraph tags Generator
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::setDescription(setting('site.description'));
        OpenGraph::setTitle(setting('site.title'));
        OpenGraph::addProperty('type', 'section');
        // Twitter for Twitter Cards tags Generator
        TwitterCard::setTitle(setting('site.title'));
        TwitterCard::setSite('@elitch');
        // json-Ld tags Generator
        JsonLd::setTitle(setting('site.title'));
        JsonLd::setDescription(setting('site.description'));

        $services = App()->services;
        return view('services',
        [
            "services"=>$services,
            "background"=>$services->where('info', true)->first()->background ?? '',
        ]);
    }

    public function service($slug){
        $services = App()->services;
        $service= $services->where('slug', $slug)->firstOrFail();

        // Meta tags Generator
        SEOMeta::setTitle($slug ." ".Carbon::parse($service['updated_at'])->format('d-m-Y h:m:s'));
        SEOMeta::setDescription(setting('site.description'));
        SEOMeta::addKeyword(['Computer Repair Services', 'elitch', 'Mobile','Laptop',$service->name]);
        // Opengraph tags Generator
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::setDescription(setting('site.description'));
        OpenGraph::setTitle($slug ." ".Carbon::parse($service['updated_at'])->format('d-m-Y h:m:s'));
        OpenGraph::addProperty('type', 'section');
        // Twitter for Twitter Cards tags Generator
        TwitterCard::setTitle($slug ." ".Carbon::parse($service['updated_at'])->format('d-m-Y h:m:s'));
        TwitterCard::setSite('@elitch');
        // json-Ld tags Generator
        JsonLd::setTitle($slug ." ".Carbon::parse($service['updated_at'])->format('d-m-Y h:m:s'));
        JsonLd::setDescription(setting('site.description'));

        return view('service-details',[
            'service'=>$service,
            'services'=>$services->take(6),
            "background"=>$services->where('info', true)->first()->background ?? '',
        ]);
    }
}
