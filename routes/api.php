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
use Carbon\Carbon as CarbonCarbon;

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

       ] ,200);
    }else{
        return response()->json([
            'status'=>'failed',
            'msg'=>'cashier not found',
        ], 404);
    }
    return 'you did not enter anything';
});

Route::get('games', function () {
    
      return response()->json([
          'status'=>'success',
          'games'=>Game::all(),
      ],200);
    
});

Route::post('bet/{cashier_id}', function(Request $request, $cashier_id){

    
   //validate cashier
   $cashier=Cashier::where('cashier_id',$cashier_id)->first();
   if($cashier == null){
    return response()->json(['status'=>'failed', 'msg'=>'user not found'],404);
   }   

   //fetch form data
    $bet = $request->all();

  // get all the values
   $game_code = $bet['game_code'];
   $phone = $bet['phone_number'];
   $games =$bet['games'];
   $numbers =$bet['all_numbers'];



 

    

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
           'bet_code'=>$game['n1'].$game['n2'].$game['n3'].$game['n4'].$game['n5'].$game['n6'].'_'.random_int(50000,80000),
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
           'created_at'=>Carbon::now(),
           'result_status'=>'pending'


       ]);
       $agent_id = DB::table('cashiers')->where('cashier_id', $cashier_id)->value('agent_id');  
       //raked and pool and commision
       //agent commision
       $total_commision = DB::table('users')->where('id', $agent_id)->value('total_commision');
       $percentage_commision = DB::table('users')->where('id', $agent_id)->value('percentage_commision');

       if($total_commision == null){
          $total_commision = 0;
       }   
       
       $percentage_commision = $percentage_commision /  100;
       $t = $percentage_commision * (int)$game['stake'];
      
       $new = $total_commision + $t;
      
       $update = DB::table('users')->where('id', $agent_id)->update(['total_commision'=>$new]);
       
       //admin raked
       //whats left 
       $remaining = (int)$game['stake'] - $t;
       //
       
      //raked
       $total_rake = DB::table('rakes')->where('id', 1)->value('total_raked');

       $percentage_rake = DB::table('rakes')->where('id', 1)->value('percentage_raked');
       
       if($total_rake == null){
          $total_rake = 0;
       }
       $percentage_rake = $percentage_rake /  100;
       $r = $percentage_rake * $remaining;
       $newr = $total_rake + $r;
       $updater = DB::table('rakes')->where('id', 1)->update(['total_raked'=>$newr]);
    
       // put amount in pool 
      $pool = $remaining - $r;
      $total_pool = DB::table('pools')->where('id', 1)->value('total_pool');
      $newpool = $pool + $total_pool;
      $updatepool =  DB::table('pools')->where('id', 1)->update(['total_pool'=>$newpool]);
      



     
    }

    foreach($numbers as $number){
        $insert = DB::table('games_played')->insert([
            'number'=>$number['n'],
            'created_at'=>Carbon::now()
        ]);
    }


   //get all related ticket
$tickets = Bet::where('ticket_number',$ticket_number )->get();
   

// $mgs = "congratulation%20on,%20placing%20a%20bet%20with%20CashOn%20Lotto,%20your%20ticket%20number%20is%20".$ticket_number ;
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$phone."&body=".(string)$mgs.'&dnd=2',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/json',
//     'Accept: application/json'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);





    
    return response()->json([
          'status'=> 'success',
          'games'=>$tickets,
        //   'sms'=>$response,
    ],200);


});


Route::get('bet/{cashier_id}' , function($cashier_id){
    $bets = Bet::where('cashier_id', $cashier_id)->orderBy('created_at', 'DESC')->get();
    if(count($bets) == 0){
        return response()->json([
            "mybets"=> "you dont have any bet"
          ],404);  
    }
    return response()->json([
      "mybets"=> $bets
    ],200);
});

Route::get('bet/find/{cashier_id}/{ticket_number}' , function($cashier_id , $ticket_number){
    $bets = Bet::where('cashier_id', $cashier_id)->where('ticket_number',$ticket_number)->orderBy('created_at', 'DESC')->get();
    if(count($bets) == 0){
        return response()->json([
            "mybets"=> "no bet found! probably wrong ticket number"
        ], 404);  
    }
    if($bets->result_status)
    return response()->json([
      "mybets"=> $bets
    ],200);
});

Route::get('bet/find_phone/{cashier_id}/{phone_number}' , function($cashier_id , $phone_number){
    $bets = Bet::where('cashier_id', $cashier_id)->where('phone_number',$phone_number)->orderBy('created_at', 'DESC')->get();
    if(count($bets) == 0){
        return response()->json([
            "mybets"=> "no bet found! probably wrong phone number"
        ], 404);  
    }
    return response()->json([
      "mybets"=> $bets
    ],200);
});

Route::post('bet/paid/{cashier_id}/{ticket_number}', function($cashier_id,$ticket_number){
    $check= Bet::where('ticket_number', $ticket_number)->where('cashier_id', $cashier_id)->get();
    if(count($check) == 0){
        return response()->json([
        'status'=>'failed',
        'msg' =>'no ticket found'
        ]);
    }
    $mark_as_paid = Bet::where('ticket_number', $ticket_number)->where('cashier_id', $cashier_id)->update([
        'status'=>'paid',
        'updated_at'=>Carbon::now(),
    ]);

     return response()->json([
        'status'=>'success',
       'msg'=> 'ticket is marked as paid',
     ],200);
});


//Raffle
Route::get('raffle/{cashier id}', function(){
      
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