@extends('layout.master2')

@section('content')
<div class="content" style="background-color:white; padding:10px;">
    <section class="content" >       
     @for ($i = 0; $i < count($list); $i++)
     
         @if (($i % 2) == 0 && ($i!= count($list)))
         <div class="row">
             <div class="col-md-6">
               <form action="/follow" method="post" name="form{{$list[$i]->id}}">
                @csrf
                     <div class="small-box bg-info">
                             <div class="inner">
                             <h3>{{$list[$i]->firstname." ".$list[$i]->lastname}}</h3>
                             <input type="hidden" name="id_follow" id="id_follow" value="{{$list[$i]->id}}">
                             <p>{{$list[$i]->profession}}</p>
                             </div>
                              <div class="icon">
                                  @if (is_null($list[$i]->photo))
                                    <i class="fa"><img src="{{asset('/template/dist/img/avatar.png')}}" alt="User Avatar" width="70" height="70"></i>
                                  @else
                                    <i class="fa"><img src="{{asset('/uploads/photo_profile/'.$list[$i]->photo.'')}}" alt="User Avatar" width="70" height="70"></i>
                                  @endif
                                    
                             {{-- <i class="fa fa-shopping-cart"></i> --}}
                             </div>
                             <button type="submit" class="btn small-box-footer" style="text-align:center;width:100%;">Follow <i class="fa fa-arrow-circle-right"></i></button>
                             
                     </div>
                </form>
             </div>
         @elseif(($i % 2) != 0 && ($i!= count($list) ))
             <div class="col-md-6">
                 <form action="/follow" method="post" name="form{{$list[$i]->id}}">
                  @csrf
                     <div class="small-box bg-info">
                             <div class="inner">
                             <h3>{{$list[$i]->firstname." ".$list[$i]->lastname}}</h3>
                             <input type="hidden" name="id_follow" id="id_follow" value="{{$list[$i]->id}}">
                             <p>{{$list[$i]->profession}}</p>
                             </div>
                             <div class="icon">
                                  @if (is_null($list[$i]->photo))
                                    <i class="fa"><img src="{{asset('/template/dist/img/avatar.png')}}" alt="User Avatar" width="70" height="70"></i>
                                  @else
                                    <i class="fa"><img src="{{asset('/uploads/photo_profile/'.$list[$i]->photo.'')}}" alt="User Avatar" width="70" height="70"></i>
                                  @endif
                             </div>
                             <button type="submit" class="btn small-box-footer" style="text-align:center;width:100%;">Follow <i class="fa fa-arrow-circle-right"></i></button>
                     </div>
                    </form>
             </div>
         </div>
         @elseif(($i % 2) == 0 && ($i == count($list) ))
            <div class="row">
                    <div class="col-md-6">
                    <form action="/follow" method="post" name="form{{$list[$i]->id}}">
                        @csrf
                            <div class="small-box bg-info">
                                    <div class="inner">
                                    <h3>{{$list[$i]->firstname." ".$list[$i]->lastname}}</h3>
                                    <input type="hidden" name="id_follow" id="id_follow" value="{{$list[$i]->id}}">
                                    <p>{{$list[$i]->profession}}</p>
                                    </div>
                                    <div class="icon">
                                          @if (is_null($list[$i]->photo))
                                            <i class="fa"><img src="{{asset('/template/dist/img/avatar.png')}}" alt="User Avatar" width="70" height="70"></i>
                                          @else
                                            <i class="fa"><img src="{{asset('/uploads/photo_profile/'.$list[$i]->photo.'')}}" alt="User Avatar" width="70" height="70"></i>
                                          @endif
                                    </div>
                                    <button type="submit" class="btn small-box-footer" style="text-align:center;width:100%;">Follow <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </form>
                    </div>
            </div>

         @endif
     
     @endfor   
    </section>
</div>
@endsection