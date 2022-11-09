@extends('layout.master2')

@section('content')
<div class="content" style="background-color:white; padding:10px;">
    <section class="content" >
       
           @foreach ($list as $item)

           @if ($item->read_yn=='N')
            <div class="info-box shadow-lg" style="min-height:50px; background-color:lightskyblue;">
                    <span class="info-box-icon">
                        <img src="{{asset('/uploads/photo_profile/'.$item->photo.'')}}" alt="User Image" height="50px" width="50px" style="margin-right:5px">
                    </span>
                    <div class="info-box-content">
                        <a href="" class="notif" id="{{$item->post_id}}" >
                        <div class="row">
                        <div class="col-md">
                            <input type="hidden"  id="id_post_notif{{$item->post_id}}" value="{{$item->post_id}}">
                            <input type="hidden"  id="id_notif{{$item->post_id}}" value="{{$item->id_notif}}">
                            
                            <span class="info-box-number"><b>{{$item->firstname." ".$item->lastname}}</b></span>
                            <span class="info-box-text">{{$item->msg_display}}</span>
                            
                            
                        </div>
                        <div class="col-md" style="text-align:right;vertical-align:middle;">
                                @if ($item->notif_cat == "1")
                                <i class="fa fa-thumbs-up " style="font-size: 250%;"></i> 
                                @elseif($item->notif_cat == "2")
                                <i class="fa fa-comments " style="font-size: 250%;" ></i> 
                                @elseif(($item->notif_cat == "3") || ($item->notif_cat == "4"))
                                <i class="fa fa-birthday-cake" style="font-size: 250%;"></i> 
                                @endif
                        </div>
                        </div>
                        </a>
                    </div>
            </div>
           @else
           <div class="info-box shadow-lg" style="min-height:50px; background-color:white;">
                <span class="info-box-icon">
                    <img src="{{asset('/uploads/photo_profile/'.$item->photo.'')}}" alt="User Image" height="50px" width="50px" style="margin-right:5px">
                </span>
                <div class="info-box-content">
                    <a href="" class="notif" id="{{$item->post_id}}" >
                    <div class="row">
                    <div class="col-md">
                        <input type="hidden"  id="id_post_notif{{$item->post_id}}" value="{{$item->post_id}}">
                        <input type="hidden"  id="id_notif{{$item->post_id}}" value="{{$item->id_notif}}">
                        
                        <span class="info-box-number"><b>{{$item->firstname." ".$item->lastname}}</b></span>
                        <span class="info-box-text">{{$item->msg_display}}</span>
                        
                    </div>
                    <div class="col-md" style="text-align:right;vertical-align:middle;">
                            @if ($item->notif_cat == "1")
                            <i class="fa fa-thumbs-up " style="font-size: 250%;"></i> 
                            @elseif($item->notif_cat == "2")
                            <i class="fa fa-comments " style="font-size: 250%;" ></i> 
                            @elseif(($item->notif_cat == "3") || ($item->notif_cat == "4"))
                            <i class="fa fa-birthday-cake" style="font-size: 250%;"></i> 
                            @endif
                    </div>
                    </div>
                    </a>
                </div>
        </div>
           @endif
                
           @endforeach
           
      
    </section>
</div>
@endsection