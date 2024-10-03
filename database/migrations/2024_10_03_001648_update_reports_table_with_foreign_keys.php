<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReportsTableWithForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            // ลบคอลัมน์เก่า (main_category, sub_category)
            $table->dropColumn('main_category');
            $table->dropColumn('sub_category');

            // เพิ่มคอลัมน์ใหม่ที่เชื่อมโยงกับตาราง main_categories และ sub_categories
            $table->foreignId('main_category_id')->constrained('main_categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            // ลบ foreign key และคอลัมน์ใหม่
            $table->dropForeign(['main_category_id']);
            $table->dropForeign(['sub_category_id']);
            $table->dropColumn('main_category_id');
            $table->dropColumn('sub_category_id');

            // เพิ่มคอลัมน์เก่ากลับมา
            $table->string('main_category');
            $table->string('sub_category');
        });
    }
}
