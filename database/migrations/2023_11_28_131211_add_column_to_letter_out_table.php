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
        Schema::table('letter_outs', function (Blueprint $table) {
            if (Schema::hasColumn('letter_outs', 'about')) {
                $table->dropColumn('about');
            }
            if (Schema::hasColumn('letter_outs', 'description')) {
                $table->dropColumn('description');
            }

            $table->string('type')->nullable();
            $table->string('about')->nullable();
            $table->text('description')->nullable();
            $table->text('attachment_file_id')->nullable();
            $table->integer('letter_refrency_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('letter_outs', function (Blueprint $table) {
        });
    }
};
