<?php

namespace App\Filament\Resources\PotResource\Pages;

use App\Filament\Resources\PotResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPot extends EditRecord
{
    protected static string $resource = PotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
