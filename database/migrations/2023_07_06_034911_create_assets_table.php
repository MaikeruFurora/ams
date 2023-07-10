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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('asset_status_id');
            $table->foreign('asset_status_id')->references('id')->on('asset_statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->string('item_name',100);
            $table->string('brand',100);
            $table->string('asset_code',100);
            $table->string('serial_number',100)->nullable();
            $table->string('purchase_order',100)->nullable();
            $table->string('purchase_amount',100)->default(0);
            $table->string('actual_amount',100)->default(0);
            $table->date('date_purchase');
            $table->date('date_recieve');
            $table->string('description',100)->nullable();
            $table->string('service_warranty',100)->nullable();
            $table->string('product_warranty',100)->nullable();
            $table->string('uom',100)->dafault(0);
            $table->string('color',100)->nullable();
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
        Schema::dropIfExists('assets');
    }
};
