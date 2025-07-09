<?php

namespace App\Filament\Clusters\Bravo\Resources\Products\Pages;

use Livewire\Attributes\On;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Bravo\Resources\Products\ProductResource;
use App\Filament\Clusters\Bravo\Resources\Products\Widgets\ProductFilter;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    // public $categoryId;

    // #[On('product-filters-updated')]
    // public function updateFilters($payload)
    // {
    //     $this->categoryId = $payload['categoryId'];
    // }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [
            // ProductFilter::class,
        ];
    }
}
