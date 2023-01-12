<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FillingResource\RelationManagers\FillingRelationManager;
use App\Filament\Resources\ProductCategoryResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use function Livewire\str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Checkbox::make('published')->inline(),
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
                Forms\Components\MarkdownEditor::make('intro_text')->name("Анонс"),
                Forms\Components\MarkdownEditor::make('description')->name("Описание"),
//                Forms\Components\TextInput::make('image')->name('Картинка'),
                FileUpload::make('image')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        $fileName = $file->hashName();
                        $name = explode('.', $fileName);
                        return (string) str('images/products/' . date_format(now(), 'FY') . '/image/' . $name[0] . '.png');
                    }),
                Forms\Components\TextInput::make('article')->name('Артикль'),
                Forms\Components\TextInput::make('type_products'),
                Forms\Components\TextInput::make('coverage'),
                Forms\Components\TextInput::make('weight_photo'),
                Forms\Components\TextInput::make('number_tiers'),
                Forms\Components\TextInput::make('congratulatory_signature'),
                Forms\Components\MarkdownEditor::make('title'),
                Forms\Components\MarkdownEditor::make('meta_description'),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name'),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\ImageColumn::make('image'),
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
        // http://joxi.ru/nAy1O5Bf9OBpeA
        return [
//            CategoriesRelationManager::class,
//            FillingRelationManager::class
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
