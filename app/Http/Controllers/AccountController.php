<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Alert;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
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


return view('account', compact('recomendation','cnt_following','cnt_like','cnt_followers','cnt_engage','cnt_notif','latestnotif'));
    }

    public function doUpdate(Request $data){
       // dd($data->all());

        $data->validate([
            'img' => 'mimes:jpeg,jpg,png|max:2200'
        ]); 
        
            $gambar=$data['img'];
            $new_gambar = time().'-'.$gambar->getClientOriginalName();
            $affected = DB::table('users')
                        ->where('id',Auth::user()->id)
                        ->update(['firstname' => $data["fname"],
                                  'lastname'  => $data["lname"],
                                  'email'     => $data["email"],
                                  'username'  => $data["username"],
                                  'birthdate' => $data["birthdate"],
                                  'profession'=> $data["profession"],
                                  'interest'  => $data["interest"],
                                  'motto'     => $data["motto"],
                                  'photo'     => $new_gambar
                        ]);

            if (is_null($gambar) == false) {
                $gambar->move('uploads/photo_profile/',$new_gambar);
            }

            //dd($affected);
            if ($affected>0) {
               Alert::success('Congrats', 'Data berhasil diperbaharui!');
               return redirect('/home');
            }  
        

    }
}
