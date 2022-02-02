<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        $adminData = Admin::find(4);
        // dd($adminData);
        return view('admin.admin_profile', compact('adminData'));
    }
}
