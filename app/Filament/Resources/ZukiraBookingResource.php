<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZukiraBookingResource\Pages;
use App\Models\ZukiraBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ZukiraBookingResource extends Resource
{
    protected static ?string $model = ZukiraBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Skema form Anda akan ada di sini
                // Contoh:
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('lapangan_id')
                    ->relationship('lapangan', 'nama')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\DateTimePicker::make('jam_mulai')
                    ->required(),
                Forms\Components\DateTimePicker::make('jam_selesai')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'dikonfirmasi' => 'Dikonfirmasi',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemesan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lapangan.nama')
                    ->label('Lapangan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_mulai')
                    ->dateTime('H:i')
                    ->label('Mulai'),
                Tables\Columns\TextColumn::make('jam_selesai')
                    ->dateTime('H:i')
                    ->label('Selesai'),
                
                // --- PERBAIKAN DI SINI ---
                Tables\Columns\TextColumn::make('status')
                    ->badge() // Menggunakan badge untuk tampilan yang lebih baik
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)) // Mengubah format teks menjadi Kapital di awal
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'dikonfirmasi' => 'success',
                        'selesai' => 'primary',
                        'dibatalkan' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'dikonfirmasi' => 'Dikonfirmasi',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Menambahkan Aksi Konfirmasi
                Tables\Actions\Action::make('konfirmasi')
                    ->label('Konfirmasi')
                    ->action(function (ZukiraBooking $record) {
                        $record->update(['status' => 'dikonfirmasi']);
                    })
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn (ZukiraBooking $record): bool => $record->status === 'pending'), // Hanya tampil jika status pending
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
            //
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
