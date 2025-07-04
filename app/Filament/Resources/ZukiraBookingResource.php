<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZukiraBookingResource\Pages;
use App\Filament\Resources\ZukiraBookingResource\RelationManagers;
use App\Models\ZukiraBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use App\Enums\BookingStatus;

class ZukiraBookingResource extends Resource
{
    protected static ?string $model = ZukiraBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('lapangan_id')
                    ->relationship('lapangan', 'nama')
                    ->required()
                    ->searchable(),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TimePicker::make('jam_mulai')
                    ->required(),
                Forms\Components\TimePicker::make('jam_selesai')
                    ->required(),
                Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'dikonfirmasi' => 'Dikonfirmasi',
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
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lapangan.nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_mulai')
                    ->time()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_selesai')
                    ->time()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'pending',
                    'success' => 'dikonfirmasi',
                    'danger' => 'ditolak', // Anda bisa tambahkan status lain
                ])
                ->formatStateUsing(fn ($state): string => ucfirst($state->value)),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'dikonfirmasi' => 'Dikonfirmasi',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->actions([
                 Action::make('konfirmasi')
                ->label('Konfirmasi')
                ->action(function (ZukiraBooking $record) {
                    $record->status = BookingStatus::DIKONFIRMASI;
                    $record->save();
                })
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation() // <-- Tampilkan modal konfirmasi "Are you sure?"
                ->visible(fn (ZukiraBooking $record): bool => $record->status === BookingStatus::PENDING), // <-- Hanya tampil jika status 'pending'
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZukiraBookings::route('/'),
            'create' => Pages\CreateZukiraBooking::route('/create'),
            'edit' => Pages\EditZukiraBooking::route('/{record}/edit'),
        ];
    }
}