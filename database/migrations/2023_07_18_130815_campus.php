<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Campus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('district_id');
            $table->timestamps();

            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');

            $table->index('name');
            $table->index('district_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::dropIfExists('campus');
}
}
