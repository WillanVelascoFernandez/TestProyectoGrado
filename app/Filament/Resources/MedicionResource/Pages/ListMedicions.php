<?php

namespace App\Filament\Resources\MedicionResource\Pages;

use App\Filament\Resources\MedicionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicions extends ListRecords
{
    protected static string $resource = MedicionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
