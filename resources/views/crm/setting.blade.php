<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Profile</h3>
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
            <h2>Profile <small>Update</small></h2>
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
            <form class="form-horizontal" role="add-account" method="POST" action="{{url('crm/updateProfile')}}">
             
              <span class="section">Setting Info</span>
              <div class="col-md-12 col-sm-12">
              
                <div class="col-md-2">
                  <a href="{{url('crm/user')}}" class="btn btn-primary">New User</a>
                </div>
                <div class="col-md-2">
                  <a href="{{url('crm/user-role')}}" class="btn btn-primary">New Role</a>
                </div>
                <div class="col-md-2">
                  <a href="{{url('crm/account-status')}}" class="btn btn-primary">Account status</a>
                </div>
                <div class="col-md-2">
                  <a href="{{url('crm/lead-source')}}" class="btn btn-primary">Lead Source</a>
                </div>
                <div class="col-md-2">
                  <a href="{{url('crm/emails')}}" class="btn btn-primary">Email Template</a>
                </div>
                
                <div class="col-md-2">
                  <a href="{{url('crm/form-module')}}" class="btn btn-primary">Custom Field</a>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>