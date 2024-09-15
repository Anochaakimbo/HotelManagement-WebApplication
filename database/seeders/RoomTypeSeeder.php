<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // เพิ่มประเภทห้องลงในตาราง room_type
        RoomType::firstOrCreate([
            'room_description' => 'Premium',
            'room_price' => 8000,
            'contact_date' => 12,
            'furniture_details' => 'แอร์ ตู้เย็น เตียง เราท์เตอร์ส่วนตัว กาต้มน้ำร้อน ไมโครเวฟ',
            'deposit_price' => 7000,
            'water_unit' => 20,
            'electrical_unit' => 7,
        ]);

        RoomType::firstOrCreate([
            'room_description' => 'Twin',
            'room_price' => 6500,
            'contact_date' => 12,
            'furniture_details' => 'แอร์ ตู้เย็น เตียง เก้าอี้ โต๊ะ',
            'deposit_price' => 7000,
            'water_unit' => 20,
            'electrical_unit' => 7,
        ]);

        RoomType::firstOrCreate([
            'room_description' => 'Single',
            'room_price' => 5000,
            'contact_date' => 12,
            'furniture_details' => 'แอร์ ตู้เย็น เตียง เก้าอี้ โต๊ะ',
            'deposit_price' => 7000,
            'water_unit' => 20,
            'electrical_unit' => 7,
        ]);
    }
}
