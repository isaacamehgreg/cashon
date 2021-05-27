<?php

use App\Models\Bet;
use App\Models\GamesPicked;
use App\Models\Multiplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $play = DB::table('games_played')->get(); 
    return view('dashboard')->with(['play',$play]);

})->name('dashboard');


//placeholder
Route::post('/play/{agent_id}/{terminal_id}', function (Request $request, $agent_id, $terminal_id) {
  
    if(Auth::user()->role == 'terminal'){

    
   // dd($gamecode);
    $n1= $request->input('1');
    $n2= $request->input('2');
    $n3= $request->input('3');
    $n4= $request->input('4');
    $n5= $request->input('5');
    $bet_code = $n1.$n2.$n3.$n4.$n5;
    $gamecode =  $n1.$n2.$n3.$n4.$n5.'_'.random_int(1,100000);
    $stake = 200;

    


    // to bet board
     $f1 = DB::table('games_played')->insert([
            'terminal_id' =>'NG-LG-OOO1',
            'game_code'=>$gamecode,
             'number'=>$n1,
             'paid'=>200
             
         ]);
         $f2 = DB::table('games_played')->insert([
             'terminal_id' =>'NG-LG-OOO1',
             'game_code'=>$gamecode,
              'number'=>$n2,
              'paid'=>200
          ]);
          $f3 = DB::table('games_played')->insert([
             'terminal_id' =>'NG-LG-OOO1',
             'game_code'=>$gamecode,
              'number'=>$n3,
              'paid'=>200
          ]);
          $f4 = DB::table('games_played')->insert([
             'terminal_id' =>'NG-LG-OOO1',
             'game_code'=>$gamecode,
              'number'=>$n4,
              'paid'=>200
          ]);
          $f5 = DB::table('games_played')->insert([
             'terminal_id' =>'NG-LG-OOO1',
             'game_code'=>$gamecode,
              'number'=>$n5,
              'paid'=>200
        ]);
    

        //add bets
        $add = DB::table('bets')->insert([
            'agent_id'=>$agent_id,
            'terminal_id'=>$terminal_id,
            'n1'=>$n1,
            'n2'=>$n2,
            'n3'=>$n3,
            'n4'=>$n4,
            'n5'=>$n5,
            'bet_code'=>$bet_code,
            'stake'=>$stake,
            'potential_winning'=>$stake*Multiplier::find(1)->value('2_combination'),
            'status'=>'about_to_play',
            'created_at'=>Carbon::now(),
            'ticket_number'=>$agent_id.$terminal_id.random_int(1,1000).'_'.$bet_code,


        ]);

        return redirect('/dashboard');

    }else{
        echo 'only terminals can play';
    }   

    
   
});

Route::get('result', function () {
    
     $most =   DB::table('games_played')
            ->select('number')
            ->groupBy('number')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->get();

    $least =   DB::table('games_played')
                ->select('number')
                ->groupBy('number')
                ->orderByRaw('COUNT(*) ASC')
                ->limit(5)
                ->get();

    dd($least);
    

});

//all games played
Route::get('/bets',function(){
 return Bet::all();

});
// pick a winer
Route::get('/winners', function(){
    
});

