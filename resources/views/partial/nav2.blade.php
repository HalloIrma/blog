 <!-- Content Header (Page header) -->
 <section class="content-header" >  <!-- style="margin-left:235px;"-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-link"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Engagement</span>
              @if (count($cnt_engage)>0)
              <span class="info-box-number">{{$cnt_engage[0]->cnt_engage}}</span>
              @else
              <span class="info-box-number">0</span>
              @endif
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-thumbs-up"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              @if (count($cnt_like)>0)
              <span class="info-box-number">{{$cnt_like[0]->cnt_like}}</span>
              @else
              <span class="info-box-number">0</span>
              @endif
            
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
  
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
  
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user-plus"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Following</span>
              @if (count($cnt_following)>0)
              <span class="info-box-number">{{$cnt_following[0]->cnt_following}}</span>
              @else
              <span class="info-box-number">0</span>
              @endif
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>
  
            <div class="info-box-content">
              <span class="info-box-text">Followers</span>
              @if (count($cnt_followers)>0)
              <span class="info-box-number">{{$cnt_followers[0]->cnt_followers}}</span>
              @else
              <span class="info-box-number">0</span>
              @endif
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>