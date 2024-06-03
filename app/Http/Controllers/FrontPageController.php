<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategories;
use App\Models\Articles;
use App\Models\Wahana;
use App\Models\FAQ;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\LazyCollection;
use League\Csv\Reader;
use App\Models\Reviews;

class FrontPageController extends Controller
{
    public function index(){
        $reviews = Reader::createFromPath('reviews.csv');
        $reviews->setHeaderOffset(0);
        $reviews->getRecords();

        return view('frontends.home.index')
                ->with([
                    'title' => 'Beranda',
                    'wahana' => Wahana::with(['images'])->limit(6)->get(),
                    'profile' => Articles::where('url', 'tentang-kami')->first(),
                    'reviews' => $reviews
                ]);
    }

    public function about(){
        $data = Articles::where('url', 'tentang-kami')->first();

        if(isset($data)){
            return view('frontends.pages.about')
                    ->with([
                        'title' => 'Tentang Kami',
                        'cms' => $data
                    ]);
        }else{
            abort(404);
        }
    }

    public function contact(){
        return view('frontends.pages.contact')
                ->with([
                    'title' => 'Kontak',
                ]);
    }

    public function faq(){
        $data = Cache::remember('faq', 0, function () {
            return FAQ::all();
        });

        if(isset($data)){
            return view('frontends.pages.faq')
                    ->with([
                        'title' => 'FAQ',
                        'faqs' => $data,
                        'wahana' => Wahana::with(['images'])->limit(3)->get()
                    ]);
        }else{
            abort(404);
        }
    }

    public function privacy_policy(){
        $data = Cache::remember('privacy_policy', 0, function () {
            return Articles::where('url', 'kebijakan-privacy')->first();
        });

        if(isset($data)){
            return view('frontends.pages.privacy_policy')
                    ->with([
                        'title' => 'Privacy Policy',
                        'cms' => $data
                    ]);
        }else{
            abort(404);
        }
    }

    public function syarat_ketentuan(){
        $data = Cache::remember('syarat_ketentuan', 0, function () {
            return Articles::where('url', 'syarat-&-ketentuan')->first();
        });

        if(isset($data)){
            return view('frontends.pages.syarat_ketentuan')
                    ->with([
                        'title' => 'Syarat & Ketentuan',
                        'cms' => $data
                    ]);
        }else{
            abort(404);
        }
    }
    
    public function wahana(){
        $data = Wahana::with(['images'])->get();

        return view('frontends.pages.wahana')
                ->with([
                    'title' => 'Paket Wisata',
                    'wahana' => $data,
                    'profile' => Articles::where('url', 'tentang-kami')->first(),
                ]);
    }

    public function wahana_detail($slug){
        $data = Wahana::with(['images', 'facilities', 'rooms'])->where('slug', $slug)->first();
        $review = Reviews::where('wahana_id', $data->id)->get();

        if(isset($data)){
            return view('frontends.pages.wahana_detail')
                    ->with([
                        'title' => ucwords(strtolower($data->name)),
                        'data' => $data,
                        'reviews' => $review
                    ]);
        }else{
            abort(404);
        }
    }

    public function blog_category($url){
        $category = ArticleCategories::where('url', $url)->first();
        
        if(isset($category)){
            return view('frontends.pages.blog_category')
                    ->with([
                        'title' => 'Kategori Blog',
                        'category' => $category,
                        'posts' => Articles::with(['category'])->where('category_id', $category->id)->get(),
                    ]);
        }else{
            abort(404);
        }
    }

    public function post($category_url, $url){
        $post = Articles::with(['category'])->where('url', $url)->first();

        if(isset($post)){
            return view('frontends.pages.post')
                    ->with([
                        'title' => $post->title,
                        'post' => $post,
                    ]);
        }else{
            abort(404);
        }
    }
}
