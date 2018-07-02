<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_user', function (Blueprint $table) {
            $table->unsignedInteger('shift_id');
            $table->unsignedInteger('user_id');
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
            
            $table->foreign('shift_id')
                  ->references('id')
                  ->on('clinic_shifts')
                  ->onDelete('cascade');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->primary(['shift_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_user');
    }
}
