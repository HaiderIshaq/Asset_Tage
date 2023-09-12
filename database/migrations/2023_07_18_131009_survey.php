<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Survey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  Schema::create('surveys', function (Blueprint $table) {
        $table->id();
        $table->string('status');
        $table->unsignedBigInteger('asset_details_id');
        $table->unsignedBigInteger('user_id');
        $table->timestamps();

        $table->foreign('asset_details_id')->references('id')->on('asset_details')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        $table->index('status');
        $table->index('asset_details_id');
        $table->index('user_id');

    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
