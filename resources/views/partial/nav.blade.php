<nav class="navbar navbar-expand-md navbar-dark navbar-black">
    <div class="container">
      
      <!-- Right navbar links -->
      @guest
      
      @else
      <a href="/home" class="navbar-brand"><b>Connected</b></a>
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-comments"></i>
            <span class="badge badge-danger navbar-badge">
              0
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('/template/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="fa fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('/template/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('/template/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li> --}}
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell"></i>
            <span class="badge badge-warning navbar-badge">
              @if (count($cnt_notif)>0)
              {{$cnt_notif[0]->cnt_notif}}
              @else
                
              @endif
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">
                @if (count($cnt_notif)>0)
                {{$cnt_notif[0]->cnt_notif}} Notifications
                @else
                  0 Notifications
                @endif
            </span>
            @if (count($cnt_notif)>0)
            @foreach ($latestnotif as $item)
              <div class="dropdown-divider"></div>
              <form action="" method="post" id="notif_form{{$item->id}}">
                @csrf
                <input type="hidden"  id="id_post_notif{{$item->id}}" value="{{$item->id}}">
                <input type="hidden"  id="id_notif{{$item->id}}" value="{{$item->id_notif}}">
                <a href="" class="dropdown-item notif" id="{{$item->id}}">
                @if ($item->notif_cat == "1")
                  <i class="fa fa-thumbs-up mr-2"></i> {{$item->firstname." ".$item->msg_display}}
                @elseif($item->notif_cat == "2")
                  <i class="fa fa-comments mr-2"></i> {{$item->firstname." ".$item->msg_display}}
                @elseif(($item->notif_cat == "3") || ($item->notif_cat == "4"))
                  <i class="fa fa-birthday-cake mr-2"></i> {{$item->firstname." ".$item->msg_display}}
                @endif
                </a>
              </form>
            
                
                
                {{-- <span class="float-right text-muted text-sm">3 mins</span> --}}
              
            @endforeach
           
            @endif
            {{-- <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a> --}}
            <div class="dropdown-divider"></div>
            <a href="/notiflist" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('logout') }}" role="button"  onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
      @endguest
      
    </div>
</nav>

@push('notifupdate')
<script type="text/javascript">


  $(".notif").click(function(event){
    event.preventDefault();
    let post_id = $(this).attr("id");
    let id_post_notif = $("#id_post_notif"+post_id).val();
    let id_notif = $("#id_notif"+post_id).val();

   $.ajax({
                url:"/updatenotif",
                type:"POST",
                data:{
                  _token : '<?php echo csrf_token() ?>',
                  id_post_notif : id_post_notif,
                  id_notif : id_notif
                },
                success: function (response) {
                        console.log(response);
                        if(response) {
                          window.location.href = "/addcomment/"+id_post_notif;
                          //alert(response.success);
                          //$('.success').text(response.success);
                        }
                        },
                error:function (xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(error);
                  console.log(error);
                }
              });

    
  });

  /* function notifupdate($post_id,$notif_id){
    
      // alert($post_id+' '+$notif_id);
     
        
          $.ajax({
                url:"/updatenotif",
                type:"POST",
                data:'_token = <?php echo csrf_token() ?>',
                success: function (data) {
                            alert($post_id);
                            console.log(data);
                        },
                error:function (xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(status);
                  console.log($notif_id);
                }
              });
        
      
      
  } */
</script>
    
@endpush

 
