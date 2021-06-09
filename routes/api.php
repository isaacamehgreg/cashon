<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TerminalController;
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

// Route::post('/login',[AuthController::class, 'login']);


//protected route
// Route::group(['middleware'=>['auth:sanctum']] , function () {
//     Route::post('/_logout',[AuthController::class, '_logout']);
//     Route::post('/place_bet',[TerminalController::class, 'place_bet']);
// });



//cashier 

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