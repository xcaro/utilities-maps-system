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
            $table->string('comment')
                  ->nullable();
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('user_created')
                  ->nullable();
            $table->unsignedInteger('ward_id')
                  ->nullable();
            $table->unsignedInteger('district_id')
                  ->nullable();
            $table->boolean('active')
                  ->default(true);
            $table->boolean('confirm')
                  ->default(false);
            $table->string('image')
                  ->nullable();
            $table->timestamps();

            $table->foreign('ward_id')
                  ->references('id')
                  ->on('wards')
                  ->onDelete('cascade');
            $table->foreign('district_id')
                  ->references('id')
                  ->on('districts')
                  ->onDelete('cascade');
            $table->foreign('user_created')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('type_id')
                  ->references('id')
                  ->on('report_types')
                  ->onDelete('cascade');
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
