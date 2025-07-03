<?php

namespace App\Filament\Resources\ZukiraLapanganResource\Pages;

use App\Filament\Resources\ZukiraLapanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZukiraLapangans extends ListRecords
{
    protected static string $resource = ZukiraLapanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
