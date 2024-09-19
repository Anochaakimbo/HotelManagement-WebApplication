<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_slip')->nullable();  // เพิ่มคอลัมน์ payment_slip ที่อนุญาตให้มีค่าเป็น NULL
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('payment_slip');  // ในกรณีที่ต้องการ rollback ให้ลบคอลัมน์นี้ออก
            //
        });
    }
};
