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
        Schema::create('wallets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['cash', 'bank', 'digital', 'credit_card']);
            $table->decimal('balance', 15, 2)->default(0);
            $table->decimal('credit_limit', 15, 2)->nullable();
            $table->boolean('include_in_total')->default(true);
            $table->timestamps();

            $table->index(['id', 'name', 'type', 'balance', 'credit_limit']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
