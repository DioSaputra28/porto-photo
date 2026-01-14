<?php

namespace App\Filament\Widgets;

use App\Models\Gallery;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TopImageWidget extends TableWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Gallery::query()
                    ->select('*', DB::raw('(total_click + total_download) as total_engagement'))
                    ->orderByDesc('total_engagement')
                    ->limit(5)
            )
            ->heading('Top 5 Most Popular Images')
            ->description('Based on total clicks and downloads')
            ->columns([
                TextColumn::make('rank')
                    ->label('Rank')
                    ->state(fn($rowLoop) => $rowLoop->index + 1)
                    ->alignCenter(),

                ImageColumn::make('path')
                    ->label('Image')
                    ->disk('public')
                    ->size(60)
                    ->square(),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->weight('bold')
                    ->wrap(),

                TextColumn::make('total_click')
                    ->label('Clicks')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->color('success'),

                TextColumn::make('total_download')
                    ->label('Downloads')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->color('info'),

                TextColumn::make('total_engagement')
                    ->label('Total')
                    ->state(fn(Gallery $record) => $record->total_click + $record->total_download)
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->weight('bold')
                    ->color('warning'),
            ])
            ->paginated(false);
    }
}
