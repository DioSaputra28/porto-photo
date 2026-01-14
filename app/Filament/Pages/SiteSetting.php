<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Filament\Support\Icons\Heroicon;

class SiteSetting extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string $settings = GeneralSetting::class;

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $title = 'Site Settings';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // General Information Section
                Section::make('General Information')
                    ->description('Basic information about your photography portfolio')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Site Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., John Doe Photography')
                            ->helperText('The name of your photography business'),
                    ])
                    ->columns(1),

                // Branding Section
                Section::make('Branding & Assets')
                    ->description('Upload your logo, favicon, and profile picture')
                    ->schema([
                        FileUpload::make('site_logo')
                            ->label('Site Logo')
                            ->disk('public')
                            ->directory('branding')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->maxSize(2048)
                            ->helperText('Recommended size: 500x200px (PNG/JPG, max 2MB)')
                            ->openable()
                            ->downloadable(),

                        FileUpload::make('site_favicon')
                            ->label('Site Favicon')
                            ->disk('public')
                            ->directory('branding')
                            ->image()
                            ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/svg+xml'])
                            ->maxSize(512)
                            ->helperText('Recommended: 32x32px or 64x64px (ICO/PNG/SVG, max 512KB)')
                            ->openable()
                            ->downloadable(),

                        FileUpload::make('site_profile_picture')
                            ->label('Profile Picture')
                            ->disk('public')
                            ->directory('branding')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                            ])
                            ->maxSize(2048)
                            ->helperText('Your professional photo (Square, max 2MB)')
                            ->openable()
                            ->downloadable()
                            ->avatar(),
                    ])
                    ->columns(3)
                    ->collapsible(),

                // Contact Information Section
                Section::make('Contact Information')
                    ->description('How clients can reach you')
                    ->schema([
                        TextInput::make('site_email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->placeholder('contact@example.com')
                            ->prefixIcon('heroicon-o-envelope')
                            ->validationMessages([
                                'email' => 'Please enter a valid email address',
                            ]),

                        TextInput::make('site_phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('+62 812 3456 7890')
                            ->prefixIcon('heroicon-o-phone')
                            ->helperText('Include country code'),

                        TextInput::make('site_whatsapp')
                            ->label('WhatsApp Number')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('628123456789')
                            ->prefixIcon('heroicon-o-chat-bubble-left-right')
                            ->helperText('Format: 628xxx (without + or spaces)'),

                        Textarea::make('site_address')
                            ->label('Business Address')
                            ->rows(3)
                            ->maxLength(500)
                            ->placeholder('Street, City, Province, Postal Code')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->collapsible(),

                // Social Media Section
                Section::make('Social Media Links')
                    ->description('Connect your social media profiles')
                    ->schema([
                        TextInput::make('site_facebook')
                            ->label('Facebook')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://facebook.com/yourpage')
                            ->prefixIcon('heroicon-o-link')
                            ->validationMessages([
                                'url' => 'Please enter a valid URL starting with https://',
                            ]),

                        TextInput::make('site_instagram')
                            ->label('Instagram')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://instagram.com/yourusername')
                            ->prefixIcon('heroicon-o-link'),

                        TextInput::make('site_twitter')
                            ->label('Twitter / X')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://twitter.com/yourusername')
                            ->prefixIcon('heroicon-o-link'),

                        TextInput::make('site_youtube')
                            ->label('YouTube')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://youtube.com/@yourchannel')
                            ->prefixIcon('heroicon-o-link'),

                        TextInput::make('site_tiktok')
                            ->label('TikTok')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://tiktok.com/@yourusername')
                            ->prefixIcon('heroicon-o-link'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Google Maps Section
                Section::make('Location & Maps')
                    ->description('Embed your business location')
                    ->schema([
                        Textarea::make('site_gmaps_embed')
                            ->label('Google Maps Embed Code')
                            ->rows(4)
                            ->placeholder('<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450"></iframe>')
                            ->helperText('Paste the full iframe embed code from Google Maps')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->collapsible(),
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $settings = app(GeneralSetting::class);

        // Handle site_logo deletion
        if (isset($data['site_logo'])) {
            $newLogoPath = $data['site_logo'];
            $oldLogoPath = $settings->site_logo;

            if ($oldLogoPath && $newLogoPath !== $oldLogoPath && Storage::disk('public')->exists($oldLogoPath)) {
                Storage::disk('public')->delete($oldLogoPath);
            }
        } elseif ($settings->site_logo) {
            if (Storage::disk('public')->exists($settings->site_logo)) {
                Storage::disk('public')->delete($settings->site_logo);
            }
        }

        // Handle site_favicon deletion
        if (isset($data['site_favicon'])) {
            $newFaviconPath = $data['site_favicon'];
            $oldFaviconPath = $settings->site_favicon;

            if ($oldFaviconPath && $newFaviconPath !== $oldFaviconPath && Storage::disk('public')->exists($oldFaviconPath)) {
                Storage::disk('public')->delete($oldFaviconPath);
            }
        } elseif ($settings->site_favicon) {
            if (Storage::disk('public')->exists($settings->site_favicon)) {
                Storage::disk('public')->delete($settings->site_favicon);
            }
        }

        // Handle site_profile_picture deletion
        if (isset($data['site_profile_picture'])) {
            $newProfilePath = $data['site_profile_picture'];
            $oldProfilePath = $settings->site_profile_picture;

            if ($oldProfilePath && $newProfilePath !== $oldProfilePath && Storage::disk('public')->exists($oldProfilePath)) {
                Storage::disk('public')->delete($oldProfilePath);
            }
        } elseif ($settings->site_profile_picture) {
            if (Storage::disk('public')->exists($settings->site_profile_picture)) {
                Storage::disk('public')->delete($settings->site_profile_picture);
            }
        }

        return $data;
    }
}
