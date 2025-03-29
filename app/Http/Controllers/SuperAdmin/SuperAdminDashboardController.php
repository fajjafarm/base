<?php

namespace App\Http\Controllers\SuperAdmin;

class SuperAdminDashboardController extends SuperAdminController
{
    public function index()
    {
        return view('superadmin.dashboard');
    }
}