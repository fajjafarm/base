<?php

namespace App\Http\Controllers\SuperAdmin;

class DashboardController extends SuperAdminController
{
    public function index()
    {
        return view('superadmin.dashboard');
    }
}