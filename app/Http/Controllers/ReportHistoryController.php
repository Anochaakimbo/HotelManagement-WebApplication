<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
class ReportHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $reports = Report::where('user_id', $user->id)->with('room')->get(); // ดึงข้อมูลที่เกี่ยวข้องกับผู้ใช้

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
