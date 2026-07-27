<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Company Management';

    protected static ?string $navigationLabel = 'Team Members';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Member Details')
                    ->description('Basic information about the team member.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Dennis'),

                        Forms\Components\TextInput::make('role')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Lead Landscape Architect'),

                        Forms\Components\TextInput::make('specialty')
                            ->maxLength(255)
                            ->placeholder('e.g. Hardscape, Cabro & Drainage')
                            ->helperText('Specific expertise area (softscaping, cabro paving, site planning, etc.)'),

                        Forms\Components\Textarea::make('bio')
                            ->rows(4)
                            ->columnSpanFull()
                            ->placeholder('Brief description of background and experience...'),
                    ])->columns(2),

                Forms\Components\Section::make('Media & Contact Info')
                    ->schema([
                        Forms\Components\FileUpload::make('image_url')
                            ->label('Profile Photo')
                            ->image()
                            ->directory('team-photos')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->placeholder('+254700000000'),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('linkedin_url')
                            ->label('LinkedIn Profile URL')
                            ->url()
                            ->maxLength(255),
                    ])->columns(3),

                Forms\Components\Section::make('Display Settings')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText('Lower numbers appear first on the website.'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Visible on Website')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl('https://placehold.co/100x100/1F3B2C/F7F2E4?text=Team'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('specialty')
                    ->badge()
                    ->color('success')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}