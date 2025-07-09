<?php

namespace App\Filament\Clusters\Bravo\Resources\Products\Widgets;

use App\Models\Category;
use Filament\Schemas\Schema;
use Filament\Widgets\Widget;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Repeater\TableColumn;

class ProductFilter extends Widget implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.clusters.bravo.resources.products.widgets.product-filter';

    protected int | string | array $columnSpan = 'full';

    public $categoryId = null;

    public function mount(): void
    {
        $this->form->fill([
            //
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('categoryId')
                    ->label('Category')
                    ->live(onBlur: true)
                    ->searchable()
                    ->options(Category::pluck('name', 'id'))
                // ->afterStateUpdated(fn($set) => $set('pattributes', []))
                ,

                // Repeater::make('pattributes')
                //     ->visible(fn(Get $get) => $this->categoryId)
                //     ->label('Attribute Filters')
                //     // ->table([
                //     //     TableColumn::make('Group'),
                //     //     TableColumn::make('Field'),
                //     //     TableColumn::make('Value(s)'),
                //     // ])
                //     ->schema([
                //         // static::getGroupSelect(),
                //         // static::getFieldSelect(),
                //         // static::getValueSelect(),
                //     ])
                //     ->addActionLabel('Add Filter')
                //     ->columns(3)
            ]);
    }

    public function applyFilters()
    {
        $this->dispatch('product-filters-updated', [
            'categoryId' => $this->categoryId
        ]);
    }

    public function resetFilters()
    {
        $this->categoryId = null;

        $this->form->fill([]);

        $this->dispatch('product-filters-updated', [
            'categoryId' => null,
        ]);
    }
}
