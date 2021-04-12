<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track', function (Blueprint $table) {
            $table->increments('track_id');
            $table->integer('borrow_id');
            $table->dateTime('track_time');
            $table->longText('latitude');
            $table->longText('longitude');
            // $table->string('unique_code');
            // $table->dateTime('uploaded_time', 0);
            // $table->longText('latitude');
            // $table->longText('longitude');
            // $table->integer('asset_id');
            // $table->integer('user_id');
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
        Schema::dropIfExists('track');
    }
}
