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
            <form class="form-horizontal" role="add-account" method="POST" action="{{url('crm/form-module/'.___encrypt($form['id']))}}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$form['id']}}">
              <span class="section">Form Info</span>
              <div class="col-md-12 col-sm-12">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Module<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                  <select class="form-control" name="module_type">
                   <option @if($form['module_type']=='account') selected="" @endif value="account">Account</option>
                   <option @if($form['module_type']=='leads') selected="" @endif value="leads">Leads</option>
                  </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Field Label<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" value="{{$form['field_label']}}" name="field_label" placeholder="Field Label"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Field type <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="field_type">
                   <option @if($form['field_type']=='text') selected="" @endif value="text">text</option>
                   <option @if($form['field_type']=='textarea') selected="" @endif value="textarea">textarea</option>
                   <!-- <option @if($form['field_type']=='file') selected="" @endif value="file">file</option>
                   <option @if($form['field_type']=='radio') selected="" @endif value="radio">radio</option>
                   <option @if($form['field_type']=='select') selected="" @endif value="select">select</option>
                   <option @if($form['field_type']=='checkbox') selected="" @endif value="checkbox">checkbox</option> -->
                 </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Section Type<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="section_type">
                   <option value="">Select Section Type</option>
                   <option @if($form['section_type']=='account_information') selected="" @endif value="account_information"> Account Information</option>
                   <option @if($form['section_type']=='lead_information') selected="" @endif value="lead_information">Lead Information</option>
                   <option @if($form['section_type']=='call_back_information') selected="" @endif value="call_back_information"> Call Back Information</option>
                   <option @if($form['section_type']=='customer_information') selected="" @endif value="customer_information">Customer Information</option>
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>