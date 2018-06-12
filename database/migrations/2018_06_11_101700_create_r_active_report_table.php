<?php

use Illuminate\Support\Facades\Schema;
use duxet\Rethinkdb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRActiveReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('rethinkdb')->create('r_active_report', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('r_active_report');
    }
}
