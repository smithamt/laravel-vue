<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ContractWebController extends Controller
{
    public function index()
    {
        return view('app.organization.contract');
    }
}
