<?php

namespace App\Http\Controllers;

use App\Http\Services\Report\ReportService;

class ReportController extends Controller
{
    public function index()
    {
        
        return view('report', ['report' => (new ReportService())->getReport()]);

    }
}
