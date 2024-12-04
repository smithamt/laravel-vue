<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationWebController extends Controller
{
    public function index()
    {
        return view('app.notification');
    }
}
