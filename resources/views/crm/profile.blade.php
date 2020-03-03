<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Profile</h3>
      </div>

      <div class="title_right">
        
      </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Profile <small>Update</small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" role="add-account" method="POST" action="{{url('crm/updateProfile')}}">
             
              <span class="section">Profile Info</span>
              <div class="col-md-12 col-sm-12">
                
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">First Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="first_name" value="{{\Auth::user()->first_name}}" placeholder="First Name"  type="text">
                  </div>
                </div>
                 <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align"  for="name">Last Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="last_name" value="{{\Auth::user()->last_name}}" placeholder="Last Name"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Email<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="email" value="{{\Auth::user()->email}}" placeholder="Email"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Mobile<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="mobile" value="{{\Auth::user()->mobile}}" placeholder="Mobile"  type="text">
                  </div>
                </div>
                <!-- <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Status<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="Status" value="{{ucfirst(\Auth::user()->status)}}" placeholder="Mobile"  type="text" disabled="">
                  </div>
                </div> -->
              
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