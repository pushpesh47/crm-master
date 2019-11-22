<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Account</h3>
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
            <h2>Account <small>Edit</small></h2>
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
            <form class="form-horizontal" role="add-account" method="POST" action="{{url('crm/accounts/'.___encrypt($account['id']))}}">
             <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$account['id']}}">
              <span class="section">Personal Info</span>
              <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">First Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" value="{{$account['first_name']}}" name="first_name" placeholder="First Name"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Last Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" value="{{$account['last_name']}}" name="last_name" placeholder="Last Name"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" placeholder="Cutomer No." for="email">Customer No  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" value="{{$account['customer_number']}}"placeholder="Cutomer No." disabled="" required="required" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Lead Source <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="lead_source">
                   <option @if($account['sales_agent']=='facebook') selected="" @endif value="facebook">Facebook</option>
                   <option @if($account['sales_agent']=='google') selected="" @endif value="google">Google Adword</option>
                   <option @if($account['sales_agent']=='bing') selected="" @endif value="bing">Bing</option>
                 </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Mobile Number<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="number" value="{{$account['mobile']}}" placeholder="Mobile Number" name="mobile" required="required"  class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Date of Injury or Negligence<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date"  name="date_of_injury"  value="{{$account['date_of_injury']}}" placeholder="dd-mm-yyyy" class="form-control">
                </div>
              </div>
              
            </div>
            
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="telephone" name="email"   value="{{$account['email']}}" placeholder="Email" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">Account Status  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="account_status">
                   <option @if($account['account_status']=='new') selected="" @endif value="new">New</option>
                   <option @if($account['account_status']=='passed') selected="" @endif value="passed">Passed</option>
                   <option @if($account['account_status']=='declined') selected="" @endif value="declined">Declined</option>
                 </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
             <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">Sales Agent<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="sales_agent">
                   <option @if($account['sales_agent']=='admin') selected="" @endif value="admin">Admin</option>
                   <option @if($account['sales_agent']=='kaif') selected="" @endif value="kaif">Kaif</option>
                   <option @if($account['sales_agent']=='varun') selected="" @endif value="varun">varun</option>
                 </select>
                </div>
              </div>
            </div>
              @php $myfromnae=[]; $i=0; @endphp
              @if(!empty($account['account_more']))
              
                @foreach($account['account_more'] as $forms)
            <div class="col-md-6 col-sm-6">
                
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="{{$forms['form_details']['field_label']}}">{{ucfirst($forms['form_details']['field_label'])}}<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6">
                    @if($forms['form_details']['field_type']=='text')

                    <input type="text" id="{{$forms['form_details']['field_name']}}" name="cf[{{$forms['form_details']['field_name']}}]"   placeholder="{{$forms['form_details']['field_label']}} "  value="{{$forms['value']}}" class="form-control {{$forms['form_details']['field_name']}}">

                    @elseif($forms['form_details']['field_type']=='textarea')

                      <textarea  name="cf[{{$forms['form_details']['field_name']}}]"  id="{{$forms['form_details']['field_name']}}" placeholder="{{$forms['form_details']['field_label']}}" class="form-control {{$forms['form_details']['field_name']}}">{{$forms['value']}}</textarea>

                    @elseif($forms['form_details']['field_type']=='file')

                      <input type="text" id="{{$forms['form_details']['field_name']}}" name="cf[{{$forms['form_details']['field_name']}}]"   placeholder="{{$forms['form_details']['field_label']}}" class="form-control {{$forms['form_details']['field_name']}}">

                    @elseif($forms['form_details']['field_type']=='select')

                      <select class="form-control {{$forms['form_details']['field_name']}}" id="{{$forms['form_details']['field_name']}}" name="cf[{{$forms['form_details']['field_name']}}]">
                        <option @if($forms['value']=='admin') selected="" @endif value="admin">Admin</option>
                        <option @if($forms['value']=='kaif') selected="" @endif value="kaif">kaif</option>
                        <option @if($forms['value']=='varun') selected="" @endif value="varun">Varun</option>
                      </select>

                    @endif
                    </div>
                  </div>
                   </div>
                  @php  $myfromnae[]=$forms['form_details']['field_name']; $i++; @endphp
                @endforeach
                @endif
             
               @if(!empty($form))
                @foreach($form as $forms)
                @if(!in_array($forms['field_name'],$myfromnae))
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="{{$forms['field_label']}}">{{ucfirst($forms['field_label'])}}<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6">
                    @if($forms['field_type']=='text')

                    <input type="text" id="{{$forms['field_name']}}" name="cf[{{$forms['field_name']}}]"   placeholder="{{$forms['field_label']}} " class="form-control {{$forms['field_name']}}">

                    @elseif($forms['field_type']=='textarea')

                      <textarea  name="cf[{{$forms['field_name']}}]"  id="{{$forms['field_name']}}" placeholder="{{$forms['field_label']}}" class="form-control {{$forms['field_name']}}"></textarea>

                    @elseif($forms['field_type']=='file')

                      <input type="text" id="{{$forms['field_name']}}" name="cf[{{$forms['field_name']}}]"   placeholder="{{$forms['field_label']}}" class="form-control {{$forms['field_name']}}">

                    @elseif($forms['field_type']=='select')

                      <select class="form-control {{$forms['field_name']}}" id="{{$forms['field_name']}}" name="cf[{{$forms['field_name']}}]">
                        <option value="admin">Admin</option>
                        <option value="kaif">kaif</option>
                        <option value="varun">Varun</option>
                      </select>

                    @endif
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
              @endif
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