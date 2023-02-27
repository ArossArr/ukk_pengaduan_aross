<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('view/loginv');
    }
    public function dashv()
    {
        return view('view/dashboardv');
    }
}
