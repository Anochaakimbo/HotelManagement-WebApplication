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
        $data = new Report();
        $data->user_id = $request->user_id;
        $data->room_number = $request->room_number;
        $data->main_category = $request->main_category;
        $data->sub_category = $request->sub_category;
        $data->description = $request->problem_description;
        $data->contact_number = $request->contact_number;
        $data->permission = $request->permission;
        $data->save();


        return redirect()->back()->with('success', 'แจ้งปัญหาเรียบร้อยแล้ว!');
    }
}
