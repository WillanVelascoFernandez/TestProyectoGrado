<?php

namespace App\Filament\Resources\MedicionResource\Pages;

use App\Filament\Resources\MedicionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicion extends EditRecord
{
    protected static string $resource = MedicionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
