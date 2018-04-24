<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->unsignedInteger('parent');
            $table->unsignedInteger('sort');
            $table->unsignedInteger('menu');
            $table->foreign('menu')
                  ->references('id')
                  ->on('menus')
                  ->onDelete('cascade');
            $table->string('icon')
                  ->nullable();
            $table->string('link')
                  ->nullable();
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
        Schema::dropIfExists('menu_items');
    }
}
