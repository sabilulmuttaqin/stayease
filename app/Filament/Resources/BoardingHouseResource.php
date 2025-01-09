<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoardingHouseResource\Pages;
use App\Filament\Resources\BoardingHouseResource\RelationManagers;
use App\Models\BoardingHouse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Tabs;

class BoardingHouseResource extends Resource
{
    protected static ?string $model = BoardingHouse::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Boarding House Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Informasi Utama')
                            ->icon('heroicon-o-hand-raised')
                            ->schema([
                                // Upload Thumbnail
                                Forms\Components\FileUpload::make('thumbnail')
                                    ->label('Thumbnail')
                                    ->required()
                                    ->image()
                                    ->directory('boarding_houses')
                                    ->columnSpan(2),

                                // Nama Boarding House
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Boarding House')
                                    ->required()
                                    ->maxLength(255),

                                // Pilih Kota
                                Forms\Components\Select::make('city_id')
                                    ->label('Kota')
                                    ->relationship('city', 'name')
                                    ->required(),

                                // Pilih Kategori
                                Forms\Components\Select::make('category_id')
                                    ->label('Kategori')
                                    ->relationship('category', 'name')
                                    ->required(),

                                // Alamat
                                Forms\Components\TextInput::make('address')
                                    ->label('Alamat')
                                    ->required(),
                                // Harga
                                Forms\Components\TextInput::make('price')
                                    ->label('Harga')
                                    ->required()
                                    ->numeric()
                                    ->prefix('IDR'),

                                Forms\Components\RichEditor::make('description')
                                    ->label('Deskripsi')
                                    ->required()
                            ]),

                        Tabs\Tab::make('Bonus')
                            ->icon('heroicon-m-trophy')
                            ->schema([
                                Forms\Components\Repeater::make('bonuses')
                                    ->relationship("bonuses")
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')

                                            ->required()
                                            ->image()
                                            ->directory('bonuses'),
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('description')
                                            ->required()
                                            ->maxLength(255),
                                    ])

                            ]),
                        Tabs\Tab::make('Room')
                            ->icon('heroicon-m-building-office')
                            ->schema([
                                Forms\Components\Repeater::make('rooms')
                                    ->relationship("rooms")
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('room_type')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('square_feet')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('capacity')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('price_per_month')
                                            ->required()
                                            ->prefix('IDR')
                                            ->numeric(),
                                        Forms\Components\Toggle::make('is_available')
                                            ->required(),
                                        Forms\Components\Repeater::make('images')
                                            ->relationship("images")
                                            ->schema([
                                                Forms\Components\FileUpload::make('image')
                                                    ->required()
                                                    ->image()
                                                    ->directory('rooms'),
                                            ])
                                    ])
                            ])
                    ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('city.name')->searchable(),
                Tables\Columns\TextColumn::make('category.name')->searchable(),
                Tables\Columns\TextColumn::make('price')->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBoardingHouses::route('/'),
            'create' => Pages\CreateBoardingHouse::route('/create'),
            'edit' => Pages\EditBoardingHouse::route('/{record}/edit'),
        ];
    }
}
