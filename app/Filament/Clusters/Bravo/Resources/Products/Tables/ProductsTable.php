<?php

namespace App\Filament\Clusters\Bravo\Resources\Products\Tables;

use Livewire\Component;
use App\Models\Category;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\AttributeField;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Filament\Actions\EditAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\Repeater\TableColumn;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
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
                static::getCustomFilter(),
            ], FiltersLayout::AboveContent)
            ->filtersFormColumns(1)
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getCustomFilter(): Filter
    {
        return Filter::make('category_attributes')
            ->schema([
                Select::make('category_id')
                    ->label('Category')
                    ->live()
                    // ->searchable()
                    ->native(true)
                    ->options(Category::pluck('name', 'id'))
                    ->afterStateUpdated(function (Set $set, Component $livewire) {
                        $set('attributes', []);
                    }),

                Repeater::make('attributes')
                    ->visible(fn(Get $get) => $get('category_id'))
                    ->label('Attribute Filters')
                    ->table([
                        TableColumn::make('Group'),
                        TableColumn::make('Field'),
                        TableColumn::make('Value'),
                    ])
                    ->schema([
                        Select::make('group_id')
                            ->label('Group')
                            // ->searchable()
                            ->live()
                            ->options(function (Get $get) {
                                $category_id = $get('../../category_id');

                                if (!$category_id) {
                                    return [];
                                }

                                return AttributeGroup::getGroupsByCategory($category_id);
                            }),

                        Select::make('field_id')
                            ->label('Field')
                            ->live()
                            ->options(function ($get) {
                                $groupId = $get('group_id');

                                if (!$groupId) {
                                    return [];
                                }

                                return AttributeField::where('attribute_group_id', $groupId)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            }),

                        Select::make('value_id')
                            ->label('Values')
                            ->options(function ($get) {
                                $fieldId = $get('field_id');

                                if (!$fieldId) {
                                    return [];
                                }

                                return AttributeValue::where('attribute_field_id', $fieldId)
                                    ->pluck('value', 'id')
                                    ->toArray();
                            }),
                    ])
                    ->addActionLabel('Add Filter')
                    ->columns(3)
            ])
            ->query(function ($query, array $data) {
                if (!empty($data['category_id'])) {
                    $query->where('category_id', $data['category_id']);
                }

                if (!empty($data['attributes'])) {
                    foreach ($data['attributes'] as $attribute) {
                        if (!empty($attribute['value_id'])) {
                            $query->whereHas('productAttributes', function ($q) use ($attribute) {
                                $q->where('attribute_value_id', $attribute['value_id']);
                            });
                        }
                    }
                }
            })
            ->label('Advanced Filter')
            ->indicateUsing(function (array $data) {
                $indicators = [];

                if (!empty($data['category_id'])) {
                    $category = Category::find($data['category_id']);
                    $indicators[] = 'Category: ' . ($category?->name ?? '');
                }

                foreach ($data['attributes'] ?? [] as $attribute) {
                    if (!empty($attribute['value_id'])) {
                        $value = AttributeValue::find($attribute['value_id']);

                        $field = $value?->field?->name;
                        $indicators[] = ($field ? $field . ': ' : '') . ($value?->value ?? '');
                    }
                }

                return $indicators;
            });
    }
}
