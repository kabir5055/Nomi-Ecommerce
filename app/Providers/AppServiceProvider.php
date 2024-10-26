<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\General;
use App\Models\Logo;
use App\Models\Category;
use App\Models\LinkType;
use App\Models\Social;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        view()->share('general', General::latest()->first());
        view()->share('logo', Logo::latest()->first());
        view()->share('frontCategories', Category::oldest()->get());

        $linkTypes = LinkType::with(['links' => function ($query) {
            $query->where('status', 1);
        }])->where('status', 1)->get();
        
        view()->share('linkTypes',$linkTypes);

        $social = Social::latest()->first();
        view()->share('social',$social);
    }
}
