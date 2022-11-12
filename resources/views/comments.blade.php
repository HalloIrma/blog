@extends('layout.master2')

@section('content')
<div class="content" style="background-color:white; padding:10px;">
    <section class="content" >
       <div class="container">
        <div class="card card-widget">
                <div class="card-header">
                  <div class="user-block">
                    @if (is_null($list[0]->photo))
                     <img class="img-circle" src="{{asset('/template/dist/img/avatar.png')}}" alt="User Image">
                    @else
                      <img class="img-circle" src="{{asset('/uploads/photo_profile/'.$list[0]->photo.'')}}" alt="User Image">
                    @endif
                    
                    <span class="username"><a href="#">{{$list[0]->firstname." ".$list[0]->lastname}}</a></span>
                    @if (is_null($list[0]->updated_at) == "false")
                      <span class="description">{{substr($list[0]->updated_at,0,10)}}</span>
                    @else
                      <span class="description">{{substr($list[0]->created_at,0,10)}}</span>
                    @endif
                    
                  </div>
                  <!-- /.user-block -->
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" title="Mark as read">
                      <i class="fa fa-circle"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fa fa-times"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                        <!-- /.card-header -->
                <div class="card-body">
                  @if (is_null($list[0]->img)==false)
                  <img class="img-fluid pad" src="{{asset('/uploads/post_img/'.$list[0]->img.'')}}" alt="Photo">
                  <p>{{$list[0]->post_text}}</p>
                  @else
                  <p>{{$list[0]->post_text}}</p>
                  @endif
                  
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i> Share</button>
                  <form action="/addlike" method="post" style="float:left;">
                  @csrf
                    <input type="hidden" name="user_id_post" id="user_id_post" value="{{$list[0]->id_user_posted}}">
                    <input type="hidden" name="notif_id" id="notif_id" value="1">
                    <input type="hidden" name="menu_id" id="menu_id" value="2">
                    <input type="hidden" name="like" id="like" value="{{$list[0]->id}}">
                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-thumbs-up"></i> Like</button>
                  </form>
                  <span class="float-right text-muted">{{$list[0]->cnt_like}} Likes</span>
                </div>
                        <!-- /.card-body -->
                <div class="card-footer card-comments">

                    @if ($list[0]->cnt_cmt>0)
                      @foreach ($list as $val)
                      <div class="card-comment">
                          <!-- User image -->
                          @if (is_null($val->cmt_photo))
                          <img class="img-circle img-sm" src="{{asset('/template/dist/img/avatar.png')}}" alt="User Image">
                          @else
                          <img class="img-circle img-sm" src="{{asset('/uploads/photo_profile/'.$val->cmt_photo.'')}}" alt="User Image">
                          @endif
                         
                
                          <div class="comment-text">
                            <span class="username">
                              {{$val->cmt_first." ".$val->cmt_last}}

                              @if (is_null($val->upd_date)=="false")
                                <span class="text-muted float-right">{{substr($val->upd_date,0,10)}}</span>
                              @else
                                <span class="text-muted float-right">{{substr($val->comment_date,0,10)}}</span>
                              @endif
                              

                            </span><!-- /.username -->
                            {{$val->comment}}
                          </div>
                          <!-- /.comment-text -->
                        </div>
                      @endforeach
                      <div class="card-footer">
                          <form action="/postcomment" method="post">
                            @csrf
                            @if (is_null(Auth::user()->photo))
                            <img class="img-fluid img-circle img-sm" src="{{asset('/template/dist/img/avatar.png')}}" alt="Alt Text">
                            @else
                            <img class="img-fluid img-circle img-sm" src="{{asset('/uploads/photo_profile/'.Auth::user()->photo.'')}}" alt="Alt Text">
                            @endif
                            
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            
                            <div class="img-push">
                              <input type="text" name="txt_cmt" id="txt_cmt" class="form-control form-control-sm" placeholder="Press enter to post comment">
                            </div>
                            <input type="hidden" name="post_id" id="post_id" value="{{$list[0]->id}}">
                            <input type="hidden" name="user_id_post" id="user_id_post" value="{{$list[0]->id_user_posted}}">
                            <input type="hidden" name="notif_id" id="notif_id" value="2">
                          </form>
                        </div>
                                <!-- /.card-footer -->
                    @else
                      <div class="card-footer">
                          <form action="/postcomment" method="post">
                            @csrf
                            @if (is_null(Auth::user()->photo))
                            <img class="img-fluid img-circle img-sm" src="{{asset('/template/dist/img/avatar.png')}}" alt="Alt Text">
                            @else
                            <img class="img-fluid img-circle img-sm" src="{{asset('/uploads/photo_profile/'.Auth::user()->photo.'')}}" alt="Alt Text">
                            @endif
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            
                            <div class="img-push">
                              <input type="text" name="txt_cmt" id="txt_cmt" class="form-control form-control-sm" placeholder="Press enter to post comment">
                            </div>
                            <input type="hidden" name="post_id" id="post_id" value="{{$list[0]->id}}">
                            <input type="hidden" name="user_id_post" id="user_id_post" value="{{$list[0]->id_user_posted}}">
                            <input type="hidden" name="notif_id" id="notif_id" value="2">
                            
                          </form>
                        </div>
                              <!-- /.card-footer -->
                    @endif

                </div>
                        <!-- /.card-footer -->
                
        </div>
       </div>
    </section>
</div>
@endsection