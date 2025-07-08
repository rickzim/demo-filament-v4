<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    /** @use HasFactory<\Database\Factories\AttributeValueFactory> */
    use HasFactory;

    public function field()
    {
        return $this->belongsTo(AttributeField::class, 'attribute_field_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes');
    }

    public function productAttributes()
    {
        return $this->hasMany(\App\Models\ProductAttribute::class);
    }
}
