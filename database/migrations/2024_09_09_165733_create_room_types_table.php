<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypesTable extends Migration
{
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('room_description');   // ชื่อลักษณะห้อง
            $table->decimal('room_price', 10, 2); // ราคาห้อง
            $table->integer('contact_date'); // ระยะสัญญา
            $table->text('furniture_details');    // รายละเอียดเฟอร์นิเจอร์
            $table->decimal('deposit_price', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->dropSoftDeletes(); // ลบคอลัมน์ deleted_at
        });
    
        Schema::dropIfExists('room_types');
    }
    
}