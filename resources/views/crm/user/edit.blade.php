<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>{{$title}}</h3>
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
            <h2>{{$title}} <small>Edit</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                  </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" role="add-account" method="POST" action="{{url('crm/user/'.___encrypt($user['id']))}}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$user['id']}}">
              <span class="section">{{$title}} Info</span>
             
                <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">First Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" value="{{$user['first_name']}}" name="first_name" placeholder="First Name"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Last Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" value="{{$user['last_name']}}" name="last_name" placeholder="Last Name"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align"  for="email">Email  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text"  name="email" value="{{$user['email']}}" placeholder="Email" required="required" class="form-control">
                  </div>
                </div>
                 <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align"  for="email">Username  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text"  value="{{$user['username']}}" placeholder="Username" name="username" class="form-control">
                  </div>
                </div>
              </div>
               <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align"  for="email">Modile  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text"  value="{{$user['mobile']}}" placeholder="Modile" name="mobile" class="form-control">
                  </div>
                </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="password" id="telephone" name="password"   placeholder="Password" class="form-control">
                </div>
              </div>
               <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Confirm Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="password" id="telephone" name="confirm_password"   placeholder="Confirm Password" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">User Role  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="user_role">
                  @if(!empty($user_role))
                      @foreach($user_role as $role)
                        <option @if($user['user_role_id']==$role['id']) selected="" @endif value="{{$role['id']}}">{{$role['profile_name']}}</option>
                     @endforeach
                  @endif
                 </select>
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