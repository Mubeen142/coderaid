<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RaidSession;

class CoreController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function createSession()
    {
        $session = RaidSession::create();
        return redirect()->route('session.view', ['session' => $session->token]);
    }

    public function viewSession(RaidSession $session)
    {
        return view('view-session', ['session' => $session]);
    }
}