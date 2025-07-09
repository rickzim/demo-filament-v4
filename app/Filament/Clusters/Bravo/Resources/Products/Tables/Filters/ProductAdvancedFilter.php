<?php

namespace App\Filament\Clusters\Bravo\Resources\Products\Tables\Filters;

use Livewire\Component;
use App\Models\Category;
use App\Models\AttributeField;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\Repeater\TableColumn;

class ProductAdvancedFilter
{
    public static function make(): Filter
    {
        return Filter::make('advancedFilter')
            ->schema([
                static::getCategorySelect(),

                Repeater::make('attributes')
                    ->visible(fn(Get $get) => $get('category_id'))
                    ->label('Attribute Filters')
                    ->table([
                        TableColumn::make('Group')
                            ->width('25%'),
                        TableColumn::make('Field')
                            ->width('25%'),
                        TableColumn::make('Value(s)'),
                    ])
                    ->schema([
                        static::getGroupSelect(),
                        static::getFieldSelect(),
                        static::getValueSelect(),
                    ])
                    ->addActionLabel('Add Filter')
                    ->columns(3)
            ])
            ->query(function ($query, array $data) {
                $query
                    ->when($data['category_id'], function (Builder $query, int $category_id): void {
                        $query->where('category_id', $category_id);
                    })
                    ->when($data['attributes'], function (Builder $query, array $attributes): void {
                        foreach ($attributes as $attribute) {
                            if (!empty($attribute['value_id'])) {
                                $query->whereHas('productAttributes', function ($q) use ($attribute) {
                                    $q->whereIn('attribute_value_id', $attribute['value_id']);
                                });
                            }
                        }
                    })
                ;
            })
            ->indicateUsing(function (array $data) {
                $indicators = [];

                if (!empty($data['category_id'])) {
                    $category = Category::find($data['category_id']);
                    $indicators[] = 'Category: ' . ($category?->name ?? '');
                }

                foreach ($data['attributes'] ?? [] as $attribute) {
                    if (!empty($attribute['value_id'])) {
                        $field = AttributeField::find($attribute['field_id']);
                        $values = AttributeValue::whereIn('id', $attribute['value_id'])
                            ->pluck('value')
                            ->implode(', ');

                        $indicators[] = $field?->name . ': ' . $values;
                    }
                }

                return $indicators;
            });
    }

    protected static function getCategorySelect(): Select
    {
        return Select::make('category_id')
            ->label('Category')
            ->live(onBlur: true)
            ->searchable()
            ->options(Category::pluck('name', 'id'))
            ->afterStateUpdated(function (Set $set) {
                $set('attributes', []);
            });
    }

    protected static function getGroupSelect(): Select
    {
        return Select::make('group_id')
            ->label('Group')
            ->live(onBlur: true)
            ->searchable()
            ->options(function (Get $get) {
                $category_id = $get('../../category_id');

                if (!$category_id) {
                    return [];
                }

                return AttributeGroup::getGroupsByCategory($category_id);
            })
            ->afterStateUpdated(function (Set $set) {
                $set('field_id', null);
                $set('value_id', []);
            });
    }

    protected static function getFieldSelect(): Select
    {
        return Select::make('field_id')
            ->label('Field')
            ->live(onBlur: true)
            ->searchable()
            ->options(function (Get $get) {
                $groupId = $get('group_id');

                if (!$groupId) {
                    return [];
                }

                return AttributeField::where('attribute_group_id', $groupId)
                    ->pluck('name', 'id')
                    ->toArray();
            })
            ->afterStateUpdated(function (Set $set) {
                $set('value_id', []);
                // $set('', );
            });
    }

    protected static function getValueSelect(): Select
    {
        return Select::make('value_id')
            ->label('Values')
            ->multiple()
            ->searchable()
            ->options(function (Get $get) {
                $fieldId = $get('field_id');

                if (!$fieldId) {
                    return [];
                }

                return AttributeValue::where('attribute_field_id', $fieldId)
                    ->pluck('value', 'id')
                    ->toArray();
            });
    }
}
