<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class ReportController extends Controller
{
    
    public function index()
    {
        $reports = Report::all(); // ดึงข้อมูลจากตาราง report
        return view('admin.csp', ['reports' => $reports]);
    }

    public function store(Request $request)
    {
        // Check the form data
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'main_category' => 'required|string',
            'sub_category' => 'required|string',
            'problem_description' => 'required|string',
            'contact_number' => 'required|string',
            'permission' => 'required|in:allow,disallow',
        ]);

        // Store the new report in the database
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
