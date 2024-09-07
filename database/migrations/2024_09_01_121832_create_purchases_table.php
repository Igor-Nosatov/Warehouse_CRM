<?php

use App\Enums\SalesOrderStatus;
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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->enum('status', SalesOrderStatus::all())->default(SalesOrderStatus::PROCESSING);
            $table->unsignedBigInteger('total_amount');
            $table->unsignedBigInteger('total_quantity');
            $table->datetime('date_time_of_placement');
            $table->datetime('date_time_of_delivery')->nullable();
            $table->string('delivery_location');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_status_id')->constrained()->onDelete('cascade');
            $table->foreignId('purchase_transaction_id')->constrained('purchase_transactions', 'id')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'date_time_of_placement', 'vendor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
