<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
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


Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    $play = DB::table('games_played')->get(); 

    if(Auth::user()->role == 'agent'){
     
        
        return redirect('agent');
    }
    
    return view('dashboard')->with(['play',$play]);

});






//admin route
//agents
Route::get('create_agent',[AdminController::class,'create_agent']);
Route::post('create_an_agent',[AdminController::class,'create_an_agent']);
Route::get('all_agents',[AdminController::class,'all_agent']);
Route::get('credit_agent',[AdminController::class,'credit_agent']);
Route::post('credit_an_agent',[AdminController::class,'credit_an_agent']);
//terminal
Route::post('create_terminal',[AdminController::class,'create_terminal']);
Route::get('create_a_terminal',[AdminController::class,'create_a_terminal']);
Route::get('all_terminal',[AdminController::class,'all_terminal']);
//debt
Route::get('debt_summary',[AdminController::class,'debt_summary']);

//games route
Route::view('create_game', 'game.create_game');
Route::post('create_game', [AdminController::class,'create_game']);
Route::get('all_games', [AdminController::class,'all_games']);
Route::get('edit_game/{id}', [AdminController::class,'edit_games']);
Route::post('edit_a_game/{id}', [AdminController::class,'edit_a_games']);

























//sms
Route::get('sms', function () {
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://bulksmsnigeria.com/api/v2/sms/create?api_token=wTaYDs0A9chYaRFcFyKc9H0Hh8ZHxx7K7sJpnoFKxe6wJkWDZ79QS3cy8uHf&to=2349028814649&from=BulkSMSNG&body=This+is+a+test+message.',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Accept: application/json'
    ),
    ));

   $response = curl_exec($curl);

   curl_close($curl);


  return response($response);

});



//...................................the game logic....................//
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



//..........................................

/////////agents
     
        
        //agent Route//////////////////////////////////////////////////////////////
        Route::get('agent',function(){
  
            $bets = Bet::orderBy('created_at', 'DESC')->get();
            $cashiers= Cashier::where('agent_id',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            return view('agent.index')->with([
                
                'cashiers'=>$cashiers,
                'bets'=>$bets
                ]);

        });

        Route::get('_all_terminal',function(){
            $cashiers= Cashier::where('agent_id',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            return view('agent.all_terminal')->with([
                
                'cashiers'=>$cashiers
                ]);
        });

        Route::post('_create_terminal', function (Request $request) {
        
            $cashier= DB::table('cashiers')->insert([
                'agent_id'=>$request->input('agent'),
                'cashier_name'=>$request->input('name'),
                'area'=>$request->input('area'),
                'phone'=>$request->input('phone'),
                'cashier_code'=>$request->input('code'),
                'cashier_password'=>$request->input('password'),
             ]);
    
            
            return redirect('_all_terminal');
            
        });


        Route::get('_add_terminal',function(){

            $cashiers= Cashier::where('agent_id',Auth::user()->id)->get();
           // dd($cashiers);
            return view('agent.create_terminal')->with(['cashiers'=>$cashiers]);
        });


        Route::get('_credit',function(){            
            $cashiers= Cashier::where('agent_id',Auth::user()->id)->get();
            return view('agent.credit_terminal')->with(['cashiers'=>$cashiers]);
        });

        Route::post('_credit_a_cashier',function(Request $request){  
            $cashier_id=(int)$request->input('cashier');
            $credit=(int)$request->input('credit');
            
            $cashier = DB::table('cashiers')->where('cashier_id', (int)$request->input('cashier'))->update([
                'cash_allocated'=>$credit,
            ]);
            return redirect('_all_terminal');
        });

        Route::get('_cashier/{id}',function($id){            
            $cashiers= Cashier::where('agent_id',Auth::user()->id)->first();
            $bets = Bet::where('cashier_id', $id)->orderBy('created_at', 'DESC')->get();
            return view('agent.cashier')->with(['cashiers'=>$cashiers, 'bets'=>$bets]);
        });

        Route::get('/summary',function(){              
           $agents = User::where('role', 'agent')->orderBy('created_at', 'DESC')->get();
            return view('admin.summary')->with(['agents'=>$agents ,]);
        });
        Route::get('/_payout',function(){              
            $agents = User::where('role', 'agent')->orderBy('created_at', 'DESC')->get();
           
             return view('agent.payout');
         });
         Route::get('/_payout/{ref}',function($ref){              
                  

             //verify reference
             $curl = curl_init();
             curl_setopt_array($curl, [
                 CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $ref,
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_HTTPHEADER => [
                     "accept: application/json",
                     "authorization: Bearer sk_test_ce706fad7c22bf5f6d7ee9d9ac76db3f19c72af5",
                     "cache-control: no-cache"
                 ],
             ]);
     
             $response = curl_exec($curl);
             $err = curl_error($curl);
     
             // if ($err) {
             //     return back()->with('error', 'Could not communicate with payment gateway, please try again later.');
             // }
     
             $txn = json_decode($response);
     
             if ($txn->status == false) {
                 return dd('transaction reference not correct' );
                // return \response()->json(['status' => false, 'message' => 'Transaction reference not found']);
             }


             return response()->json([
                 'status'=>'success',
                 'ref'=>$txn,
            ],200);
         });



    

Route::get('y', function () {
 $date = Carbon::now()->format('Y-m-d');
 $day = Carbon::parse($date)->format('l');
dd($day);

});




// pick a winer
Route::get('/run_draw', function(){
    //get the winning number
    $winning_number =   DB::table('games_played')->select('number')->groupBy('number')->orderByRaw('COUNT(*) ASC')->limit(6)->get();      
        
    $magic_number= array( $winning_number[0]->number=>$winning_number[0]->number, 
                          $winning_number[1]->number=>$winning_number[1]->number,
                          $winning_number[2]->number=>$winning_number[2]->number,
                          $winning_number[3]->number=>$winning_number[3]->number,
                          $winning_number[4]->number=>$winning_number[4]->number,
                          $winning_number[5]->number=>$winning_number[5]->number,
                        );
    $magic= $winning_number[0]->number. 
            $winning_number[1]->number.
            $winning_number[2]->number.
            $winning_number[3]->number.
            $winning_number[4]->number.
            $winning_number[5]->number;
    //magic number is just winnng numbers in key value pair so that Arr::exists can work and search
 
     //for loop throw all the tickes
      $bets = Bet::all();
     
      foreach($bets as $bet){
          echo $bet->bet_code;
        $result= DB::table('bets')->where('bet_code',$bet->bet_code)->update([
            'result'=>$magic,
            'status'=>'played',
            'result_status'=>'lost',
            'payout'=>'0'


        ]);
       
        //echo $bet->bet_code.'_'.$winning_number[0]->number,$winning_number[1]->number,$winning_number[2]->number, $winning_number[3]->number,$winning_number[4]->number.'||||||||||';
        //compare using arr exist while counting and updating a collumn of combination:
         
 
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
        if($exists = Arr::exists($magic_number, $bet->n6)){  //if the number matches 
           
            $count = $count+1;
            //update the bet ticket status
          
        }
        DB::table('bets')->where('bet_code',$bet->bet_code)->update(['combination'=>$count]);
        //rewarding the player
        if($count == 2){
         $combo2 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo2');
         DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo2,'result_status'=>'won',]);
       ///sms  
        // $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
        ///sms

        }
        if($count == 3){
         $combo3 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo3');
         DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo3, 'result_status'=>'won',]);

          ///sms  
        // $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
        ///sms

        }
        if($count == 4){
         $combo4 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo4');
         DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo4, 'result_status'=>'won',]);

          ///sms  
        // $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
        ///sms

        }
        if($count == 5){
         $combo5 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo5');
         DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo5, 'result_status'=>'won',]);

          ///sms  
        // $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
        ///sms

        }
        if($count == 6){
            $combo6 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo6');
            DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo6, 'result_status'=>'won',]);

             ///sms  
        // $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
        ///sms
        }
 
        
        
        
        
        
        
        
       // dd('Draw Ran');
            
 
      }
      return;
 
 });

