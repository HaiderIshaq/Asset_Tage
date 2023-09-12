<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FaCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fa_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('name');
            $table->unsignedBigInteger('code');
            $table->timestamps();

            $table->primary(['code','id']);
          

            $table->index('name');
            $table->index('code');

           

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
