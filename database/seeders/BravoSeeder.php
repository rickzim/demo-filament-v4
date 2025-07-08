<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\AttributeFieldType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BravoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createLaptops();
        $this->createClothes();
    }

    public function createLaptops()
    {
        \App\Models\Category::factory()->create(['name' => 'Laptops']);

        $screenGroup = \App\Models\AttributeGroup::create(['name' => 'Screen', 'sort_order' => 1]);

        $resolutionField = \App\Models\AttributeField::create([
            'attribute_group_id' => $screenGroup->id,
            'name' => 'Resolution',
            'type' => AttributeFieldType::string,
            'is_filterable' => true,
            'sort_order' => 1,
        ]);

        $sizeField = \App\Models\AttributeField::create([
            'attribute_group_id' => $screenGroup->id,
            'name' => 'Size',
            'type' => AttributeFieldType::decimal,
            'is_filterable' => true,
            'sort_order' => 2,
        ]);

        $touchscreenField = \App\Models\AttributeField::create([
            'attribute_group_id' => $screenGroup->id,
            'name' => 'Touchscreen',
            'type' => AttributeFieldType::boolean,
            'is_filterable' => true,
            'sort_order' => 3,
        ]);

        $res1080 = \App\Models\AttributeValue::create([
            'attribute_field_id' => $resolutionField->id,
            'value' => '1920x1080',
        ]);

        $res4k = \App\Models\AttributeValue::create([
            'attribute_field_id' => $resolutionField->id,
            'value' => '3840x2160',
        ]);

        $size13 = \App\Models\AttributeValue::create([
            'attribute_field_id' => $sizeField->id,
            'value' => '13.3 inch',
            'value_numeric' => 13.3,
        ]);

        $size15 = \App\Models\AttributeValue::create([
            'attribute_field_id' => $sizeField->id,
            'value' => '15.6 inch',
            'value_numeric' => 15.6,
        ]);

        $touchYes = \App\Models\AttributeValue::create([
            'attribute_field_id' => $touchscreenField->id,
            'value' => 'Yes',
        ]);

        $touchNo = \App\Models\AttributeValue::create([
            'attribute_field_id' => $touchscreenField->id,
            'value' => 'No',
        ]);

        $product = \App\Models\Product::create([
            'category_id' => 1,
            'name' => 'Super Laptop Pro',
            'description' => 'A powerful high-resolution laptop.',
            'price' => 1499.99,
        ]);

        $product->productAttributes()->createMany([
            ['attribute_value_id' => $res1080->id],
            ['attribute_value_id' => $size13->id],
            ['attribute_value_id' => $touchYes->id],
        ]);

        $product2 = \App\Models\Product::create([
            'category_id' => 1,
            'name' => 'Ultra Laptop 4K',
            'description' => 'Stunning 4K display laptop.',
            'price' => 1899.99,
        ]);

        $product2->productAttributes()->createMany([
            ['attribute_value_id' => $res4k->id],
            ['attribute_value_id' => $size15->id],
            ['attribute_value_id' => $touchNo->id],
        ]);
    }

    public function createClothes()
    {
        \App\Models\Category::factory()->create(['name' => 'Clothes']);

        $screenGroup = \App\Models\AttributeGroup::create(['name' => 'Fit', 'sort_order' => 1]);

        $materialField = \App\Models\AttributeField::create([
            'attribute_group_id' => $screenGroup->id,
            'name' => 'Material',
            'type' => AttributeFieldType::string,
            'is_filterable' => true,
            'sort_order' => 1,
        ]);

        $sizeField = \App\Models\AttributeField::create([
            'attribute_group_id' => $screenGroup->id,
            'name' => 'Size',
            'type' => AttributeFieldType::decimal,
            'is_filterable' => true,
            'sort_order' => 2,
        ]);

        $stretchField = \App\Models\AttributeField::create([
            'attribute_group_id' => $screenGroup->id,
            'name' => 'Stretch',
            'type' => AttributeFieldType::boolean,
            'is_filterable' => true,
            'sort_order' => 3,
        ]);

        $denim = \App\Models\AttributeValue::create([
            'attribute_field_id' => $materialField->id,
            'value' => 'Denim',
        ]);

        $jeans = \App\Models\AttributeValue::create([
            'attribute_field_id' => $materialField->id,
            'value' => 'Jeans',
        ]);

        $sizeSm = \App\Models\AttributeValue::create([
            'attribute_field_id' => $sizeField->id,
            'value' => '30/30',
            'value_numeric' => 30,
        ]);

        $sizeMd = \App\Models\AttributeValue::create([
            'attribute_field_id' => $sizeField->id,
            'value' => '32/32',
            'value_numeric' => 32,
        ]);

        $stretchYes = \App\Models\AttributeValue::create([
            'attribute_field_id' => $stretchField->id,
            'value' => 'Yes',
        ]);

        $stretchNo = \App\Models\AttributeValue::create([
            'attribute_field_id' => $stretchField->id,
            'value' => 'No',
        ]);

        $product = \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Trouser #1',
            'description' => 'Slim trousers',
            'price' => 45.99,
        ]);

        $product->productAttributes()->createMany([
            ['attribute_value_id' => $denim->id],
            ['attribute_value_id' => $sizeSm->id],
            ['attribute_value_id' => $stretchYes->id],
        ]);

        $product2 = \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Trouser #2',
            'description' => 'Stunning trousers.',
            'price' => 89.99,
        ]);

        $product2->productAttributes()->createMany([
            ['attribute_value_id' => $jeans->id],
            ['attribute_value_id' => $sizeMd->id],
            ['attribute_value_id' => $stretchNo->id],
        ]);
    }
}
