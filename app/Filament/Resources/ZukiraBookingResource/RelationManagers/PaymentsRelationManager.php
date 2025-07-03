<?php

namespace App\Filament\Resources\ZukiraBookingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payment';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),
                Forms\Components\FileUpload::make('bukti_transfer')
                    ->image()
                    ->directory('payments')
                    ->visibility('public')
                    ->required(),
                Forms\Components\Select::make('status_verifikasi')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'valid' => 'Valid',
                        'tidak valid' => 'Tidak Valid',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('bukti_transfer')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('status_verifikasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_verifikasi')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'valid' => 'Valid',
                        'tidak valid' => 'Tidak Valid',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}