<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\HomeBanner;
use App\Models\HomeIntro;
use App\Models\ProductCategory;
use App\Models\HomeSocial;
use App\Models\VisionMission;
use App\Models\AboutUs;


class HomeController extends Controller
{

    // === Home
    public function home() {
        $homeBanners = HomeBanner::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->get();
        $intro = HomeIntro::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $productCategories = ProductCategory::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();
        $socialGallery = HomeSocial::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get(); 
        $visionMissions = VisionMission::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get(); 
        return view('frontend.index', compact('homeBanners','intro','productCategories','socialGallery','visionMissions'));
    }

    // === About
    public function about_us()
    {
        // ✅ Fetch latest About Us entry
        $about = AboutUs::wherenull('deleted_by')->first();
        $visionMissions = VisionMission::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get(); 

        return view('frontend.about_us', compact('about','visionMissions'));
    }

}