<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Get 5 random gallery images for homepage
        $galleries = Gallery::inRandomOrder()
            ->limit(5)
            ->get();

        return view('welcome', compact('galleries'));
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('web.pages.contact');
    }
}
