<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZukiraLapanganResource\Pages;
use App\Models\ZukiraLapangan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Select;

class ZukiraLapanganResource extends Resource
{
    protected static ?string $model = ZukiraLapangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->directory('lapangans')
                    ->visibility('public')
                    ->nullable(),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tipe')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('harga')
                    ->label('Harga per Jam')
                    ->required()
                    ->extraAttributes([
                        'x-data' => '',
                        'x-on:input' => 'formatRupiah($event)',
                        'inputmode' => 'numeric',
                    ])
                     ->prefix('Rp '),

                Forms\Components\Select::make('status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'booked' => 'Booked',
                        'maintenance' => 'Maintenance',
                    ])
                    ->default('tersedia') // Set default value
                    ->required(),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZukiraLapangans::route('/'),
            'create' => Pages\CreateZukiraLapangan::route('/create'),
            'edit' => Pages\EditZukiraLapangan::route('/{record}/edit'),
        ];
    }
}
