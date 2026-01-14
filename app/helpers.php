<?php

use App\Settings\GeneralSetting;
use Illuminate\Support\Facades\Storage;

if (!function_exists('get_site_name')) {
    /**
     * Get the site name from settings.
     */
    function get_site_name(): string
    {
        return app(GeneralSetting::class)->site_name ?? config('app.name', 'Laravel');
    }
}

if (!function_exists('get_site_logo')) {
    /**
     * Get the site logo URL from settings.
     */
    function get_site_logo(): ?string
    {
        $logo = app(GeneralSetting::class)->site_logo;

        if (!$logo) {
            return null;
        }

        // If it's already a full URL, return it
        if (filter_var($logo, FILTER_VALIDATE_URL)) {
            return $logo;
        }

        // Otherwise, generate storage URL
        return Storage::url($logo);
    }
}

if (!function_exists('get_site_favicon')) {
    /**
     * Get the site favicon URL from settings.
     */
    function get_site_favicon(): ?string
    {
        $favicon = app(GeneralSetting::class)->site_favicon;

        if (!$favicon) {
            return null;
        }

        if (filter_var($favicon, FILTER_VALIDATE_URL)) {
            return $favicon;
        }

        return Storage::url($favicon);
    }
}

if (!function_exists('get_site_profile_picture')) {
    /**
     * Get the site profile picture URL from settings.
     */
    function get_site_profile_picture(): ?string
    {
        $picture = app(GeneralSetting::class)->site_profile_picture;

        if (!$picture) {
            return null;
        }

        if (filter_var($picture, FILTER_VALIDATE_URL)) {
            return $picture;
        }

        return Storage::url($picture);
    }
}

if (!function_exists('get_site_whatsapp')) {
    /**
     * Get the site WhatsApp number from settings.
     */
    function get_site_whatsapp(): ?string
    {
        return app(GeneralSetting::class)->site_whatsapp;
    }
}

if (!function_exists('get_site_whatsapp_url')) {
    /**
     * Get the WhatsApp URL with formatted number.
     */
    function get_site_whatsapp_url(?string $message = null): ?string
    {
        $whatsapp = get_site_whatsapp();

        if (!$whatsapp) {
            return null;
        }

        // Remove non-numeric characters
        $number = preg_replace('/[^0-9]/', '', $whatsapp);

        // Build WhatsApp URL
        $url = "https://wa.me/{$number}";

        if ($message) {
            $url .= '?text=' . urlencode($message);
        }

        return $url;
    }
}

if (!function_exists('get_site_email')) {
    /**
     * Get the site email from settings.
     */
    function get_site_email(): ?string
    {
        return app(GeneralSetting::class)->site_email;
    }
}

if (!function_exists('get_site_phone')) {
    /**
     * Get the site phone number from settings.
     */
    function get_site_phone(): ?string
    {
        return app(GeneralSetting::class)->site_phone;
    }
}

if (!function_exists('get_site_address')) {
    /**
     * Get the site address from settings.
     */
    function get_site_address(): ?string
    {
        return app(GeneralSetting::class)->site_address;
    }
}

if (!function_exists('get_site_facebook')) {
    /**
     * Get the site Facebook URL from settings.
     */
    function get_site_facebook(): ?string
    {
        return app(GeneralSetting::class)->site_facebook;
    }
}

if (!function_exists('get_site_instagram')) {
    /**
     * Get the site Instagram URL from settings.
     */
    function get_site_instagram(): ?string
    {
        return app(GeneralSetting::class)->site_instagram;
    }
}

if (!function_exists('get_site_twitter')) {
    /**
     * Get the site Twitter URL from settings.
     */
    function get_site_twitter(): ?string
    {
        return app(GeneralSetting::class)->site_twitter;
    }
}

if (!function_exists('get_site_youtube')) {
    /**
     * Get the site YouTube URL from settings.
     */
    function get_site_youtube(): ?string
    {
        return app(GeneralSetting::class)->site_youtube;
    }
}

if (!function_exists('get_site_tiktok')) {
    /**
     * Get the site TikTok URL from settings.
     */
    function get_site_tiktok(): ?string
    {
        return app(GeneralSetting::class)->site_tiktok;
    }
}

if (!function_exists('get_site_gmaps_embed')) {
    /**
     * Get the site Google Maps embed URL from settings.
     */
    function get_site_gmaps_embed(): ?string
    {
        return app(GeneralSetting::class)->site_gmaps_embed;
    }
}

if (!function_exists('get_social_media_links')) {
    /**
     * Get all social media links as an array.
     */
    function get_social_media_links(): array
    {
        return array_filter([
            'facebook' => get_site_facebook(),
            'instagram' => get_site_instagram(),
            'twitter' => get_site_twitter(),
            'youtube' => get_site_youtube(),
            'tiktok' => get_site_tiktok(),
        ]);
    }
}

if (!function_exists('get_contact_info')) {
    /**
     * Get all contact information as an array.
     */
    function get_contact_info(): array
    {
        return array_filter([
            'whatsapp' => get_site_whatsapp(),
            'email' => get_site_email(),
            'phone' => get_site_phone(),
            'address' => get_site_address(),
        ]);
    }
}
