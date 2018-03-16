<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('flight_type', 10);
            $table->date('from_date');
            $table->time('from_time');
            $table->date('return_date');
            $table->time('return_time');
            $table->string('from_city_name');
            $table->string('to_city_name');
            $table->string('flight_class');
            $table->integer('total_adults');
            $table->integer('total_children');
            $table->string('first_name');
            $table->string('last_name');
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
        Schema::dropIfExists('flight_books');
    }
}
