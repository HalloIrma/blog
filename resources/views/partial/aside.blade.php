
      <div class="card card-widget widget-user" style="margin-top: 10px;"
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header  bg-info">
                <a class="fa fa-pencil-square" href="/accountpage" style="float:left;"></a>
                <h3 class="widget-user-username text-right">{{Auth::user()->firstname." ".Auth::user()->lastname}}</h3>
                <h5 class="widget-user-desc text-right">{{Auth::user()->profession}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{asset('/uploads/photo_profile/'.Auth::user()->photo.'')}}" alt="User Avatar">
              </div>
              <div class="card-footer">
                    {{-- <div class="description-block" > --}}
                       <h5 class="description-header" align="center">{{Auth::user()->motto}}</h5>
                      {{-- <span >{{Auth::user()->motto}}</span> --}}
                    {{-- </div> --}}
                    <!-- /.description-block -->
                  
              </div>
      </div>
      
            <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">Recomendation</h3>
              </div>
              <div class="card-body">

                @foreach ($recomendation as $rec)
                    <form action="/follow" method="POST" class="form-horizontal" style="padding-bottom:20px;" name="rec{{$rec->id}}">
                        @csrf
                        <div class="row" >
                          <div class="col" >
                          <input type="hidden" name="id_follow" id="id_follow" value="{{$rec->id}}">
                          <img src="{{asset('/uploads/photo_profile/'.$rec->photo.'')}}" alt="User Avatar" width="70" height="70">
                          </div>
                          <div class="col">
                              <div class="row">
                                  <h5><b>{{$rec->firstname}}</b></h5>
                              </div>
                              <div class="row">
                                  <span>{{$rec->profession}}</span>
                              </div>
                              <div class="row">
                                  <button type="submit" class="btn btn-primary">Follow</button>
                              </div>
                          </div>
                        </div>
                    </form>
                @endforeach

              </div>
              <div class="card-footer">
                <div style="text-align:center;">
                    <a href="#" class="btn btn-sm" align="center">See More <i class="fa fa-arrow-right"></i></a>
                </div>
                
              </div>
            </div>
          
