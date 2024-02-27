<?php

use App\Models\Divider;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Cache;


if(!function_exists('getSidebar')){
    function getSidebar()
    {
        $divider = Cache::remember('divider', 1800, function () {
            return Divider::orderBy('order', 'asc')->get();
        });

        $data = Cache::remember('user_menu', 1800, function () {
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
}