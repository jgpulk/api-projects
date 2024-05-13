<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Weather extends BaseController
{
    public function index()
    {
        return view('location_view');
    }
}
