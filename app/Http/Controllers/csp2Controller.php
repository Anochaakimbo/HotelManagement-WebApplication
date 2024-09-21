<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report; // Assuming you have a Report model

class csp2Controller extends Controller
{
    public function view($id)
    {
        // Fetch the report by ID
        $report = Report::findOrFail($id);

        // Pass the report to the view
        return view('admin.csp2', compact('report'));
    }
}
