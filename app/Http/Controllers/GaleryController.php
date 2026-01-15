<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GaleryController extends Controller
{
    /**
     * Display the gallery page with Livewire component.
     */
    public function index(Request $request): View
    {
        return view('web.pages.galery');
    }

    /**
     * Track a view for a gallery item.
     */
    public function trackView(int $id): JsonResponse
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json([
                'success' => false,
                'message' => 'Gallery item not found'
            ], 404);
        }

        $gallery->incrementClick();

        return response()->json([
            'success' => true,
            'message' => 'View tracked successfully',
            'total_clicks' => $gallery->fresh()->total_click
        ]);
    }

    /**
     * Track a download for a gallery item.
     */
    public function trackDownload(int $id): JsonResponse
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json([
                'success' => false,
                'message' => 'Gallery item not found'
            ], 404);
        }

        $gallery->incrementDownload();

        return response()->json([
            'success' => true,
            'download_url' => route('gallery.download', $id),
            'total_downloads' => $gallery->fresh()->total_download
        ]);
    }

    /**
     * Download a gallery image.
     */
    public function download(int $id)
    {
        $gallery = Gallery::findOrFail($id);
        $filePath = storage_path('app/public/' . $gallery->path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        $extension = pathinfo($gallery->path, PATHINFO_EXTENSION);
        $filename = $gallery->title . '.' . $extension;

        return response()->download($filePath, $filename);
    }
}
