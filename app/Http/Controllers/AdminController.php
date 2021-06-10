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
         
        if( DB::table('agent_credits')->where('agent_id', $request->input('agent'))->first() == null){

            $insert = DB::table('agent_credits')->insert([
                'agent_id'=>$request->input('agent'),
                'cash_allocated'=>$request->input('credit'),

            ]);
        }else{
            $cash = DB::table('agent_credits')->where('agent_id', $request->input('agent'))->value();
            $balance = $cash +$request->input('credit');
            $insert = DB::table('agent_credits')->where('agent_id', $request->input('agent'))->update([ 
                'cash_allocated'=>$balance,
            ]);
              
        }


        return redirect('all_agents');
        
    }


    //terminal
    public function create_a_terminal(){
        $agents = DB::table('users')->where('role','agent')->get();     
        return view('admin.create_terminal')->with(['agents'=>$agents,]);
    }

    public function create_terminal(Request $request){
        
        $cashier= DB::table('cashiers')->insert([
            'agent_id'=>$request->input('agent'),
            'area'=>$request->input('area'),
            'area'=>$request->input('area'),
            'cashier_code'=>$request->input('code'),
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

    //games
    public function create_game(Request $request){
        $insert = DB::table('games')->insert([
            'draw'=>$request->input('draw'),
            'game_code'=>$request->input('game_code'),
            'day'=>$request->input('day'),
            'time'=>$request->input('time'),
            'game_name'=>$request->input('game_name'),
            'combo2'=>$request->input('2'),
            'combo3'=>$request->input('3'),
            'combo4'=>$request->input('4'),
            'combo5'=>$request->input('5'),

        ]);
        return redirect('all_games');
    }

    public function all_games(){
        
        $games = DB::table('games')->get();
        return view('game.all_games')->with(['games'=>$games,]);
    }

    public function edit_games($id){
        
        $games = DB::table('games')->where('id',$id)->first();
        
        return view('game.edit_game')->with(['games'=>$games,]);
    }
    
    public function edit_a_games(Request $request ,$id){
        
        $games = DB::table('games')->where('id',$id)->update([
            'draw'=>$request->input('draw'),
            'game_code'=>$request->input('game_code'),
            'day'=>$request->input('day'),
            'time'=>$request->input('time'),
            'game_name'=>$request->input('game_name'),
            'combo2'=>$request->input('2'),
            'combo3'=>$request->input('3'),
            'combo4'=>$request->input('4'),
            'combo5'=>$request->input('5'),
        ]);
        
        return redirect('all_games');
    }
}
