<?php

namespace App\Filament\Resources\ZukiraLapanganResource\Pages;

use App\Filament\Resources\ZukiraLapanganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZukiraLapangan extends EditRecord
{
    protected static string $resource = ZukiraLapanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
