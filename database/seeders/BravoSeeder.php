<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\AttributeField;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;
use App\Enums\AttributeFieldType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BravoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $result = Cache::remember('dummyjson-products', 60 * 60, function () {
            return Http::get('https://dummyjson.com/products/category/smartphones')
                ->json('products');
        });

        collect($result)->each(function ($item) {
            $category = Category::firstOrCreate([
                'name' => $item['category']
            ]);

            $product = Product::create([
                'name' => $item['title'],
                'description' => $item['description'],
                'category_id' => $category->id,
                'price' => $item['price'],
            ]);

            $array = [
                'Vendor Information' => [
                    'Brand' => $item['brand'] ?? '-unknown-',
                    'SKU' => $item['sku'],
                ],
                'Weight & Dimensions' => [
                    'Weight' => $item['weight'],
                    'Width' => $item['dimensions']['width'],
                    'Height' => $item['dimensions']['height'],
                    'Depth' => $item['dimensions']['depth'],
                ],
                'Other' => [
                    'Warrenty' => $item['warrantyInformation'],
                    'Shipping' => $item['shippingInformation'],
                    'Return Policy' => $item['returnPolicy']
                ]
            ];

            foreach ($array as $group => $fields) {
                $group = AttributeGroup::firstOrCreate([
                    'name' => $group
                ]);

                foreach ($fields as $field => $value) {
                    $field = AttributeField::firstOrCreate([
                        'attribute_group_id' => $group->id,
                        'name' => $field,
                        'type' => AttributeFieldType::string,
                    ]);

                    $value = AttributeValue::firstOrCreate([
                        'attribute_field_id' => $field->id,
                        'value' => $value
                    ]);

                    $product->productAttributes()->create([
                        'attribute_value_id' => $value->id
                    ]);
                }
            }
        });
    }
}
