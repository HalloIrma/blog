@extends('layout.master2')

@section('content')

<div class="content" style="background-color:white; padding:10px;">
<section class="content" >
  <div class="container">
    <form action='/post_data' method="post" enctype="multipart/form-data">
      @csrf
    <div class="card">
      <div class="card-body">
              <!-- textarea -->
              <div class="form-group">
                <label>What's on your mind?</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="pesan" id="pesan"></textarea>
                <div class="custom-file">
                    <label for="img_post"></label>
                    <input type="file" id="img_post" name="img_post">
                </div>
              
              </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary float-right" >Post</button>
      </div>
      <!-- /.card-body -->
    </div>
    </form>
    
  </div>
</section>

<section class="content" >
  <div class="timeline" style="backgroud-color:white">
    
    @foreach ($list as $val)
    <!-- timeline time label -->
      <div class="time-label">
        <span class="bg-red">{{substr($val->updated_at,0,10)}}</span>
      </div>
      <!-- /.timeline-label -->
      <!-- timeline item -->
      <div>
        <i class="fa fa-envelope bg-blue"></i>
        <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> {{substr($val->updated_at,10,6)}}</span>
          {{--<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3> --}}
        <h3 class="timeline-header"><a href="#">{{$val->firstname." ".$val->lastname}}</a></h3>
          <div class="timeline-body">
            @if (is_null($val->img)==false)
              <img src="{{asset('/uploads/post_img/'.$val->img.'')}}" alt="" width="80%" height="80%">
              <p>{{$val->post_text}}</p>
            @else
              {{$val->post_text}}
            @endif
            
          </div>
          <div class="timeline-footer">
           
              <div style="float:left;">
                  <form action="/addlike" method="POST" id="myform{{$val->id}}" style="width:100px" >  <!--nama form harus beda-beda, kalo enggak maka value yg diambil bakalan sama terus -->
                    @csrf
                      <input type="hidden" name="user_id_post" id="user_id_post" value="{{$val->id_user_posted}}">
                      <input type="hidden" name="notif_id" id="notif_id" value="1">
                      <input type="hidden" name="menu_id" id="menu_id" value="1">
                      <input type="hidden" name="like" id="like" value="{{$val->id}}"> 
                      @if (is_null($val->isUserLike))
                        <a class="btn btn-primary btn-sm fa fa-thumbs-o-up" style="width:80px" onclick="document.getElementById('myform{{$val->id}}').submit(); return false;"> {{$val->cnt_like}} Like</a>
                      @else
                        <a class="btn btn-primary btn-sm fa fa-solid fa-thumbs-up" style="width:80px" onclick="document.getElementById('myform{{$val->id}}').submit(); return false;"> {{$val->cnt_like}} Like</a>
                      @endif
                  </form>
                </div>
              
              <a class="btn btn-danger btn-sm fa fa-comment" href="/addcomment/{{$val->id}}"> {{$val->cnt_cmt}} Comment</a>
             
          </div>
        </div>
      </div>
      <!-- END timeline item -->
        
    @endforeach

    
    <!-- timeline item -->
    {{-- <div>
      <i class="fas fa-user bg-green"></i>
      <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
      </div>
    </div>
    <!-- END timeline item -->
    <!-- timeline item -->
    <div>
      <i class="fas fa-comments bg-yellow"></i>
      <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
        <div class="timeline-body">
          Take me to your leader!
          Switzerland is small and neutral!
          We are more like Germany, ambitious and misunderstood!
        </div>
        <div class="timeline-footer">
          <a class="btn btn-warning btn-sm">View comment</a>
        </div>
      </div>
    </div>
    <!-- END timeline item -->
    <!-- timeline time label -->
    <div class="time-label">
      <span class="bg-green">3 Jan. 2014</span>
    </div>
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <div>
      <i class="fa fa-camera bg-purple"></i>
      <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
        <div class="timeline-body">
          <img src="https://placehold.it/150x100" alt="...">
          <img src="https://placehold.it/150x100" alt="...">
          <img src="https://placehold.it/150x100" alt="...">
          <img src="https://placehold.it/150x100" alt="...">
          <img src="https://placehold.it/150x100" alt="...">
        </div>
      </div>
    </div>
    <!-- END timeline item -->
    <!-- timeline item -->
    <div>
      <i class="fas fa-video bg-maroon"></i>

      <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>

        <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

        <div class="timeline-body">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen=""></iframe>
          </div>
        </div>
        <div class="timeline-footer">
          <a href="#" class="btn btn-sm bg-maroon">See comments</a>
        </div>
      </div>
    </div>--}}
    <!-- END timeline item -->
    <div>
      <i class="fa fa-clock-o bg-gray"></i>
    </div> 
  </div>
</section>
</div>

<!-- Main content -->
{{-- <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Title</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            Start creating your amazing application!
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Footer
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section> --}}
<!-- /.content -->

{{-- <section class="content">
    
</section> --}}
        

@endsection