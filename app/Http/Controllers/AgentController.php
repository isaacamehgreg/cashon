<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index(){
        
        return view('agent.index');
    }
    public function all_terminal(){
        
        return view('agent.index');
    }
}
