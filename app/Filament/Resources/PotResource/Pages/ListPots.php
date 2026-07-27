<?php

namespace App\Filament\Resources\PotResource\Pages;

use App\Filament\Resources\PotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPots extends ListRecords
{
    protected static string $resource = PotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
