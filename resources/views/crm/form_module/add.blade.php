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
            <h2>{{$title}} <small>Add</small></h2>
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
            <form class="form-horizontal" role="add-account" method="POST" action="{{url('crm/form-module')}}">
            <div class="x_content">
              <div class="col-md-12 col-sm-12">
                <span class="section">Form Info</span>
              </div>
              <div class="col-md-12 col-sm-12">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Module<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                  <select class="form-control" name="module_type">
                   <option value="account">Account</option>
                   <option value="leads">Leads</option>
                  </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Field Label<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="field_label" placeholder="Field Label"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Field type <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="field_type">
                   <option value="text">text</option>
                   <option value="textarea">textarea</option>
                   <!-- <option value="file">file</option>
                   <option value="radio">radio</option>
                   <option value="select">select</option>
                   <option value="checkbox">checkbox</option> -->
                 </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Section Type<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="section_type">
                   <option value="">Select Section Type</option>
                   <option value="account_information"> Account Information</option>
                   <option value="lead_information">Lead Information</option>
                   <option value="call_back_information"> Call Back Information</option>
                   <option value="customer_information">Customer Information</option>
                 </select>
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
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>