@extends('layout.master2')
@section('content')
<div class="content" style="background-color:white; padding:10px;">
    <section class="content">
            <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Update Profile</h3>
                    </div>
                    <form method="post" class="form-horizontal" action="/accountpage/update" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-3" align="center" style="margin-top:20px;">
                            @if (is_null(Auth::user()->photo) == false)
                            <img class="img-square" src="{{asset('/uploads/photo_profile/'.Auth::user()->photo.'')}}" alt="User Avatar" height="30%" width="30%">
                            @else
                            <img class="img-square" src="{{asset('/template/dist/img/avatar.png')}}" alt="User Avatar">
                            @endif
                            
                            <div class="input-group" style="height:2rem; margin-top:10px;">
                                 <div class="custom-file"> 
                                   <label for="img"></label> 
                                  <input type="file" id="img" name="img">
                                  
                               </div>
                            </div>
                            @error('img')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                            @enderror
                        </div>
                        <div class="col">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-6 col-form-label">First Name</label>
                                        <label for="lname" class="col-sm-6 col-form-label">Last Name</label>
                                    </div>
                                    <div class="form-group row">    
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required value="{{old('fname',Auth::user()->firstname)}}" >
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required value="{{old('lname',Auth::user()->lastname)}}">
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required value="{{old('username',Auth::user()->username)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="{{old('email',Auth::user()->email)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="birth" class="col-sm-2 col-form-label">Birth Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" placeholder="dd-mm-yyyy" id="birthdate" name="birthdate" min="0001-01-01" max="2030-12-31" inputmode="numeric" required value="{{old('birthdate',Auth::user()->birthdate)}}">
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="profesion" class="col-sm-2 col-form-label">Profesion</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="profession" name="profession" placeholder="" value="{{old('profession',Auth::user()->profession)}}">
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="interest" class="col-sm-2 col-form-label">Interest</label>
                                            <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="interest" name="interest" placeholder="" value="{{old('interest',Auth::user()->interest)}}">
                                                    {{-- <div class="select2-purple">
                                                        <select class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                                                          <option>Alabama</option>
                                                          <option>Alaska</option>
                                                          <option>California</option>
                                                          <option>Delaware</option>
                                                          <option>Tennessee</option>
                                                          <option>Texas</option>
                                                          <option>Washington</option>
                                                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="16" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Select a State" style="width: 353.6px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div> --}}
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="motto" class="col-sm-2 col-form-label">Motto</label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control" id="motto" name="motto" placeholder="" value="{{old('motto',Auth::user()->motto)}}">
                                            </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" style="float:right;">Update</button>
                                </div>
                        </div>
                    </div>
                </form>
                    
                  </div>
    </section>
</div>
    
@endsection