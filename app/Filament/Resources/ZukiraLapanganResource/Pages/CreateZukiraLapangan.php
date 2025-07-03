<?php

namespace App\Filament\Resources\ZukiraLapanganResource\Pages;

use App\Filament\Resources\ZukiraLapanganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateZukiraLapangan extends CreateRecord
{
    protected static string $resource = ZukiraLapanganResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
