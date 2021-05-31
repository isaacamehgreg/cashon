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
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/least', function () {

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
   
       return response()->json($least,200);
       

});


Route::get('try', function () {
    $curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/353507637",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    	// Set Here Your Requesred Headers
        'Content-Type: application/json',
        'Authorization:sk_live_ebe67cd1fe90829a6b0de4371fa41a658e4dc03c',
    ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
    dd($err);
} else {
    print_r(json_decode($response));
    dd($response);
}
});