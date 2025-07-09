<?php

namespace App\Filament\Clusters\Bravo\Resources\Products\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Clusters\Bravo\Resources\Products\Tables\Filters\ProductAdvancedFilter;
use Livewire\Component;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            /**
             * for `ProductFilter` widget
             */
            // ->modifyQueryUsing(function (Builder $query, Component $livewire) {
            //     $query
            //         ->when($livewire->categoryId, function (Builder $query, $category_id) {
            //             $query->where('category_id', $category_id);
            //         });
            // })
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->badge()
                    ->sortable(),

                TextColumn::make('price')
                    ->money()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                ProductAdvancedFilter::make(),
            ], FiltersLayout::AboveContent)
            ->filtersFormColumns(1)
            /**
             * Will not work with `deferFilters(true)`
             *
             * error when selecting `field` within the reapter: Using $this when not in object context
             * ...\vendor\filament\forms\resources\views\components\select.blade.php :161
             * 161: livewireId: @js($this->getId()),
             * */
            ->deferFilters(true)
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
