<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('latitude', 10, 7);
            $table->float('longitude', 10, 7);
            $table->string('address');
            $table->unsignedInteger('type');
            $table->foreign('type')
                  ->references('id')
                  ->on('clinic_types')
                  ->onDelete('cascade');
            $table->unsignedInteger('user_created');
            $table->foreign('user_created')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->boolean('confirmed')
                  ->default(false);
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
        Schema::dropIfExists('clinics');
    }
}
