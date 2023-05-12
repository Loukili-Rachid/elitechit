<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function search(Request $request){
        $output = '';
        
        $validator = Validator::make($request->all(), [
            'term' => 'required|string|between:2,50|regex:/(^([a-zA-z0-9 ]+)(\d+)?$)/u',
        ])->stopOnFirstFailure(true);
 
        if ($validator->fails()) { 
            $output = '<span class="ml-2 mb-2 badge badge-danger">'. $validator->errors()->first().' </span>';
        }
       
        $posts = Post::select('title','slug')->where('title', 'like', '%'.$request->term.'%')->where('active','=',true)->orderBy('updated_at','DESC')->take(5)->get();
        $services = Service::select('name','slug')->where('name', 'like', '%'.$request->term.'%')->orderBy('updated_at','DESC')->take(5)->get() ;
        $faqs = Faq::select('question')->where('question', 'like', '%'.$request->term.'%')->orderBy('updated_at','DESC')->take(5)->get() ;
        
        if($services)
        {
            foreach ($services as $key => $service) {
                $service_result = explode('|',$service->name);
                $output.= '<div><a href="'.url('service-details/'.$service->slug).'">'.$service_result[0].'</a><span class="ml-2 mb-2 badge badge-primary">Services</span></div>';
            } 
        }

        if($posts)
        {
            foreach ($posts as $key => $post) {
                $post_result = explode('|',$post->title);
                $output.= '<div><a href="'.url('blog-details/'.$post->slug).'">'.$post_result[0].'</a><span class="ml-2 mb-2 badge badge-dark">Posts</span></div>';
            }
        }

        if($faqs)
        {
            foreach ($faqs as $key => $faq) {
                $faq_result = explode('|',$faq->question);
                $output.= '<div><a href="'.url('faq').'">'.$faq_result[0].'</a><span class="ml-2 mb-2 badge badge-secondary">Faqs</span></div>';
            }
        }

        if($output){
            return Response('<div class="data">'.$output.'</div>');
        }else{ 
            return '<div class="data">There are no results that match your search</div>';
        }
    }
}
