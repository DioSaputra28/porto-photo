<?php

namespace App\Filament\Widgets;

use App\Models\Gallery;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = now()->startOfDay();

        $totalClickToday = Gallery::whereDate('updated_at', $today)->sum('total_click');
        $totalDownloadToday = Gallery::whereDate('updated_at', $today)->sum('total_download');
        $totalFeaturedImages = Gallery::where('is_featured', true)->count();
        $totalImages = Gallery::count();

        return [
            Stat::make('Total Click Today', number_format($totalClickToday))
                ->description('Clicks received today')
                ->descriptionIcon('heroicon-m-cursor-arrow-ripple')
                ->color('success'),

            Stat::make('Total Download Today', number_format($totalDownloadToday))
                ->description('Downloads received today')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('info'),

            Stat::make('Total Featured Image', number_format($totalFeaturedImages))
                ->description('Images marked as featured')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),

            Stat::make('Total Image', number_format($totalImages))
                ->description('Total images in gallery')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'),
        ];
    }
}
