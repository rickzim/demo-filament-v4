<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\AttributeField;
use App\Models\AttributeGroup;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('attribute_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(AttributeGroup::class)->constrained()->onDelete('cascade');;
            $table->string('type');
            $table->boolean('is_filterable')->default(false);
            $table->boolean('is_required')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->decimal('value_numeric', 10, 2)->nullable();
            $table->foreignIdFor(AttributeField::class)->constrained()->onDelete('cascade');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('product_attribute', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(AttributeValue::class)->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'attribute_value_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('attribute_groups');
        Schema::dropIfExists('attribute_fields');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('product_attributes');
    }
};
