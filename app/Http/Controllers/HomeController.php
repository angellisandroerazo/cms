<?php

namespace App\Http\Controllers;

use App\Models\ExtraPage;
use App\Models\System;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $info_site = System::select('landing_image', 'landing_title', 'landing_body')->first();

        if (!$info_site) {
            return view("system.errors.no-data");
        }

        return view("system.home", compact("info_site"));
    }

    public function contact()
    {

        $contact = System::select(
            'contact',
            'contact_title',
            'contact_body',
            'linkedin',
            'linkedin_link',
            'facebook',
            'facebook_link',
            'x',
            'x_link',
            'youtube',
            'youtube_link',
            'instagram',
            'instagram_link',
            'has_email',
            'e_mail',
            'has_phone',
            'phone',
            'has_direction',
            'direction',
        )->first();

        if (!$contact || !$contact->contact) {
            return redirect()->route('home');
        }

        return view("system.contact", compact("contact"));
    }

    public function about()
    {

        $about = System::select('about', 'about_title', 'about_body')->first();

        if (!$about || !$about->about) {
            return redirect()->route('home');
        }

        return view("system.about", compact("about"));
    }

    public function extraPage($slug)
    {
        $extra_page = ExtraPage::where('slug', $slug)
            ->where('show', true)
            ->first();

        if (!$extra_page) {
            return redirect()->route('home');
        }

        return view("system.extra-page", compact("extra_page"));
    }


}
