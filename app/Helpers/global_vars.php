<?php

use App\Models\Divider;
use App\Models\MenuItem;
use App\Models\Contacts;
use Illuminate\Support\Facades\Cache;
use App\Models\ArticleCategories;


function getSidebar()
{
    $divider = Cache::remember('divider', 3600, function () {
        return Divider::orderBy('order', 'asc')->get();
    });

    $data = Cache::remember('user_menu', 3600, function () {
        return MenuItem::with('children')
                ->whereNull('parent_id')
                ->orderBy('divider_id', 'asc')
                ->orderBy('order', 'asc')->get();
    });
    return view('includes.sidebar_user')
            ->with([
                'divider' => $divider,
                'menus' => $data
            ]);
}

function getContact()
{
    return Cache::remember('contact', 3600, function () {
        return Contacts::first();
    });
}

function getBlogCategories()
{
    return Cache::remember('blog_categories', 3600, function (){
        return ArticleCategories::whereNotIn('id', [1,3,4])->get();
    });
}