<?php
/* 
namespace App\Http\Controllers\Auth; */
namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;


class LikesController extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');
    } 
 
    public function addlikes(Request $request){
        
        //dd($request->all());
          if(DB::table('likes')
                ->where('post_id', '=', $request["like"])
                ->where('user_id','=',Auth::user()->id)
                ->exists())
                {
                    DB::table('likes')
                                ->where('post_id', '=', $request["like"])
                                ->where('user_id','=',Auth::user()->id)
                                ->delete();
                }
                else {
                    DB::table('likes')->insert([
                        'post_id' =>  $request["like"],
                        'user_id' => Auth::user()->id,
                        'likes_date' => date("Y-m-d"),
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                }

          if (DB::table('notif')
                ->where('user_id','=',$request['user_id_post'])
                ->where('post_id','=',$request["like"])
                ->where('notif_cat','=',$request["notif_id"])
                ->where('actor_id','=',Auth::user()->id)
                ->exists()) 
                {
                   DB::table('notif')
                        ->where('user_id','=',$request['user_id_post'])
                        ->where('post_id','=',$request["like"])
                        ->where('notif_cat','=',$request["notif_id"])
                        ->where('actor_id','=',Auth::user()->id)
                        ->delete();
                } else {
                    DB::table('notif') ->insert([
                        'user_id' => $request['user_id_post'],
                        'post_id' => $request["like"],
                        'notif_cat' => $request["notif_id"],
                        'actor_id' => Auth::user()->id,
                        'created_at' => date("Y-m-d H:i:s")

                    ]);
                }
          
       
        if ($request["menu_id"] == "1") {
            return redirect("/home");
        } elseif ($request["menu_id"] == "2") {
           return redirect("/addcomment/".$request["like"]);
        }  
        
    }
}
