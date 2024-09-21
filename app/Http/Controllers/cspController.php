<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report; // เรียกใช้โมเดล Report

class cspController extends Controller
{
    // ฟังก์ชันสำหรับแสดงรายงานปัญหา
    public function index()
    {



        $reports = Report::all();


        // ส่งข้อมูลไปยัง view 'csp.blade.php'
        return redirect()->back()->with('reports', $reports);
    }


    // ฟังก์ชันสำหรับลบรายงาน
    public function destroy($id)
    {
        // ลบข้อมูลที่มี id ตรงกับที่ส่งมา
        $report = Report::findOrFail($id);
        $report->delete();

        // ส่งกลับไปหน้าเดิมหลังจากลบเสร็จ
        return redirect()->route('csp.index')->with('success', 'Report deleted successfully');
    }
}
