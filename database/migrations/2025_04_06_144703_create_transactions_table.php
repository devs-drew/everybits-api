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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('wallet_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('category_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['income', 'expense', 'transfer']);
            $table->decimal('amount', 15, 2);
            $table->string('note')->nullable();
            $table->longText('image_url')->nullable();
            $table->date('date');
            $table->timestamps();

            $table->index(['id', 'wallet_id', 'category_id', 'type', 'amount', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
