<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state));

                        // если нужно сделать катего
//                        $nameParts = explode(' ', trim($state));
//                        $firstWord = array_shift( $nameParts);
//                        $secondWord = array_pop( $nameParts);
//                        $set('image', Str::substr($firstWord,0,1).Str::substr($secondWord, 0, 1));
                    })
                    ->helperText('Введите имя')
                    ->autofocus()
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('image'),
                Forms\Components\TextInput::make('intro_text'),
                Forms\Components\TextArea::make('description'),
                Forms\Components\Checkbox::make('published')->inline(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                 Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-M-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d-M-Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
//            CategoriesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
