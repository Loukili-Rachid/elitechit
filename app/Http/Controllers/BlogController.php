<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Carbon;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class BlogController extends Controller
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

        $posts = Post::where('active', true)
        ->orderBy('id', 'ASC')
        ->paginate(config('base.pagination'));
        return view('blog',[
            'posts'=>$posts,
            'background'=>$posts->where('info', true)->first()->img ?? '',
        ]);
    }

    public function post($slug){
        $latestPosts = Post::where('active', true)
        ->orderBy('id', 'ASC')
        ->get();
        $post = $latestPosts->where('slug', $slug)->where('active', true)->firstOrFail();

        // Meta tags Generator
        SEOMeta::setTitle($slug ." ".Carbon::parse($post['updated_at'])->format('d-m-Y h:m:s'));
        SEOMeta::setDescription(setting('site.description'));
        SEOMeta::addKeyword(['Computer Repair Services', 'elitch', 'Mobile','Laptop',$post->title]);
        // Opengraph tags Generator
        OpenGraph::setUrl(env('APP_URL'));
        OpenGraph::setDescription(setting('site.description'));
        OpenGraph::setTitle($slug ." ".Carbon::parse($post['updated_at'])->format('d-m-Y h:m:s'));
        OpenGraph::addProperty('type', 'section');
        // Twitter for Twitter Cards tags Generator
        TwitterCard::setTitle($slug ." ".Carbon::parse($post['updated_at'])->format('d-m-Y h:m:s'));
        TwitterCard::setSite('@elitch');
        // json-Ld tags Generator
        JsonLd::setTitle($slug ." ".Carbon::parse($post['updated_at'])->format('d-m-Y h:m:s'));
        JsonLd::setDescription(setting('site.description'));

        return view('blog-details',[
            'post'=>$post,
            'background'=>$post->where('info', true)->first()->img ?? '',
            'latestPosts'=>$latestPosts->take(5)
        ]);
    }
}
