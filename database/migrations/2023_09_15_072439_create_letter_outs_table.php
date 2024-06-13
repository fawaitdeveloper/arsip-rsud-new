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
        Schema::create('letter_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_category_id');
            $table->foreignId('letter_attribute_id');
            $table->foreignId('letter_urgency_id');
            $table->string('sender_name');
            $table->string('sender_position');
            $table->string('sender_instansi');
            $table->string('letter_number');
            $table->date('letter_date');
            $table->date('letter_received');
            $table->date('about');
            $table->date('description');
            $table->string('letter_file');
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
        Schema::dropIfExists('letter_outs');
    }
};
