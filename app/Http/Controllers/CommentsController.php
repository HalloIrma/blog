<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;


class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function addcomments($id){
        //dd($id);
        $likecount = DB::table('likes')
                     ->leftJOin('posts','posts.id','=','likes.post_id')
                     ->select('likes.post_id', DB::raw('count(likes.user_id) as cnt_like'))
                     ->where('likes.post_id','=',$id)
                     ->groupBy('likes.post_id');
    
        $cmtcount = DB::table('comments')
                    ->leftJoin('posts','posts.id','=','comments.post_id')
                    ->select('comments.post_id',DB::raw('count(comments.id) as cnt_cmt'))
                    ->where('comments.post_id','=',$id)
                    ->groupBy('comments.post_id');

        $list = DB::table('posts')//Post::all()->sortBy('updated_at');
                ->join('users','users.id','=','posts.user_id')
                ->leftJoin('comments','posts.id','=','comments.post_id')
                ->leftJoin('users as u','u.id','=','comments.user_id')
                ->leftJoinSub($likecount,'likes',function($join){
                    $join->on('posts.id','=','likes.post_id');
                })
                ->leftJoinSub($cmtcount,'cmt',function($join){
                    $join->on('posts.id','=','cmt.post_id');
                })
                ->select('posts.id','posts.post_text','posts.created_at', 'posts.updated_at', 'posts.user_id','likes.cnt_like',
                        'comments.comment','comments.comment_date','comments.upd_date','users.firstname','users.lastname', 'users.id as id_user_posted','u.firstname as cmt_first', 
                        'u.lastname as cmt_last', 'u.photo as cmt_photo','cmt.cnt_cmt','posts.img','users.photo')
                ->where('posts.id','=',$id)
                ->get();

$recomendation = DB::table('users')
                ->leftJoin('followers','users.id','=','followers.user_id')
                ->select('users.id','users.firstname','users.lastname','users.profession','users.photo')
                ->where('users.id','<>',Auth::user()->id)
                ->whereNotIn('users.id',DB::table('followers')->select('user_id_flwrs')->where('user_id','=',Auth::user()->id))
                ->where(function($query){
                    $query->whereNull('followers.user_id')
                          ->orWhere('followers.flag_mutual','=','N');
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
              ->where('a.read_yn','=','N')
              ->get();

$latestnotif = DB::table('notif as a')
              ->join('notif_categories as b','a.notif_cat','=','b.id')
              ->join('users as c','c.id','=','a.actor_id')
              ->leftjoin('posts as d', 'd.id','=','a.post_id')
              ->select('c.firstname', 'c.lastname', 'b.msg_display','a.notif_cat','d.id','a.id as id_notif')
              ->where('a.user_id','=',Auth::user()->id)
              ->where('a.read_yn','=','N')
              ->limit(3)
              ->get();



        //dd($list);
        //dd($list[0]->firstname);
       return view('comments',compact('list','cnt_following','cnt_like','cnt_followers','cnt_engage','cnt_notif','latestnotif','recomendation'));
    }

    public function doComments(Request $data){
        DB::table('comments')->insert([
            'post_id' =>  $data["post_id"],
            'user_id' => Auth::user()->id,
            'comment' => $data["txt_cmt"],
            'comment_date' => date("Y-m-d H:i:s"),
            'upd_date' => ""
        ]);

        

        if (DB::table('notif')
                ->where('user_id','=',$data['user_id_post'])
                ->where('post_id','=',$data["post_id"])
                ->where('notif_cat','=',$data["notif_id"])
                ->where('actor_id','=',Auth::user()->id)
                ->exists()) 
                {
                   DB::table('notif')
                        ->where('user_id','=',$data['user_id_post'])
                        ->where('post_id','=',$data["post_id"])
                        ->where('notif_cat','=',$data["notif_id"])
                        ->where('actor_id','=',Auth::user()->id)
                        ->delete();
                } else {
                    DB::table('notif') ->insert([
                        'user_id' => $data['user_id_post'],
                        'post_id' => $data["post_id"],
                        'notif_cat' => $data["notif_id"],
                        'actor_id' => Auth::user()->id,
                        'created_at' => date("Y-m-d H:i:s")

                    ]);
                }

        return redirect('/addcomment/'. $data["post_id"].''); 

    }
}
