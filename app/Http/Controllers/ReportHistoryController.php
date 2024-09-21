<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportHistoryController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลทั้งหมดจากตาราง reports
        $reports = Report::all();

        // ส่งข้อมูลไปยัง view
        return view('report_history', compact('reports'));
    }
    // ลบรายงานออกจากฐานข้อมูล
    public function destroy($id)
    {
        $report = Report::find($id);
        $report->delete();

        return redirect()->route('report-history')->with('success', 'ลบข้อมูลสำเร็จแล้ว');
    }

}
