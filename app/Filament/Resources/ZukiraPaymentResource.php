<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZukiraPaymentResource\Pages;
use App\Models\ZukiraPayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ZukiraPaymentResource extends Resource
{
    protected static ?string $model = ZukiraPayment::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('booking_id')
                    ->relationship('booking', 'id')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),
                Forms\Components\FileUpload::make('bukti_transfer')
                    ->maxSize(2048) // 2 MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->image()
                    ->directory('payments')
                    ->visibility('public')
                    ->required(),
                Forms\Components\Select::make('status_verifikasi')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('booking.id')
                    ->label('Booking ID')
                    ->searchable()
                    ->sortable(),
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
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('Approve')
                    ->action(function (ZukiraPayment $record) {
                        $record->update(['status_verifikasi' => 'approved']);

                    })
                    ->color('success'),
                Tables\Actions\Action::make('Reject')
                    ->action(function (ZukiraPayment $record) {
                        $record->update(['status_verifikasi' => 'rejected']);

                    })
                    ->color('danger'),
                   

                ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZukiraPayments::route('/'),
            'create' => Pages\CreateZukiraPayment::route('/create'),
            
            'edit' => Pages\EditZukiraPayment::route('/{record}/edit'),
        ];
    }
}