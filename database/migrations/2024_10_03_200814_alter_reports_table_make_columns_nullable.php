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
    Schema::table('reports', function (Blueprint $table) {
        $table->unsignedBigInteger('main_category_id')->nullable()->change();
        $table->unsignedBigInteger('sub_category_id')->nullable()->change();
    });
}

public function down()
{
    Schema::table('reports', function (Blueprint $table) {
        $table->unsignedBigInteger('main_category_id')->nullable(false)->change();
        $table->unsignedBigInteger('sub_category_id')->nullable(false)->change();
    });
}
};