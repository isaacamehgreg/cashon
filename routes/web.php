<?php

use App\Models\GamesPicked;
use Illuminate\Http\Request;
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
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $play = DB::table('games_played')->get(); 
    return view('dashboard')->with(['play',$play]);

})->name('dashboard');


//placeholder
Route::post('/play', function (Request $request) {
  
   // dd($gamecode);
    $n1= $request->input('1');
    $n2= $request->input('2');
    $n3= $request->input('3');
    $n4= $request->input('4');
    $n5= $request->input('5');
    $gamecode =  $n1.$n2.$n3.$n4.$n5.'_'.random_int(1,100000);

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

        

    
   

    return redirect('/dashboard');
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
Route::get('/allgames',function(){

});
// pick a winer
Route::get('/winners', function(){
    
});

