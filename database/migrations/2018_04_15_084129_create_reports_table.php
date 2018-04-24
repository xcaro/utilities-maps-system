<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->float('latitude', 10, 7);
            $table->float('longitude', 10, 7);
            $table->string('notes')
                  ->nullable();
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')
                  ->references('id')
                  ->on('report_types')
                  ->onDelete('cascade');
            $table->unsignedInteger('user_created')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->boolean('active')
                  ->default(true);
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
        Schema::dropIfExists('reports');
    }
}
