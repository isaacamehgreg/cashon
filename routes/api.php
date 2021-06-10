<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TerminalController;
use App\Models\Bet;
use App\Models\GamesPicked;
use App\Models\Multiplier;
use App\Models\User;
use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use App\Models\Game;

// Route::post('/login',[AuthController::class, 'login']);


//protected route
// Route::group(['middleware'=>['auth:sanctum']] , function () {
//     Route::post('/_logout',[AuthController::class, '_logout']);
//     Route::post('/place_bet',[TerminalController::class, 'place_bet']);

Route::post('login', function (Request $request) {
    $cashier_code = $request->input('cashier_code');
    $cashier_password = $request->input('password');
    $cashier_id = DB::table('cashiers')->where('cashier_code',$cashier_code)->where('cashier_password',$cashier_password)->value('id');

    if($cashier_id != null){
      return response()->json([
          'status'=>'success',
          'cashier_id'=>$cashier_code,

       ]);
    }else{
        return response()->json([
            'status'=>'failed',
            'msg'=>'cashier not found',
         ]);
    }
});

Route::get('games', function () {
    
      return response()->json([
          'status'=>'success',
          'games'=>Game::all(),
       ]);
    
});

Route::post('bet/{cashier_id}', function(Request $request, $cashier_id){
   //fetch form data
    $bet = $request->all();
    //$try = $bet['status'];
 //   $try = $bet['games'][0]['n1'];
  //$try = count($bet['games']);
  // get all the values
   $game_code = $bet['game_code'];
   $phone = $bet['phone_number'];
   $games =$bet['games'];

   //validate cashier
   if(Cashier::where('cashier_id',$cashier_id)->first() == null){
    return response()->json(['status'=>'failed', 'msg'=>'user not found'],404);
   }


   //place a bet
   $num_games = count($games);
   foreach($games as $game){
       //insert in to bets and submit numbers for comparism
       $insert = DB::table('bet')->insert([
           'cashier_id'=>$cashier_id,
           'game_code'=> $game_code,
           'phone_number'=>$phone,
           'n1'=>$games['n1'],
           'n2'=>$games['n2'],
           'n3'=>$games['n3'],
           'n4'=>$games['n4'],
           'n5'=>$games['n5'],
           'n6'=>$games['n6'],
           'stake'=>$games['stake'],
           'bet_code'=>$games['n1'].$games['n2'].$games['n3'].$games['n4'].$games['n5'].$games['n6'],
           'ticket_number'=>$cashier_id . $game_code
       ]);
     $game['n1'];
   }




    
    return response()->json($t,200);
});














































//     Route::get('/least', function () {

//         $most =   DB::table('games_played')
//                ->select('number')
//                ->groupBy('number')
//                ->orderByRaw('COUNT(*) DESC')
//                ->limit(5)
//                ->get();
   
//        $least =   DB::table('games_played')
//                    ->select('number')
//                    ->groupBy('number')
//                    ->orderByRaw('COUNT(*) ASC')
//                    ->limit(5)
//                    ->get();
   
//        return response()->json($least,200);
       

//    });
//    Route::get('try', function () {
//        return 'try';
//    });