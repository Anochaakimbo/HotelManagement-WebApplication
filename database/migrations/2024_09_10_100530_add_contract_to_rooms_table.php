<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContractToRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // เพิ่มคอลัมน์ contract สำหรับเก็บวันที่ทำสัญญา
            $table->date('contract')->nullable()->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // ลบคอลัมน์ contract เมื่อ rollback
            $table->dropColumn('contract');
        });
    }
}
