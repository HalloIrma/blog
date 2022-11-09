<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function doFollow(Request $data){

        if(DB::table('followers')
                ->where('user_id', '=', Auth::user()->id)
                ->where('user_id_flwrs','=',$data["id_follow"])
                ->exists())
                {
                    if (DB::table('followers')
                    ->where('user_id', '=', Auth::user()->id)
                    ->where('user_id_flwrs','=',$data["id_follow"])
                    ->where('flag_mutual','=','N')
                    ->exists()) {
                        $affected = DB::table('followers')
                                    ->where('user_id', '=', Auth::user()->id)
                                    ->where('user_id_flwrs','=',$data["id_follow"])
                                    ->where('flag_mutual','=','N')
                                    ->update(['flag_mutual' => 'Y']);
                    } else {
                        $affected = DB::table('followers')
                                    ->where('user_id', '=', Auth::user()->id)
                                    ->where('user_id_flwrs','=',$data["id_follow"])
                                    ->where('flag_mutual','=','Y')
                                    ->update(['flag_mutual' => 'N']);
                    }
                    
                }elseif(DB::table('followers')
                ->where('user_id', '=', $data["id_follow"])
                ->where('user_id_flwrs','=',Auth::user()->id)
                ->exists())
                {
                    if (DB::table('followers')
                    ->where('user_id', '=', $data["id_follow"])
                    ->where('user_id_flwrs','=',Auth::user()->id)
                    ->where('flag_mutual','=','N')
                    ->exists()) 
                    {
                        $affected = DB::table('followers')
                                    ->where('user_id', '=', $data["id_follow"])
                                    ->where('user_id_flwrs','=', Auth::user()->id)
                                    ->where('flag_mutual','=','N')
                                    ->update(['flag_mutual' => 'Y']);
                    } else {
                        $affected = DB::table('followers')
                                    ->where('user_id', '=', $data["id_follow"])
                                    ->where('user_id_flwrs','=',Auth::user()->id)
                                    ->where('flag_mutual','=','Y')
                                    ->update(['flag_mutual' => 'N']);
                    }
                }
                else{
                    DB::table('followers')->insert([
                        'user_id_flwrs' =>  $data["id_follow"],
                        'user_id' => Auth::user()->id,
                        'flag_mutual' => 'N'
                    ]);
                }
    return redirect('/home');
                
}
}
