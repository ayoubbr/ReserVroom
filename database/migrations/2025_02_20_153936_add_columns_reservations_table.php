<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::table('reservations', function (Blueprint $table) {
            $table->integer('duration');
            $table->dropColumn('check_in');
            $table->dropColumn('check_out');
        });
    }
};
