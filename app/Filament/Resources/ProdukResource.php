<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                 //grid
                    Forms\Components\Grid::make(1)
                    ->schema([
                        //foto
                        Forms\Components\FileUpload::make('foto')
                        ->label('Foto')
                        ->required(),

                        //nama
                        Forms\Components\TextInput::make('nama')
                        ->label('Nama')
                        ->placeholder('Nama Produk')
                        ->required(),
                    ]),

                    //grid
                    Forms\Components\Grid::make(2)
                    ->schema([
                        //qty
                        Forms\Components\TextInput::make('qty')
                        ->label('Kuantitas')
                        ->numeric()
                        ->required(),

                        //harga
                        Forms\Components\TextInput::make('harga')
                        ->label('Harga')
                        ->numeric()
                        ->required(),

                    ]),

                    //grid
                    Forms\Components\Grid::make(1)
                    ->schema([
                        //deskripsi
                        Forms\Components\Textarea::make('deskripsi')
                        ->label('Deskrispi')
                        ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\ImageColumn::make('foto'),
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('deskripsi'),
                Tables\Columns\TextColumn::make('harga'),
                Tables\Columns\TextColumn::make('qty'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
