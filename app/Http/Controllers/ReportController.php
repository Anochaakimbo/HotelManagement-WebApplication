<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // แสดงฟอร์มการแจ้งปัญหา
    public function showReportForm()
    {
        $mainCategories = MainCategory::with('subCategories')->get();
        return view('report', compact('mainCategories'));
    }

    // บันทึกการแจ้งปัญหา
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'main_category' => 'required|string',
            'sub_category' => 'required|string',
            'problem_description' => 'required|string',
            'contact_number' => 'required|string',
            'permission' => 'required|in:allow,disallow',
        ]);

        // บันทึกข้อมูลการแจ้งปัญหา
        Report::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'main_category' => $request->main_category,
            'sub_category' => $request->sub_category,
            'description' => $request->problem_description,
            'contact_number' => $request->contact_number,
            'permission' => $request->permission,
        ]);

        return redirect()->back()->with('success', 'ส่งคำขอซ่อมสำเร็จ');
    }
}
