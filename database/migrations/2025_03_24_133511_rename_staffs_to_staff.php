<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameStaffsToStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Renaming the table from 'staffs' to 'staff'
        Schema::rename('staffs', 'staff');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reverting back from 'staff' to 'staffs'
        Schema::rename('staff', 'staffs');
    }
}
