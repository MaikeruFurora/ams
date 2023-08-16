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
        Schema::create('pullout_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pullout_id');
            $table->foreign('pullout_id')->references('id')->on('pullouts');
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id')->references('id')->on('assets');
            $table->string('pullout_status',55)->nullable();
            $table->string('return_status',55)->nullable();
            $table->text('return_remarks')->nullable();
            $table->date('return_date')->nullable();

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
        Schema::dropIfExists('pullout_details');
    }
};
