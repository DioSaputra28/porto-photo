<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Basic Information')
                    ->description('Enter the basic details of the service')
                    ->icon('heroicon-o-information-circle')
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)))
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'bulletList',
                                'orderedList',
                                'h2',
                                'h3',
                                'link',
                                'blockquote',
                                'codeBlock',
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Pricing & Settings')
                    ->description('Configure pricing and visibility')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0)
                            ->step(1000),

                        Select::make('category_id')
                            ->relationship('category', 'name', modifyQueryUsing: fn($query) => $query->where('is_featured', true))
                            ->label('Sample')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Toggle::make('is_featured')
                            ->label('Featured Service')
                            ->helperText('Featured services will be highlighted on the website')
                            ->default(false),
                    ]),
            ]);
    }
}
