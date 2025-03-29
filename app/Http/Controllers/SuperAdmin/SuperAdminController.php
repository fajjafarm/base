<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

class SuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');      // Ensure user is logged in
        $this->middleware('superadmin'); // Restrict to super admins
    }
}