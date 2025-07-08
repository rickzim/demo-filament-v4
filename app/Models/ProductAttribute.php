<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttribute extends Pivot
{
    protected $fillable = [
        'product_id',
        'attribute_value_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function value()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }

    public function field()
    {
        return $this->hasOneThrough(
            AttributeField::class,
            AttributeValue::class,
            'id', // AttributeValue.id
            'id', // AttributeField.id
            'attribute_value_id', // ProductAttribute.attribute_value_id
            'attribute_field_id' // AttributeValue.attribute_field_id
        );
    }
}
