<?php

namespace App\Filament\Clusters\Bravo\Resources\Products;

use App\Filament\Clusters\Bravo\BravoCluster;
use App\Filament\Clusters\Bravo\Resources\Products\Pages\CreateProduct;
use App\Filament\Clusters\Bravo\Resources\Products\Pages\EditProduct;
use App\Filament\Clusters\Bravo\Resources\Products\Pages\ListProducts;
use App\Filament\Clusters\Bravo\Resources\Products\Schemas\ProductForm;
use App\Filament\Clusters\Bravo\Resources\Products\Tables\ProductsTable;
use App\Filament\Clusters\Bravo\Resources\Products\Widgets\ProductFilter;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BravoCluster::class;

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // public static function getWidgets(): array
    // {
    //     return [
    //         ProductFilter::class,
    //     ];
    // }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
