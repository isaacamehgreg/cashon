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
use Illuminate\Support\Arr;

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
    //get the winning number
    $winning_number =   DB::table('games_played')->select('number')->groupBy('number')->orderByRaw('COUNT(*) ASC')->limit(5)->get();      
        
    $magic_number= array( $winning_number[0]->number=>$winning_number[0]->number, 
                          $winning_number[1]->number=>$winning_number[1]->number,
                          $winning_number[2]->number=>$winning_number[2]->number,
                          $winning_number[3]->number=>$winning_number[3]->number,
                          $winning_number[4]->number=>$winning_number[4]->number);
    $magic= $winning_number[0]->number. 
            $winning_number[1]->number.
            $winning_number[2]->number.
            $winning_number[3]->number.
            $winning_number[4]->number;
    //magic number is just winnng numbers in key value pair so that Arr::exists can work and search

     //for loop throw all the tickes
      $bets = Bet::all();
      foreach($bets as $bet){
          
        echo $bet->bet_code.'_'.$winning_number[0]->number,$winning_number[1]->number,$winning_number[2]->number, $winning_number[3]->number,$winning_number[4]->number.'||||||||||';
        //compare using arr exist while counting and updating a collumn of combination:
         
         $result= DB::table('bets')->where('bet_code',$bet->bet_code)->update(['result'=>$magic,'status'=>'played',]);

          $count = 0;
        

        if($exists = Arr::exists($magic_number, $bet->n1)){  //if the number matches 
            
            $count = $count+1;
            //update the bet ticket status
        
        }
        if($exists = Arr::exists($magic_number, $bet->n2)){  //if the number matches 
            
            $count = $count+1;
            //update the bet ticket status
         
        }
        if($exists = Arr::exists($magic_number, $bet->n3)){  //if the number matches 
          
            
            //update the bet ticket status
          
        }
        if($exists = Arr::exists($magic_number, $bet->n4)){  //if the number matches 
           
            $count = $count+1;
            //update the bet ticket status
           
        }
        if($exists = Arr::exists($magic_number, $bet->n5)){  //if the number matches 
           
            $count = $count+1;
            //update the bet ticket status
          
        }
        DB::table('bets')->where('bet_code',$bet->bet_code)->update(['combination'=>$count]);
        echo 'done';
        
       
      


        //compare if n1 wins if n2 wings
        


      }

});

