<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function index(){
        
        return view('agent.index');
    }
    public function all_terminal(){
        
        return view('agent.index');
    }
  
}
