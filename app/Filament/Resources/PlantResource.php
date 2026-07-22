<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlantResource\Pages;
use App\Models\Plant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Cache;

class PlantResource extends Resource
{
    protected static ?string $model = Plant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Nursery Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Plant Details')
                    ->description('General identification and classification')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Plant Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Nandi Flame'),

                        Forms\Components\TextInput::make('botanical_name')
                            ->label('Botanical Name')
                            ->maxLength(255)
                            ->placeholder('e.g., Spathodea campanulata'),

                        Forms\Components\Select::make('category')
                            ->options([
                                'tree' => 'Tree',
                                'shrub' => 'Shrub',
                                'groundcover' => 'Groundcover',
                                'featured' => 'Featured',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('KES')
                            ->required()
                            ->default(0.00),

                        Forms\Components\Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull()
                            ->placeholder('Enter plant care notes, growth characteristics, or optimal placement...'),
                    ])->columns(2),

                Forms\Components\Section::make('Media & Visibility')
                    ->schema([
                        Forms\Components\FileUpload::make('image_url')
                            ->label('Plant Photo')
                            ->image()
                            ->directory('plants')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Specimen (Show on Hero Section)')
                            ->default(false),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active in Catalog')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Photo')
                    ->square(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('botanical_name')
                    ->searchable()
                    // ->italic()
                    ->fontFamily('mono')
                    ->color('gray'),

                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => 'tree',
                        'warning' => 'shrub',
                        'success' => 'groundcover',
                        'danger' => 'featured',
                    ]),

                Tables\Columns\TextColumn::make('price')
                    ->money('KES')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'tree' => 'Tree',
                        'shrub' => 'Shrub',
                        'groundcover' => 'Groundcover',
                        'featured' => 'Featured',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlants::route('/'),
            'create' => Pages\CreatePlant::route('/create'),
            'edit' => Pages\EditPlant::route('/{record}/edit'),
        ];
    }
}