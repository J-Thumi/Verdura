<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?string $navigationLabel = 'Projects & Our Work';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Overview')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Project::class, 'slug', ignoreRecord: true),

                        Forms\Components\Select::make('category')
                            ->options([
                                'Residential Landscape' => 'Residential Landscape',
                                'Commercial Landscape' => 'Commercial Landscape',
                                'Hardscape & Cabro' => 'Hardscape & Cabro',
                                'Plant Installation' => 'Plant Installation & Softscaping',
                                'Lawn & Turf Installation' => 'Lawn & Turf Installation',
                            ])
                            ->required()
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('category')->required()
                            ]),

                        Forms\Components\TextInput::make('location')
                            ->placeholder('e.g. Karen, Nairobi / Naivasha'),

                        Forms\Components\DatePicker::make('completed_at')
                            ->label('Completion Date'),

                        Forms\Components\Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull()
                            ->placeholder('Describe the scope of work (design, excavating, cabro laying, planting)...'),
                    ])->columns(2),

                Forms\Components\Section::make('Project Images')
                    ->schema([
                        Forms\Components\FileUpload::make('cover_image')
                            ->label('Cover Photo (Main thumbnail)')
                            ->image()
                            ->directory('projects/covers')
                            ->visibility('public')
                            ->imageEditor()
                            ->required(),

                        Forms\Components\FileUpload::make('gallery_images')
                            ->label('Additional Gallery Photos (Before/After, details)')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->directory('projects/galleries')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Visibility Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Feature on Home Page')
                            ->default(false),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Visible on Website')
                            ->default(true),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')
                    ->label('Cover'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                Tables\Columns\TextColumn::make('location')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('category'),
                Tables\Filters\TernaryFilter::make('is_active'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}