<?php

use App\Enums\SupportTicketCategoryType;
use App\Enums\SupportTicketPriorityType;
use App\Enums\SupportTicketStatusType;
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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('status', SupportTicketStatusType::all())->default(SupportTicketStatusType::OPEN);
            $table->enum('priority', SupportTicketPriorityType::all())->default(SupportTicketPriorityType::MEDIUM);
            $table->enum('category', SupportTicketCategoryType::all())->default(SupportTicketCategoryType::GENERAL);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
