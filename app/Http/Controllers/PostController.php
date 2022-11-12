<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PostController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $isLiked = DB::table('likes')
                  ->select('post_id',DB::raw('IFNULL(count(user_id),0) as isUserLike'))
                  ->where('user_id','=',Auth::user()->id)  //untuk mengetahui Post_id mana saja yang di like oleh user yg sedang login
                  ->groupBy('post_id');


        $cntLike = DB::table('likes')
                  ->select('post_id', DB::raw('count(id) as cnt_like'))  //hitung banyaknya likes
                  ->groupBy('post_id');

        $cntCmnt = DB::table('comments')
                  ->select('post_id', DB::raw('count(id) as cnt_cmt'))  //hitung banyaknya likes
                  ->groupBy('post_id');

        $listfollowing=DB::table('followers as z')
                  ->select('z.user_id_flwrs as user_id')
                  ->where('z.user_id','=',Auth::user()->id);

        $listfirts=DB::table('followers as x')
                    ->select('x.user_id')
                    ->where('x.user_id_flwrs','=',Auth::user()->id)
                    ->where('x.flag_mutual','=', '\'Y\'')
                    ->union($listfollowing);

        
                      

        $list = DB::table('posts')//Post::all()->sortBy('updated_at');
                ->join('users','users.id','=','posts.user_id')
                ->leftJoinsub($cntLike,'b',function($join){
                    $join->on('posts.id','=','b.post_id');
                })
                ->leftJoinSub($cntCmnt,'c',function($join){
                    $join->on('posts.id','=','c.post_id');
                })
                //->leftJoin('likes','posts.id','=','likes.post_id')
                //->leftJoin('comments','posts.id','=','comments.post_id')
                ->leftJoinSub($isLiked,'isLiked',function($join){
                    $join->on('posts.id','=','isLiked.post_id');
                })
                
                ->select('posts.id','posts.post_text','posts.img','posts.created_at', 'posts.updated_at', 'posts.user_id','isLiked.isUserLike',
                 'b.cnt_like', 'c.cnt_cmt', 'users.firstname','users.lastname','users.id as id_user_posted')
                //->whereIn('posts.user_id',$listfollowing)
                //->whereIn('posts.user_id',$listfirts)
                ->orderBy('posts.created_at','desc')
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

        //dd($cnt_following);
        return view('dashboard',compact('list','recomendation','cnt_following','cnt_like','cnt_followers','cnt_engage','cnt_notif','latestnotif'));
    }

    public function store_data(Request $request){
        //dd($request->all());
        $request->validate([
            'pesan' => 'required',
            'img_post' => 'mimes:jpeg,jpg,png'
        ]);
        
        if (is_null($request['img_post']) == false) {
            $gambar=$request['img_post'];
            $new_gambar = time().'-'.$gambar->getClientOriginalName();
        }
        

        $post = new Post;
        $post->post_text=$request['pesan'];
        $post->user_id=Auth::user()->id;
        if (is_null($request['img_post']) == false) {
            $post->img=$new_gambar;
        }
        $post->save();  //insert into posts

        if (is_null($request['img_post']) == false) {
            $gambar->move('uploads/post_img/',$new_gambar);
        }

        return redirect('/home')->with('success','Berhasil diposting!'); 
    }

    public function updateNotif(Request $request){
        
        //return response()->json(['success'=>'Got Simple Ajax Request.']);

       $affected=DB::table('notif')
                  ->where('id','=',$request->id_notif)
                  ->update(['read_yn'=>'Y',
                             'updated_at' => date("Y-m-d H:i:s")
                        ]);
      if ($affected>0) {
        return response()->json(['success'=>'update success']);
      }
      
    }

    public function listNotif(){

        $list = DB::table('notif as a')
               ->join('notif_categories as b','a.notif_cat','=','b.id')
               ->join('posts as c','c.id','=','a.post_id')
               ->join('users as d', 'd.id','=','a.actor_id')
               ->select('a.id as id_notif','a.post_id','b.msg_display','d.firstname','d.lastname','a.notif_cat','a.read_yn',
                         'a.important_flag','a.created_at','d.photo')
               ->where('a.user_id','=',Auth::user()->id)
               ->where('a.actor_id','<>',Auth::user()->id)
               ->orderBy('a.id','desc')
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

        return view('notif',compact('list','cnt_following','cnt_like','cnt_followers','cnt_engage','cnt_notif','latestnotif','recomendation'));
        
    }
}
