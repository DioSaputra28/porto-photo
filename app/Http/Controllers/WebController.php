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

    /**
     * Display the services page.
     */
    public function services()
    {
        $services = [
            [
                'title' => 'Wedding Photography',
                'description' => 'Capturing the magic of your special day with a cinematic touch. From candid moments to staged portraits, we ensure every emotion is preserved forever.',
                'icon' => 'ri-hearts-line',
                'price' => 'Starting from $1,500'
            ],
            [
                'title' => 'Graduation / Wisuda',
                'description' => 'Celebrate your academic achievements with professional portraits. Individual sessions or group photos with family and friends.',
                'icon' => 'ri-graduation-cap-line',
                'price' => 'Starting from $200'
            ],
            [
                'title' => 'Portrait & Editorial',
                'description' => 'Professional headshots, fashion editorials, and personal branding sessions designed to make you stand out.',
                'icon' => 'ri-user-star-line',
                'price' => 'Starting from $300'
            ],
            [
                'title' => 'Event Documentation',
                'description' => 'Comprehensive coverage for corporate events, parties, religious ceremonies, and community gatherings.',
                'icon' => 'ri-calendar-event-line',
                'price' => 'Starting from $500'
            ],
            [
                'title' => 'Product Photography',
                'description' => 'High-quality images for your e-commerce or catalog. We highlight the details that make your product unique.',
                'icon' => 'ri-shopping-bag-3-line',
                'price' => 'Starting from $150'
            ],
            [
                'title' => 'Couple & Pre-Wedding',
                'description' => 'Romantic sessions to tell your love story before the big day. Choose your favorite location or let us suggest one.',
                'icon' => 'ri-emotion-happy-line',
                'price' => 'Starting from $400'
            ],
        ];

        return view('web.pages.service', compact('services'));
    }
}
