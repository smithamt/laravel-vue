<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class BranchWebController extends Controller
{
    public function index()
    {
        return view('app.organization.branch');
    }
}
