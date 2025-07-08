<?php

namespace App\Models;

use App\Enums\AttributeFieldType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeField extends Model
{
    /** @use HasFactory<\Database\Factories\AttributeFieldFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'type' => AttributeFieldType::class
        ];
    }

    public function group()
    {
        return $this->belongsTo(AttributeGroup::class);
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
