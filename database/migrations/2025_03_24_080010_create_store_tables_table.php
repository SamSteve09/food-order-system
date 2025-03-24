<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateStoreTablesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('store_tables', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->string('table_qr_code', 255)->unique();
            $table->string('table_number', 3);
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade')->primary();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_tables');
    }
};
