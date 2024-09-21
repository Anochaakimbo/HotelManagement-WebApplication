<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueReport; // เรียกใช้โมเดล IssueReport

class IssueReportController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลการแจ้งปัญหาทั้งหมดจากฐานข้อมูล
        $reports = IssueReport::with('user')->get();

        // ส่งข้อมูล $reports ไปยัง view 'admin.csp'
        return view('admin.csp', compact('reports'));
    }
}





