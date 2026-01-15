<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Service;
use App\Settings\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(GeneralSetting $settings): View
    {
        $services = Service::orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('web.pages.service.index', compact('services', 'settings'));
    }

    /**
     * Display the specified service.
     */
    public function show(string $slug, GeneralSetting $settings): View
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        // Get gallery images from the same category
        $sampleImages = collect();
        if ($service->category_id) {
            $sampleImages = Gallery::where('category_id', $service->category_id)
                ->orderBy('created_at', 'desc')
                ->limit(8)
                ->get();
        }

        return view('web.pages.service.single', compact('service', 'settings', 'sampleImages'));
    }
}
