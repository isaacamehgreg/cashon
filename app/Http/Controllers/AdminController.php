<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //everything about agent here
    public function create_agent(){
          return view('admin.create_agent');
    }
    public function create_an_agent(Request $request){
        
        $insert = DB::table('users')->insert([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('email')),
            'phone'=>$request->input('phone'),
           
            'address'=>$request->input('address'),
            'state'=>$request->input('state'),
            'unhash'=>$request->input('password'),
            'role'=>'agent',
        ]);
        return redirect('create_agent');
        
  }
}
