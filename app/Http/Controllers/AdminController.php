<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //agent
    public function create_agent(){
          return view('admin.create_agent');
    }
    public function create_an_agent(Request $request){
        
        $insert = DB::table('users')->insert([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'phone'=>$request->input('phone'),
           
            'address'=>$request->input('address'),
            'state'=>$request->input('state'),
            'unhash'=>$request->input('password'),
            'role'=>'agent',
        ]);
        return redirect('all_agents');
        
    }
    public function all_agent(){
        $agents = DB::table('users')->where('role','agent')->get();     
        return view('admin.all_agent')->with(['agents'=>$agents,]);
    }
    public function credit_agent(){
        $agents = DB::table('users')->where('role','agent')->get();     
        return view('admin.credit_agent')->with(['agents'=>$agents,]);
    }

    public function credit_an_agent(Request $request){
      
        $insert = DB::table('agent_credits')->insert([
            'agent_id'=>$request->input('agent'),
            'credit'=>$request->input('credit'),
           
        ]);
       
        $debt = DB::table('debts')->insert([
            'agent_id'=>$request->input('agent'),
            'dues_to_be_paid'=>$request->input('credit'),
           
        ]);


        return redirect('all_agents');
        
    }


    //terminal
    public function create_a_terminal(){
        $agents = DB::table('users')->where('role','agent')->get();     
        return view('admin.create_terminal')->with(['agents'=>$agents,]);
    }

    public function create_terminal(Request $request){
        
        $insert = DB::table('users')->insert([

            'own_by'=>$request->input('agent'),
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'phone'=>$request->input('phone'),
           
            'address'=>$request->input('address'),
            'state'=>$request->input('state'),
            'unhash'=>$request->input('password'),
            'role'=>'terminal',
        ]);
        
        $terminal= DB::table('terminal_creds')->insert([
           'agent_id'=>$request->input('agent'),
           'cashier_id'=>$request->input('agent').random_int(1000,2000),
           'password'=>$request->input('password'),
        ]);

        return redirect('all_terminal');
        
    }
    public function all_terminal(){
        $terminal = DB::table('users')->where('role','terminal')->get();     
        return view('admin.all_terminal')->with(['terminals'=>$terminal,]);
    }

    //debt 
    public function debt_summary(){
        $debts = DB::table('debts')->get();     
        return view('admin.debt_summary')->with(['debts'=>$debts,]);
    }
}
