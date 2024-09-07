<?php

use App\Enums\VendorStatus;
use App\Enums\VendorType;
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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 100);
            $table->string('vendor_first_name', 100);
            $table->string('vendor_last_name', 100);
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('location');
            $table->string('website')->nullable();
            $table->text('remark')->nullable();
            $table->enum('vendor_status', VendorStatus::all())->default(VendorStatus::ACTIVE->value);
            $table->enum('vendor_type', VendorType::all())->default(VendorType::WHOLESALER->value);
            $table->integer('receivables');
            $table->integer('used_credits');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['vendor_status', 'vendor_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
