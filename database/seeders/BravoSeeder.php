<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\AttributeField;
use App\Models\AttributeGroup;
use Illuminate\Database\Seeder;
use App\Enums\AttributeFieldType;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BravoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => 'Super Laptop Pro',
                'description' => 'A powerful high-resolution laptop.',
                'price' => 1499.99,
                'relations' => [
                    'category' => ['name' => 'Laptops'],
                    'attributes' => [
                        [
                            'group' => 'Screen',
                            'field' => 'Resolution',
                            'value' => '1920x1080',
                        ],
                        [
                            'group' => 'Screen',
                            'field' => 'Size',
                            'value' => '15 inch',
                        ],
                        [
                            'group' => 'Screen',
                            'field' => 'Touchscreen',
                            'value' => 'true',
                        ],
                        [
                            'group' => 'CPU',
                            'field' => 'Type',
                            'value' => 'i7 7700k',
                        ],
                        [
                            'group' => 'CPU',
                            'field' => 'Speed',
                            'value' => '2.3 Ghz',
                        ],
                    ]
                ]
            ],
            [
                'name' => 'Ultra Laptop 4K',
                'description' => 'Stunning 4K display laptop.',
                'price' => 1899.99,
                'relations' => [
                    'category' => ['name' => 'Laptops'],
                    'attributes' => [
                        [
                            'group' => 'Screen',
                            'field' => 'Resolution',
                            'value' => '1440x2560',
                        ],
                        [
                            'group' => 'Screen',
                            'field' => 'Size',
                            'value' => '17 inch',
                        ],
                        [
                            'group' => 'Screen',
                            'field' => 'Touchscreen',
                            'value' => 'false',
                        ],
                        [
                            'group' => 'CPU',
                            'field' => 'Type',
                            'value' => 'i5 12500',
                        ],
                        [
                            'group' => 'CPU',
                            'field' => 'Speed',
                            'value' => '3.3 Ghz',
                        ],
                    ]
                ]
            ],
            [
                'name' => 'Ultra Laptop 8K',
                'description' => 'Stunning 4K display laptop.',
                'price' => 5000.99,
                'relations' => [
                    'category' => ['name' => 'Laptops'],
                    'attributes' => [
                        [
                            'group' => 'Screen',
                            'field' => 'Resolution',
                            'value' => '4450x9999',
                        ],
                        [
                            'group' => 'Screen',
                            'field' => 'Size',
                            'value' => '17 inch',
                        ],
                        [
                            'group' => 'CPU',
                            'field' => 'Type',
                            'value' => 'i9 14900K',
                        ],
                        [
                            'group' => 'CPU',
                            'field' => 'Speed',
                            'value' => '5.0 Ghz',
                        ],
                    ]
                ]
            ],
            [
                'name' => 'Slim Fit Jeans (30/30)',
                'description' => 'xxx',
                'price' => 45.99,
                'relations' => [
                    'category' => ['name' => 'Clothing'],
                    'attributes' => [
                        [
                            'group' => 'Fabric',
                            'field' => 'Material',
                            'value' => 'Denim',
                        ],
                        [
                            'group' => 'Fabric',
                            'field' => 'Stretch',
                            'value' => 'Yes',
                        ],
                        [
                            'group' => 'Size',
                            'field' => 'Width',
                            'value' => '30',
                        ],
                        [
                            'group' => 'Size',
                            'field' => 'Length',
                            'value' => '30',
                        ],
                    ]
                ]
            ],
            [
                'name' => 'Slim Fit Jeans (30/32)',
                'description' => 'xxx',
                'price' => 45.99,
                'relations' => [
                    'category' => ['name' => 'Clothing'],
                    'attributes' => [
                        [
                            'group' => 'Fabric',
                            'field' => 'Material',
                            'value' => 'Denim',
                        ],
                        [
                            'group' => 'Fabric',
                            'field' => 'Stretch',
                            'value' => 'Yes',
                        ],
                        [
                            'group' => 'Size',
                            'field' => 'Width',
                            'value' => '30',
                        ],
                        [
                            'group' => 'Size',
                            'field' => 'Length',
                            'value' => '32',
                        ],
                    ]
                ]
            ],
            [
                'name' => 'Slim Fit Jeans (32/32)',
                'description' => 'xxx',
                'price' => 45.99,
                'relations' => [
                    'category' => ['name' => 'Clothing'],
                    'attributes' => [
                        [
                            'group' => 'Fabric',
                            'field' => 'Material',
                            'value' => 'Denim',
                        ],
                        [
                            'group' => 'Fabric',
                            'field' => 'Stretch',
                            'value' => 'Yes',
                        ],
                        [
                            'group' => 'Size',
                            'field' => 'Width',
                            'value' => '32',
                        ],
                        [
                            'group' => 'Size',
                            'field' => 'Length',
                            'value' => '32',
                        ],
                    ]
                ]
            ],
            [
                'name' => 'Cowboy Jeans',
                'description' => 'xxx',
                'price' => 45.99,
                'relations' => [
                    'category' => ['name' => 'Clothing'],
                    'attributes' => [
                        [
                            'group' => 'Fabric',
                            'field' => 'Material',
                            'value' => 'Jeans',
                        ],
                        [
                            'group' => 'Fabric',
                            'field' => 'Stretch',
                            'value' => 'No',
                        ],
                        [
                            'group' => 'Size',
                            'field' => 'Width',
                            'value' => '30',
                        ],
                        [
                            'group' => 'Size',
                            'field' => 'Length',
                            'value' => '30',
                        ],
                    ]
                ]
            ],
        ])->each(function ($item) {
            $item = collect($item);

            $relations = $item->pull('relations');

            $category = Category::firstOrCreate($relations['category']);

            $item['category_id'] = $category->id;

            $product = Product::create($item->toArray());

            foreach ($relations['attributes'] as $array) {

                $group = AttributeGroup::firstOrCreate([
                    'name' => $array['group']
                ]);

                $field = AttributeField::firstOrCreate([
                    'attribute_group_id' => $group->id,
                    'name' => $array['field'],
                    'type' => AttributeFieldType::string,
                ]);

                $value = AttributeValue::firstOrCreate([
                    'attribute_field_id' => $field->id,
                    'value' => $array['value']
                ]);

                $product->productAttributes()->create([
                    'attribute_value_id' => $value->id
                ]);
            }
        });
    }
}
