<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return redirect()->to(site_url('admin/dashboard'));
    }
}
