<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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


class AutoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //check if game time is equal to current time

        //update all games winnings or loss

        //sms alert to all winners

        \Log::info("Cron is working fine!   started");

        
       // return 0;
//.........................................................when to act
       $today = Carbon::now()->format('Y-m-d');
       $day = Carbon::parse($today)->format('l');//thursdays

       $hour = Carbon::now()->format('H');
       (int)$hour+ 4; // current hour
       $current_hour = (int)$hour+ 4;
//.........................................................

//get result winning ticket





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

        
     //.....do this for every bet......
     
  if($bet->day == $day && $bet->time == $current_hour){


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

      //rewarding the player
      if($count == 2){
       $combo2 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo2');
       DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo2]);
       
        //send sms to user phone_number that he has played and 
        $curl = curl_init();
        $mgs = `congratulation!!!%20you%20won%20CashOn%20Lotto,%20your%20ticket%20number%20is%20$bet->ticket_number `;

        // curl_setopt_array($curl, array(
        // CURLOPT_URL => 'http://bulksmsnigeria.com/api/v2/sms/create?api_token=wTaYDs0A9chYaRFcFyKc9H0Hh8ZHxx7K7sJpnoFKxe6wJkWDZ79QS3cy8uHf&to='.$bet->phone_number.'&from=CashOn Lotto&body='.$mgs,
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
        //................end send sms....................


      }
      if($count == 3){
       $combo3 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo3');
       DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo3]);
      }
      if($count == 4){
       $combo4 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo4');
       DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo4]);
      }
      if($count == 5){
       $combo5 = DB::table('bets')->where('bet_code',$bet->bet_code)->value('combo5');
       DB::table('bets')->where('bet_code',$bet->bet_code)->update(['payout'=>$combo5]);
      }

      echo 'done';

     //........it ok 

   }

      
      //compare if n1 wins if n2 wings

      \Log::info("Cron is working fine!  finished");








    }









    
      
//..............................................................................................

       $bets = DB::table('bets')->get();
       foreach($bets as $bet){
           if($bet->day == $day   &&  $bet->time == $current_hour){
            
            

           }
             
       }
    }
}
