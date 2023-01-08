<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FillingResource\RelationManagers\FillingRelationManager;
use App\Filament\Resources\FillingResource\Pages;
use App\Filament\Resources\FillingResource\RelationManagers;
use App\Models\Filling;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class FillingResource extends Resource
{
    protected static ?string $model = Filling::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state));
                    })
                    ->helperText('Введите имя')
                    ->autofocus()
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('image')->name('Картинка'),
                Forms\Components\Textarea::make('structure'),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Toggle::make('published')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFillings::route('/'),
            'create' => Pages\CreateFilling::route('/create'),
            'edit' => Pages\EditFilling::route('/{record}/edit'),
        ];
    }
}
