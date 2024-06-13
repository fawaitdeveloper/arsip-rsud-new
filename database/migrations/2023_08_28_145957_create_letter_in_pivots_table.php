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
        Schema::create('letter_in_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_in_id');
            $table->foreignId('user_id');
            $table->foreignId('cc_list_id');
            $table->string('attachment');                       
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
        Schema::dropIfExists('letter_in_pivots');
    }
};
