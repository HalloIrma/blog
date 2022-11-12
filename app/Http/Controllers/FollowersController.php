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

    public function listRecomendation(){
        $following=DB::table('followers as a')
                   ->select('a.user_id_flwrs')
                   ->where('a.user_id','=',Auth::user()->id);

        $list =DB::table('users as a')
               ->select('a.id','a.firstname','a.lastname',DB::raw('ifnull(a.profession,"None") as profession'), 'a.photo')
               ->where('a.id','<>',Auth::user()->id)
               ->whereNotIn('a.id', $following)
               ->get();

        $recomendation = DB::table('users')
               ->leftJoin('followers','users.id','=','followers.user_id')
               ->select('users.id','users.firstname','users.lastname','users.profession','users.photo')
               ->where('users.id','<>',Auth::user()->id)
               ->whereNotIn('users.id',DB::table('followers')->select('user_id_flwrs')->where('user_id','=',Auth::user()->id))
               ->orWhere(function($query){
                   $query->where('followers.user_id_flwrs','=',Auth::user()->id)
                         ->where('followers.flag_mutual','=','N');
               })
               ->limit(3)
               ->get();

$cnt_following = DB::table('followers')
               ->select(DB::raw('count(user_id_flwrs) as cnt_following'))
               ->where('user_id','=',Auth::user()->id)
               ->orWhere(function($query){
                   $query->where('user_id_flwrs','=',Auth::user()->id)
                         ->where('flag_mutual','=','Y');
               })
               ->get();

$cnt_like = DB::table('likes')
         ->select(DB::raw('count(post_id) as cnt_like'))
         ->where('user_id','=',Auth::user()->id)
         ->get();

$cnt_followers = DB::table('followers')
               ->select(DB::raw('count(user_id) as cnt_followers'))
               ->where('user_id_flwrs','=',Auth::user()->id)
               ->orWhere(function($query){
                   $query->where('user_id','=',Auth::user()->id)
                         ->where('flag_mutual','=','Y');
               })
               ->get();
$cnt_engage = DB::table('followers')
            ->select(DB::raw('count(user_id_flwrs) as cnt_engage'))
            ->where('user_id','=',Auth::user()->id)
            ->where('flag_mutual','=','Y')
            ->orWhere(function($query){
                $query->where('user_id_flwrs','=',Auth::user()->id)
                      ->where('flag_mutual','=','Y');
            })
            ->get();

$cnt_notif = DB::table('notif as a')
            ->join('notif_categories as b','a.notif_cat','=','b.id')
            ->select(DB::raw('count(a.id) as cnt_notif'))
            ->where('a.user_id','=',Auth::user()->id)
            ->where('a.actor_id','<>',Auth::user()->id)
            ->where('a.read_yn','=','N')
            ->get();

$latestnotif = DB::table('notif as a')
            ->join('notif_categories as b','a.notif_cat','=','b.id')
            ->join('users as c','c.id','=','a.actor_id')
            ->leftjoin('posts as d', 'd.id','=','a.post_id')
            ->select('c.firstname', 'c.lastname', 'b.msg_display','a.notif_cat','d.id','a.id as id_notif')
            ->where('a.user_id','=',Auth::user()->id)
            ->where('a.actor_id','<>',Auth::user()->id)
            ->where('a.read_yn','=','N')
            ->limit(3)
            ->get();

        //dd($list);
        return view('recomendation',compact('list','recomendation','cnt_following','cnt_like','cnt_followers','cnt_engage','cnt_notif','latestnotif'));

    }
}
