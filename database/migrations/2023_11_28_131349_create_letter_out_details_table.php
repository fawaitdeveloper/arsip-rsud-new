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
        Schema::create('letter_out_details', function (Blueprint $table) {
            $table->id();
            $table->integer('letter_out_id');
            $table->integer('job_position_id');
            $table->integer('user_id')->nullable();
            $table->enum('action', ['read', 'write']);
            $table->boolean('status');
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
        Schema::dropIfExists('letter_out_details');
    }
};
