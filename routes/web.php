<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Models\Bet;
use App\Models\GamesPicked;
use App\Models\Multiplier;
use App\Models\User;
use App\Models\Cashier;
use App\Models\Game;
use App\Models\Raffle;
use Carbon\Carbon as CarbonCarbon;
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
    
    return redirect('login');

});



Route::get('/dashboard', function () {

    
        if(DB::table('rakes')->get()->count() == 0){
        DB::table('rakes')->insert([
            "percentage_raked"=>60,
            "total_raked"=>0,
        ]);
        }
    
        if(DB::table('pools')->get()->count() == 0){
            DB::table('pools')->insert([
                "percentage_pool"=> 40,
                "total_pool"=>0,          
        
            ]);
        }

        if(DB::table('raffles')->get()->count() == 0){
            DB::table('raffles')->insert([
                "percentage"=> 10,
            ]);
        }



    if(Auth::guest()){
        return redirect('login');
    }

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
//admin
Route::view('add_admin','admin.create_admin');
Route::post('create_an_admin',[AdminController::class,'create_an_admin']);
Route::get('all_admin',function(){
    return view('admin.all_admin')->with(['admins'=>User::where('role','admin')->get()]);
});
//games route
Route::view('create_game', 'game.create_game');
Route::view('rake_pool', 'admin.rake_pool');
Route::post('_rake_pool', [AdminController::class,'_rake_pool']);
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
            if(Auth::guest()){
             return redirect('login');
            }
            // $agent = Auth::user()->id;
            // foreach( Cashier::where('agent_id',$agent)->get()){
            //     foreach(Bet::){

            //     }
            // }
            $bets = Bet::orderBy('created_at', 'DESC')->get();
            $cashiers= Cashier::where('agent_id',Auth::user()->id)->orderBy('created_at', 'DESC')->get();
            return view('agent.index')->with([
                
                'cashiers'=>$cashiers,
                'bets'=>$bets
                ]);

        });

        Route::get('_all_terminal',function(){
            $cashiers= Cashier::orderBy('created_at', 'DESC')->get();
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
      $bets = Bet::where('status','pending')->get();
     
      foreach($bets as $bet){
       //   echo $bet->bet_code;
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
                $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
                ///sms

        }
        if($count == 3){
         $combo3 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo3');
         DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo3, 'result_status'=>'won',]);

            ///sms  
            $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
            ///sms

        }
        if($count == 4){
         $combo4 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo4');
         DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo4, 'result_status'=>'won',]);

            ///sms  
            $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
            ///sms

        }
        if($count == 5){
         $combo5 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo5');
         DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo5, 'result_status'=>'won',]);

            ///sms  
            $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
            ///sms

        }
        if($count == 6){
            $combo6 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo6');
            DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo6, 'result_status'=>'won',]);

                ///sms  
            $mgs = "Congratulation%20you%20just%20won%20N".$bet->payout."%20from%20CashOn%20Lotto%20this%20is%20your%20ticket%20number%20for%20your%20payouts%20".$bet->ticket_number ;
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$bet->phone."&body=".(string)$mgs.'&dnd=2',
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
            ///sms
        }
      
   
     }

 
  

    return redirect('/dashboard');
 
 });


 Route::get('run_raffle', function (){

    foreach (DB::table('cashiers')->get() as $_cashier) {
        $played_bets = DB::table('bets')->where('cashier_id',$_cashier->cashier_id)->where('is_raffled', null)->get();
     if(count($played_bets) != 0 ){
        $n = count($played_bets) - 1; 
        $random = random_int(0,$n);
        $raffle_winner = $played_bets[$random];

        //get total amount us to play the game
        $total_amount = 0;
        foreach($played_bets as $b){
           $total_amount = $total_amount + $b->stake;
        }
        $r_percentage = Raffle::find(1);
        $raf_win = $total_amount * ($r_percentage->percentage/100);

        //give 5% of the amount played in on that terminal
           
        
        //the winner

        $_reward = DB::table('bets')->where('id',$raffle_winner->id)->update(['is_win_raffle'=> $raf_win]);  
        $_phone = DB::table('bets')->where('id',$raffle_winner->id)->value('phone_number');  
          
        
        //sms user to come and get his winning
                 ///sms  
            $mgs = "Congratulation%20you%20just%20won%20N".$raf_win."%20from%20CashOn%20Lotto%20Raffle,%20kindly%20visit%20the%20branch%20you%20played%20to%20get%20your%20reward";
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://www.bulksmsnigeria.com/api/v2/sms/create?api_token=PlliAR9ioFYzhYKYWlkXQXbeIHFBQaN61B7Sbrx0ypLDMFxRtHShBWrismz8&from=CASHON_LOTTO&to=".(string)$_phone."&body=".(string)$mgs.'&dnd=2',
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
            ///sms
        
        //mark games as played
        foreach($played_bets as $b){
            $_mark = DB::table('bets')->where('id',$b->id)->update(['is_raffled'=> true]); 
        }
     }
                
    }

    return redirect('/dashboard');


 });

 Route::get('test', function () {
         return view('test');
   });

  Route::get('getchart', function () {
    $win = Bet::where('result_status','won')->count();
    $lost = Bet::where('result_status','lost')->count();
    
    return response()->json(['win' =>$win,'lost' =>$lost],200);
  });