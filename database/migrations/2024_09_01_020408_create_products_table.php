<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_returnable')->nullable();
            $table->boolean('is_have_variant')->nullable();
            $table->unsignedBigInteger('core_product_id')->nullable()->comment('core product ID for product variant');
            $table->string('title');
            $table->string('sku')->unique();
            $table->string('barcode')->unique();
            $table->integer('retail_price')->nullable();
            $table->integer('wholesale_price')->nullable();
            $table->integer('cost');
            $table->boolean('is_draft')->nullable();
            $table->foreignId('product_type_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_status_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_attribute_id')->constrained('product_attributes')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['category_id', 'brand_id']);
            $table->index(['product_type_id', 'product_status_id']);
            $table->index(['retail_price', 'wholesale_price']);
            $table->index(['category_id', 'product_type_id']);
            $table->index(['brand_id', 'product_status_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
