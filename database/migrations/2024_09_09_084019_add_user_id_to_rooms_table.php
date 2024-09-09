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
    Schema::table('rooms', function (Blueprint $table) {
        $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // เพิ่มคอลัมน์ user_id
    });
}

public function down()
{
    Schema::table('rooms', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

};
