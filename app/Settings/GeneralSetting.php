<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSetting extends Settings
{
    public string $site_name;
    public ?string $site_logo;
    public ?string $site_favicon;
    public ?string $site_profile_picture;
    public ?string $site_whatsapp;
    public ?string $site_email;
    public ?string $site_phone;
    public ?string $site_address;
    public ?string $site_facebook;
    public ?string $site_instagram;
    public ?string $site_twitter;
    public ?string $site_youtube;
    public ?string $site_tiktok;
    public ?string $site_gmaps_embed;

    public static function group(): string
    {
        return 'general';
    }
}
