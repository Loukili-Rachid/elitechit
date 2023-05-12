<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Law;
use App\Models\Plan;
use App\Models\Post;
use App\Models\Quote;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\Question;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Support\Facades\Cookie;

use Artesaos\SEOTools\Facades\SEOMeta;
use App\Http\Requests\StoreQuoteRequest;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use App\Http\Requests\StoreQuestionRequest;


class HomeController extends Controller
{
    public function index()
    {
        // Meta tags Generator
        SEOMeta::setTitle(setting('site.title'));
        SEOMeta::setDescription(setting('site.description'));
        SEOMeta::addKeyword(['Computer Repair Services', 'elitch', 'Mobile', 'Laptop']);
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

        $sliders = Slider::orderBy('order', 'ASC')
            ->where('active', true)
            ->get();
        $services = App()->services;
        $posts = Post::where('active', true)
            ->orderBy('id', 'ASC')
            ->paginate(config('base.pagination'));

        return view('welcome', [
            "services" => $services->take(6),
            'topServices' => $services->take(3),
            'sliders' => $sliders,
            'posts' => $posts,
        ]);
    }

    public function gallery($all = null)
    {

        // Meta tags Generator
        SEOMeta::setTitle(setting('site.title'));
        SEOMeta::setDescription(setting('site.description'));
        SEOMeta::addKeyword(['Computer Repair Services', 'elitch', 'Mobile', 'Laptop']);
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

        $galleries = Gallery::orderBy('id', 'ASC')->get();
        $status = true;
        if ($all == "all") {
            $status = false;
        } else {
            $galleries = $galleries->take(8);
        }
        return view('gallery', [
            "galleries" => $galleries,
            "background" => $galleries->where('info', true)->first()->image ?? '',
            "all" => $status
        ]);
    }

    public function faq()
    {
        $faqs = Faq::all();

        $arr = array('Computer Repair Services', 'elitch', 'Mobile', 'Laptop');
        foreach ($faqs as $faq) {
            array_push($arr, $faq->question, $faq->response);
        }

        // Meta tags Generator
        SEOMeta::setTitle(setting('site.title'));
        SEOMeta::setDescription(setting('site.description'));
        SEOMeta::addKeyword($arr);
        // Opengraph tags Generator
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::setDescription(setting('site.title'));
        OpenGraph::setTitle(setting('site.title'));
        OpenGraph::addProperty('type', 'section');
        // Twitter for Twitter Cards tags Generator
        TwitterCard::setTitle(setting('site.title'));
        TwitterCard::setSite('@elitch');
        // json-Ld tags Generator
        JsonLd::setTitle(setting('site.title'));
        JsonLd::setDescription(setting('site.description'));

        return view('faq', [
            "faqs" => $faqs,
            "background" => $faqs->where('info', true)->first()->background ?? '',
        ]);
    }

    public function question(StoreQuestionRequest $request)
    {
        $validated = $request->validated();
        Question::create($validated);
        return back()->with('success', "sent successfully ");
    }
    public function quote(StoreQuoteRequest $request)
    {
        $validated = $request->validated();
        Quote::create($validated);
        return back()->with('success', "sent successfully ");
    }

    public function law()
    {
        $lows = Law::where('active', true)
            ->orderBy('id', 'ASC')
            ->get();

        $arr = array('Computer Repair Services', 'elitch', 'Mobile', 'Laptop');
        foreach ($lows as $low) {
            array_push($arr, $low->title,);
        }

        // Meta tags Generator
        SEOMeta::setTitle(setting('site.title'));
        SEOMeta::setDescription(setting('site.description'));
        SEOMeta::addKeyword($arr);
        // Opengraph tags Generator
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::setDescription(setting('site.title'));
        OpenGraph::setTitle(setting('site.title'));
        OpenGraph::addProperty('type', 'section');
        // Twitter for Twitter Cards tags Generator
        TwitterCard::setTitle(setting('site.title'));
        TwitterCard::setSite('@elitch');
        // json-Ld tags Generator
        JsonLd::setTitle(setting('site.title'));
        JsonLd::setDescription(setting('site.description'));

        return view('privacy-policy', [
            'lows' => $lows,
            'background'=>$lows->where('info', true)->first()->background ?? '',
        ]);
    }
    public function createCookie(){
        if (!Cookie::get('elitechit-cookie') && app()->cookies) {
            Cookie::queue('elitechit-cookie', 'Setting Our Cookie just to notice user', 120);
        }
        return redirect()->back();
    }
}
