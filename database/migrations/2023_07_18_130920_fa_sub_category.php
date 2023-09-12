<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FaSubCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fa_sub_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('name');
            $table->unsignedBigInteger('code');
            $table->unsignedBigInteger('fa_category_code');
            $table->timestamps();
            $table->primary(['code','id']);
            $table->foreign('fa_category_code')->references('code')->on('fa_categories')->onDelete('cascade');

            $table->index('name');
            $table->index('code');
            $table->index('fa_category_code');

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
