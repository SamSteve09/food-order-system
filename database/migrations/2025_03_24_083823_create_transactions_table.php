<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->string('payment_method', 255);
            $table->string('payment_response', 255)->nullable();
            $table->dateTime('transaction_date');
            $table->foreignId('staff_id')->constrained('staffs')->onDelete('cascade');
            $table->foreignId('staff_store_id')->constrained('staffs')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->timestamps();
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
