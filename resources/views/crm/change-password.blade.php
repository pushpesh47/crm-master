<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Password</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                  </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Password <small>Update</small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" role="add-account" method="POST" action="{{url('crm/change-password')}}">
             
              <span class="section">Password Info</span>
              <div class="col-md-12 col-sm-12">
                
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Old Password<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="old_password" placeholder="Old Password"  type="password">
                  </div>
                </div>
                 <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align"  for="name">New Password <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="password"  placeholder="New Password"  type="password">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Confirm Password<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="confirm_password"  placeholder="Confirm Password"  type="password">
                  </div>
                </div>
                
              
              </div>
              </div>
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 offset-md-3">
                  <a href="{{redirect()->getUrlGenerator()->previous()}}" class="btn btn-primary">Cancel</a>
                  <button  data-request="ajax-submit" data-target='[role="add-account"]' type="button" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>