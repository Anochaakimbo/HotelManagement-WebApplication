<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    
    // แสดงฟอร์มแจ้งปัญหา
    public function showReportForm(Request $request)
    {
        $mainCategories = MainCategory::all();
        $subCategories = [];

        // ตรวจสอบว่ามี main_category_id ใน request หรือไม่
        if ($request->has('main_category_id') && $request->main_category_id) {
            $subCategories = SubCategory::where('main_category_id', $request->main_category_id)->get();
        }

        // ส่งข้อมูลไปยัง view
        return view('report', compact('mainCategories', 'subCategories'));
    }
    public function index()
    {
        $reports = Report::all(); // ดึงข้อมูลจากตาราง report
        return view('admin.csp', ['reports' => $reports]);
    }

    // ดึงหมวดหมู่ย่อย
    public function getSubCategories($mainCategoryId)
    {
        // ดึงข้อมูลหมวดหมู่ย่อยตามหมวดหมู่หลักที่เลือก
        $subCategories = SubCategory::where('main_category_id', $mainCategoryId)->get();

        // ส่งกลับในรูปแบบ JSON
        return response()->json($subCategories);
    }

    // บันทึกข้อมูลแจ้งปัญหา
    public function store(Request $request)
    {
        
        // ตรวจสอบว่าฟิลด์เหล่านี้มีค่า
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'main_category_id' => 'required|exists:main_categories,id',  // ตรวจสอบให้แน่ใจว่าฟิลด์นี้อยู่ใน validation
            'sub_category_id' => 'required|exists:sub_categories,id',
            'problem_description' => 'required|string',
            'contact_number' => 'required|string',
            'permission' => 'required|in:allow,disallow',
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'main_category_id' => $request->main_category_id,  // ตรวจสอบการบันทึกค่านี้
            'sub_category_id' => $request->sub_category_id,    // ตรวจสอบการบันทึกค่านี้
            'description' => $request->problem_description,
            'contact_number' => $request->contact_number,
            'permission' => $request->permission,
        ]);

        return redirect()->back()->with('success', 'ส่งคำขอซ่อมสำเร็จ');
    }

}