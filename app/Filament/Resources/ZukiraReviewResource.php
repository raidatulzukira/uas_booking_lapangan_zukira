<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZukiraReviewResource\Pages;
use App\Models\ZukiraReview;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ZukiraReviewResource extends Resource
{
    protected static ?string $model = ZukiraReview::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $recordTitleAttribute = 'id';

    public static function canCreate(): bool
    {
        return false;
    }

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
                Forms\Components\Select::make('rating')
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('komentar')
                    ->required()
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('rating')
                    ->sortable(),
                Tables\Columns\TextColumn::make('komentar')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rating')
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListZukiraReviews::route('/'),
            'create' => Pages\CreateZukiraReview::route('/create'),
            'edit' => Pages\EditZukiraReview::route('/{record}/edit'),
        ];
    }
}
