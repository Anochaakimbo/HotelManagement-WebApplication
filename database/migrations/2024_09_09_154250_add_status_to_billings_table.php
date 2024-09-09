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
        Schema::table('billings', function (Blueprint $table) {
            $table->enum('status', ['ส่งไปยังผู้ใช้แล้ว', 'รอชำระเงิน', 'รอยืนยัน', 'ชำระค่าห้องแล้ว'])->default('ส่งไปยังผู้ใช้แล้ว');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('billings', function (Blueprint $table) {
            //
        });
    }
};
