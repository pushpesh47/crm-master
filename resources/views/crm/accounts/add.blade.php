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
            <h2>Account <small></small></h2>
             <a href="{{url('crm/form-module/create')}}" type="button" class="btn btn-info">Add Custom Field</a>
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
            <form class="form-horizontal" role="add-account" method="POST" action="{{url('crm/accounts')}}">
              <div class="container-fluid">
              <div class="row">
                <span class="section">Account Information</span>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Customer Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Customer Name"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" placeholder="Cutomer No." for="email">Customer No  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" disabled="" placeholder="Cutomer No." value="AUTO GEN ON SAVE" required="required" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Lead Source <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" name="lead_source">
                      @if(!empty($lead_source))
                        @foreach($lead_source as $value)
                          <option value="{{$value['lead_source']}}">{{ucfirst($value['lead_source'])}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Enquiry Type <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" name="enquiry_type">
                      <option value="">Select Enquiry Type</option>
                      <option value="email">Email</option>
                      <option value="phone">Phone</option>
                    </select>
                  </div>
                </div>
              </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Call trasnsfer Time<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="time" id="call_transfer_time" placeholder="Call trasnsfer Time" name="call_transfer_time" required="required"  class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">Account Status<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="account_status">
                    @if(!empty($account_status))
                    @foreach($account_status as $value)
                      <option value="{{$value['account_status']}}">{{ucfirst($value['account_status'])}}</option>
                    @endforeach
                  @endif
                 </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Primary Phone Number<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="number" placeholder="Primary Phone Number" name="mobile" required="required"  class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Panel Refrence<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="panel_refrence">
                      <option value="">Select Panel Refrence</option>
                      <option value="email">Email</option>
                      <option value="phone">Phone</option>
                 </select>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Type Of Lead<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="type_of_lead">
                       <option value="">Select Type Of Lead</option>
                      <option value="email">Email</option>
                      <option value="phone">Phone</option>
                 </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Date of Lead Recieved<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date" id="date_lead_recieved" placeholder="Date of Lead Recieved" name="date_lead_recieved" required="required"  class="form-control">
                </div>
              </div>
            
             <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">Sales Agent<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="sales_agent">
                   @if(!empty($user_role))
                    @foreach($user_role as $value)
                      <option value="{{$value['id']}}">{{ucfirst($value['first_name'].' '.$value['last_name'])}}</option>
                    @endforeach
                  @endif
                 </select>
                </div>
              </div>
            </div>
            </div>
            <div class="container-fluid">
            <div class="row">
              <span class="section">Lead Information</span>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Type Of Injury<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <textarea name="injury_type"></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Date of Injury or Negligence<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date"  name="date_of_injury"  placeholder="dd-mm-yyyy" class="form-control">
                </div>
              </div>
            </div>
            
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Potential Defendant<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <textarea name="potential_defendant"></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Date Client Became Aware of Injury/Negligence<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date"  name="date_of_injury_"  placeholder="dd-mm-yyyy" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
             <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">Lead Quality<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="lead_quality">
                      <option value="high">High</option>
                      <option value="low">Low</option>
                    
                 </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Facebook Injury Date<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date"  name="facebook_injury_date"  placeholder="dd-mm-yyyy" class="form-control">
                </div>
              </div>
            </div>
              @if(!empty($form))
                @foreach($form as $forms)
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
                @endforeach
              @endif
            <div class="ln_solid"></div>
            </div>
            <div class="container-fluid">
              <span class="section">Callback Information</span>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Call back Date<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6">
                      <input id="name" class="form-control"  name="call_back_time" placeholder="Call back Date"  type="text">
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Call Back Time<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6">
                      <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" name="call_back_time" placeholder="Call Back Time"  type="text">
                    </div>
                  </div>
                </div>
              @if(!empty($form))
                @foreach($form as $forms)
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
                @endforeach
              @endif

              <div class="ln_solid"></div>
            </div>
            <div class="container-fluid">
              <span class="section">Customer Information</span>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">First Name<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" name="first_name" placeholder="First Name"  type="text">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Last Name<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input id="name" class="form-control" data-validate-length-range="6" data-validate-words="2" name="last_name" placeholder="Last Name"  type="text">
                </div>
              </div>
              
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Home Telephone Number <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="telephone" name="home_telephone_number"   placeholder="Home Telephone Number" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Mobile Telephone Number <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="telephone" name="mobile_telephone_number"   placeholder="Mobile Telephone Number" class="form-control">
                </div>
              </div>
              
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Social Media handle <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text"  name="social_media_handle"   placeholder="Social Media handle" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="email" name="email"   placeholder="Email" class="form-control">
                </div>
              </div>
              
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Date Of Birth <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date" id="date_of_birth" name="date_of_birth"   placeholder="Date Of Birth" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Address, City, Postcode <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <textarea type="text" id="telephone" name="email"   placeholder="Address, City, Postcode" class="form-control"></textarea> 
                </div>
              </div>
            </div>
              @if(!empty($form))
                @foreach($form as $forms)
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
                @endforeach
              @endif
           
              <div class="ln_solid"></div>
            </div>
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