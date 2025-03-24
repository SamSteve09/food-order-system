<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->string('name', 255);
            $table->string('phone_number',15);
            $table->string('username',50)->nullable();
            $table->string('password_hash',255)->nullable();
            $table->string('role',50);
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade')->primary();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
