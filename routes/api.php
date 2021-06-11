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
    $cashier_password = $request->input('cashier_password');
    
   
    $cashier_id = DB::table('cashiers')->where('cashier_code',$cashier_code)->where('cashier_password',$cashier_password)->value('cashier_id');

    if($cashier_id != null){
      return response()->json([
          'status'=>'success',
          'cashier_id'=>$cashier_id,
          'cashier_balance'=>DB::table('cashiers')->where('cashier_id',$cashier_id)->value('cash_allocated'),

       ]);
    }else{
        return response()->json([
            'status'=>'failed',
            'msg'=>'cashier not found',
         ]);
    }
    return 'you did not enter anything';
});

Route::get('games', function () {
    
      return response()->json([
          'status'=>'success',
          'games'=>Game::all(),
       ]);
    
});

Route::post('bet/{cashier_id}', function(Request $request, $cashier_id){

    
   //validate cashier
   $cashier=Cashier::where('cashier_id',$cashier_id)->first();
   if($cashier == null){
    return response()->json(['status'=>'failed', 'msg'=>'user not found'],404);
   }   

   //fetch form data
    $bet = $request->all();
  //$try = $bet['status'];
  //$try = $bet['games'][0]['n1'];
  //$try = count($bet['games']);
  // get all the values
   $game_code = $bet['game_code'];
   $phone = $bet['phone_number'];
   $games =$bet['games'];


 

    

   //place a bet
   $num_games = count($games);
   $random = random_int(1000,2000);
   $ticket_number = $cashier_id . $game_code .$random;
   

   foreach($games as $game){
       $info = Game::where('game_code',$game_code)->first();
      
       //insert in to bets and submit numbers for comparism
       $insert = DB::table('bets')->insert([
           'cashier_id'=>$cashier_id,
           'game_code'=> $game_code,
           'phone_number'=>$phone,
           'n1'=>$game['n1'],
           'n2'=>$game['n2'],
           'n3'=>$game['n3'],
           'n4'=>$game['n4'],
           'n5'=>$game['n5'],
           'n6'=>$game['n6'],
           'stake'=>$game['stake'],
           'bet_code'=>$game['n1'].$game['n2'].$game['n3'].$game['n4'].$game['n5'].$game['n6'],
           'ticket_number'=>$ticket_number,
           'min_potential_winning'=> (int)($info->combo2) * (int)$game['stake'], 
           'max_potential_winning'=> (int)($info->combo6) * (int)$game['stake'],
           'draw' =>$info->draw,
           'day' =>$info->day,
           'time' =>$info->time,
           'game_name' =>$info->game_name,
           'combo2' =>(int)($info->combo2) * (int)$game['stake'],
           'combo3' =>(int)$info->combo3 * (int)$game['stake'],
           'combo4' =>(int)$info->combo4 * (int)$game['stake'],
           'combo5' =>(int)$info->combo5 * (int)$game['stake'],
           'combo6' =>(int)$info->combo6 * (int)$game['stake'],


       ]);
     
   }


   //get all related ticket
   $tickets = Bet::where('ticket_number',$ticket_number )->get();
   
   



//send sms to user phone_number that he has played and 
            // $curl = curl_init();
            // $mgs = `congratulation on, placing a bet with CashOn Lotto, your ticket number is $ticket_number `;

            // curl_setopt_array($curl, array(
            // CURLOPT_URL => 'http://bulksmsnigeria.com/api/v2/sms/create?api_token=wTaYDs0A9chYaRFcFyKc9H0Hh8ZHxx7K7sJpnoFKxe6wJkWDZ79QS3cy8uHf&to='.$phone.'&from=CashOn Lotto&body='.$mgs,
            // CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_ENCODING => '',
            // CURLOPT_MAXREDIRS => 10,
            // CURLOPT_TIMEOUT => 0,
            // CURLOPT_FOLLOWLOCATION => true,
            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // CURLOPT_CUSTOMREQUEST => 'POST',
            // CURLOPT_HTTPHEADER => array(
            //     'Content-Type: application/json',
            //     'Accept: application/json'
            // ),
            // ));

            // $response = curl_exec($curl);

            // curl_close($curl);


         //return response($response);



//return response
    
    return response()->json([
          'status'=> 'success',
          'games'=>$tickets
    ],200);
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