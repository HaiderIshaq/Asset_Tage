<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssetDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_details', function (Blueprint $table) {
            $table->id();
            $table->string('fa_category');
            $table->unsignedBigInteger('fa_category_code');
            $table->string('fa_sub_category');
            $table->unsignedBigInteger('fa_sub_category_code');
            $table->unsignedBigInteger('asset_image_id');
            $table->string('description');
            $table->string('condition');
            $table->integer('quantity');
            $table->string('make/model');
            $table->string('custodian');
            $table->string('room');
            $table->integer('status');
            $table->unsignedBigInteger('campus_id');
            $table->timestamps();
            $table->foreign('fa_category_code')->references('code')->on('fa_categories')->onDelete('cascade');
            $table->foreign('fa_sub_category_code')->references('code')->on('fa_sub_categories')->onDelete('cascade');
            $table->foreign('campus_id')->references('id')->on('campuses')->onDelete('cascade');
            $table->foreign('asset_image_id')->references('id')->on('asset_images')->onDelete('cascade');
            $table->index('fa_category');
            $table->index('fa_sub_category_code');
            $table->index('asset_image_id');
            $table->index('campus_id');
            $table->index('description');
            $table->index('condition');
            $table->index('quantity');
            $table->index('fa_category_code');
            $table->index('make/model');
            $table->index('custodian');
            $table->index('room');
            $table->index('status');
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
