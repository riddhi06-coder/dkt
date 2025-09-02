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
use App\Models\Products;
use App\Models\ProductDetails;
use App\Models\PrivacyPolicy;
use App\Models\Terms;
use App\Models\ContactDetail;
use App\Models\DoctorPartner;
use App\Models\ChemistPartner;
use App\Models\DistributorPartner;
use App\Models\JobOpening;
use App\Models\JoinPageDetail;


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

    // === Category Details
    public function category_details($slug)
    {
        $category = ProductCategory::where('slug', $slug)
            ->whereNull('deleted_by') 
            ->with([
                'details' => function($query) {
                    $query->whereNull('deleted_by'); 
                },
                'products' => function($query) {
                    $query->whereNull('deleted_by'); 
                }
            ])
            ->firstOrFail();

            if (!$category->details || 
                empty($category->details->description) || 
                empty($category->details->thumbnail_image)) {
                abort(404); 
            }


        return view('frontend.category_details', compact('category'));
    }

    // === Product List
    public function product_list()
    {
        $product_list = ProductCategory::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get(); 
        return view('frontend.product_list', compact('product_list'));
    }

    // Product details
    public function product_details($slug)
    {
        $product = DB::table('product_details as pd')
            ->leftJoin('products as p', 'pd.product_id', '=', 'p.id')
            ->leftJoin('product_category as c', 'p.category_id', '=', 'c.id')
            ->select(
                'pd.id as detail_id',
                'pd.product_id',
                'pd.thumbnail_image as detail_thumbnail',
                'pd.product_image',
                'pd.buy_now',
                'pd.description',
                'pd.use_of_tablet',
                'pd.direction_to_use',
                'pd.composition',
                'p.product_name',
                'p.slug as product_slug',
                'c.category_name',
                'c.slug as category_slug'
            )
            ->where('p.slug', $slug)
            ->whereNull('pd.deleted_by')
            ->first();

        if (!$product) {
            abort(404);
        }

        return view('frontend.product_details', compact('product'));
    }

    // === Privacy Policy
    public function privacy_policy() {
        $privacy_policy = PrivacyPolicy::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->get();
        return view('frontend.privacy_policy', compact('privacy_policy'));
    }

    // === Terms & Condition
    public function terms_condition() {
        $terms_condition = Terms::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->get();
        return view('frontend.terms_condition', compact('terms_condition'));
    }

    // === Contact Us
    public function contact_us() {
        $contact_us = ContactDetail::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->get();
        return view('frontend.contact_us', compact('contact_us'));
    }

    // === I am a Doctor
    public function i_am_doctor() {
        $i_am_doctor = DoctorPartner::wherenull('deleted_by')->first();
        return view('frontend.i_am_doctor', compact('i_am_doctor'));
    }

    // === I am a Chemist
    public function i_am_chemist() {
        $i_am_chemist = ChemistPartner::wherenull('deleted_by')->first();
        return view('frontend.i_am_chemist', compact('i_am_chemist'));
    }

    // === I am a Distributor
    public function i_am_distributor() {
        $i_am_distributor = DistributorPartner::wherenull('deleted_by')->first();
        return view('frontend.i_am_distributor', compact('i_am_distributor'));
    }


    // === Join Us
    public function join_us() {
        $join_us = JoinPageDetail::wherenull('deleted_by')->first();
        $features = json_decode($join_us->features, true);
        $openings = JobOpening::wherenull('deleted_by')->get();
        return view('frontend.join_us', compact('join_us','features','openings'));
    }





}