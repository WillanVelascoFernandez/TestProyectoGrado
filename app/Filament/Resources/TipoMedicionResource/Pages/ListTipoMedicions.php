<?php

namespace App\Filament\Resources\TipoMedicionResource\Pages;

use App\Filament\Resources\TipoMedicionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoMedicions extends ListRecords
{
    protected static string $resource = TipoMedicionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
