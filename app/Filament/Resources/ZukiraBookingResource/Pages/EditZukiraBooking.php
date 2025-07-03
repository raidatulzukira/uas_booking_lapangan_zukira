<?php

namespace App\Filament\Resources\ZukiraBookingResource\Pages;

use App\Filament\Resources\ZukiraBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZukiraBooking extends EditRecord
{
    protected static string $resource = ZukiraBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
