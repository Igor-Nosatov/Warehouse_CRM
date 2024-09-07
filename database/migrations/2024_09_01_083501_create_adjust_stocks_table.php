<?php

use App\Enums\AdjustmentType;
use App\Enums\ReasonInventoryType;
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
        Schema::create('adjust_stocks', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_status', AdjustmentType::all())->default(AdjustmentType::QUANTITY_ADJUSTMENT);
            $table->date('adjust_stock_date');
            $table->enum('reason_for_inventory', ReasonInventoryType::all())->default(ReasonInventoryType::OTHER);
            $table->unsignedInteger('quantity_available');
            $table->unsignedInteger('new_quantity');
            $table->text('description')->nullable();
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('warehouse_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjust_stocks');
    }
};
