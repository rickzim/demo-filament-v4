<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    /** @use HasFactory<\Database\Factories\AttributeGroupFactory> */
    use HasFactory;

    public function fields()
    {
        return $this->hasMany(AttributeField::class);
    }

    public static function getGroupsByCategory($categoryId)
    {
        return AttributeGroup::whereHas('fields.values.productAttributes.product', function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        })->distinct()->pluck('name', 'id');
    }
}
