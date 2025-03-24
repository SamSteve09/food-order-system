<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->float('price', 13, 2);
            $table->integer('rating')->nullable()->nullable();
            $table->string('category',50);
            $table->integer('order_frequency');
            $table->boolean('availability');
            $table->string('image', 255);
            $table->date('menu_item_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
