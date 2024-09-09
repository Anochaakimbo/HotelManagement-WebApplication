<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToBillingsTable extends Migration
{
    public function up()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->softDeletes(); // เพิ่มคอลัมน์ deleted_at
        });
    }

    public function down()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->dropSoftDeletes(); // ลบคอลัมน์ deleted_at
        });
    }
}

