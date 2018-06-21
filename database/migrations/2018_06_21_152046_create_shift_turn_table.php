<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftTurnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_turn', function (Blueprint $table) {
            $table->unsignedInteger('shift_id');
            $table->unsignedInteger('turn_id');
            $table->boolean('confirmed')->default(false);
            
            $table->foreign('shift_id')
                  ->references('id')
                  ->on('clinic_shifts')
                  ->onDelete('cascade');
            $table->foreign('turn_id')
                  ->references('id')
                  ->on('user_turns')
                  ->onDelete('cascade');

            $table->primary(['shift_id', 'turn_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_turn');
    }
}
