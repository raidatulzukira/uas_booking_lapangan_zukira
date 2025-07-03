<?php

namespace App\Filament\Resources\ZukiraPaymentResource\Pages;

use App\Filament\Resources\ZukiraPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZukiraPayment extends EditRecord
{
    protected static string $resource = ZukiraPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
