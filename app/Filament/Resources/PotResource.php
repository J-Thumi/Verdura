<?php
// app/Filament/Resources/PotResource.php
namespace App\Filament\Resources;

use App\Filament\Resources\PotResource\Pages;
use App\Models\Pot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PotResource extends Resource
{
    protected static ?string $model = Pot::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Catalog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Pot Details')->tabs([
                    Forms\Components\Tabs\Tab::make('Basic Information')->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')->required()->unique(Pot::class, 'slug', ignoreRecord: true),
                        Forms\Components\TextInput::make('sku')->label('SKU'),
                        Forms\Components\RichEditor::make('description')->columnSpanFull(),
                    ])->columns(3),

                    Forms\Components\Tabs\Tab::make('Specifications')->schema([
                        Forms\Components\TextInput::make('material')->placeholder('e.g., Ceramic, Terracotta')->required(),
                        Forms\Components\TextInput::make('finish')->placeholder('e.g., Matte Glazed'),
                        Forms\Components\TextInput::make('color'),
                        Forms\Components\TextInput::make('height_cm')->numeric()->suffix('cm'),
                        Forms\Components\TextInput::make('diameter_cm')->numeric()->suffix('cm'),
                        Forms\Components\TextInput::make('capacity_liters')->numeric()->suffix('L'),
                        Forms\Components\TextInput::make('weight_kg')->numeric()->suffix('kg'),
                        Forms\Components\Select::make('usage')
                            ->options([
                                'indoor' => 'Indoor',
                                'outdoor' => 'Outdoor',
                                'both' => 'Indoor & Outdoor',
                            ])->default('both'),
                        Forms\Components\Toggle::make('has_drainage_holes')->default(true),
                    ])->columns(3),

                    Forms\Components\Tabs\Tab::make('Pricing & Stock')->schema([
                        Forms\Components\TextInput::make('price')->numeric()->prefix('$')->required(),
                        Forms\Components\TextInput::make('sale_price')->numeric()->prefix('$'),
                        Forms\Components\TextInput::make('stock_quantity')->numeric()->default(0)->required(),
                        Forms\Components\Toggle::make('is_active')->default(true),
                        Forms\Components\Toggle::make('is_featured')->default(false),
                    ])->columns(3),

                    Forms\Components\Tabs\Tab::make('Media & 3D')->schema([
                        Forms\Components\Repeater::make('images')
                            ->relationship('images')
                            ->schema([
                                Forms\Components\FileUpload::make('image_path')
                                    ->image()
                                    ->directory('pots/images')
                                    ->required(),
                                Forms\Components\TextInput::make('angle_label')
                                    ->placeholder('e.g., Front View, 45 Degree, Top View'),
                                Forms\Components\TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->orderColumn('sort_order')
                            ->grid(2)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('model_3d_path')
                            ->label('3D Model Asset (.glb / .gltf)')
                            ->directory('pots/3d-models')
                            // ->acceptedFileTypes(['model/gltf-binary', 'model/gltf+json', 'application/octet-stream'])
                            ->columnSpanFull(),
                    ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('material')->sortable(),
                Tables\Columns\TextColumn::make('price')->money('USD')->sortable(),
                Tables\Columns\TextColumn::make('stock_quantity')->label('Stock')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\IconColumn::make('is_featured')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPots::route('/'),
            'create' => Pages\CreatePot::route('/create'),
            'edit' => Pages\EditPot::route('/{record}/edit'),
        ];
    }
}