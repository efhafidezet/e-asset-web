<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment', function (Blueprint $table) {
            $table->increments('assignment_id');
            $table->string('assignment_name');
            $table->dateTime('assignment_date');
            $table->longText('assignment_details');
            $table->integer('location_id');
            $table->integer('radius');
            $table->integer('assignment_status');           //0 Belum Tersedia, 1 Selesai, 2 Berjalan
            $table->tinyInteger('is_active')->default('1');
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
        Schema::dropIfExists('assignment');
    }
}
