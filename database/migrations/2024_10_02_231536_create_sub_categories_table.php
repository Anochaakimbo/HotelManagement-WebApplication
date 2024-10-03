<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('sub_categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('main_category_id');
        $table->foreign('main_category_id')->references('id')->on('main_categories')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('sub_categories');
}
};