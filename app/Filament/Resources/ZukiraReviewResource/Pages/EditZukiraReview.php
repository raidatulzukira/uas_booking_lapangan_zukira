<?php

namespace App\Filament\Resources\ZukiraReviewResource\Pages;

use App\Filament\Resources\ZukiraReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZukiraReview extends EditRecord
{
    protected static string $resource = ZukiraReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
