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
            <div class="clearfix"></div>
          </div>
            <form class="form-horizontal" role="add-account" method="POST" action="{{url('crm/accounts/'.___encrypt($account['id']))}}">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="id" value="{{$account['id']}}">
              <div class="x_content">
              <div class="col-md-12 col-sm-12">
                <span class="section">Account Information</span>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Customer Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input id="name" class="form-control" value="{{$account['name']}}" name="name" placeholder="Customer Name"  type="text">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" placeholder="Cutomer No." for="email">Customer No  <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" disabled="" placeholder="Cutomer No." value="{{$account['customer_number']}}" required="required" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Lead Source <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" name="lead_source">
                      <option value="">Select Lead Source</option>
                      @if(!empty($lead_source))
                        @foreach($lead_source as $value)
                          <option @if($account['lead_source']==$value['lead_source']) selected="" @endif value="{{$value['lead_source']}}">{{ucfirst($value['lead_source'])}}</option>
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
                      @if(!empty($select))
                        @foreach($select as $enquiryType)
                          @if($enquiryType['type']=='Enquiry-Type')
                            <option @if($enquiryType['name']==$account['enquiry_type']) selected="" @endif value="{{$enquiryType['name']}}">{{$enquiryType['name']}}</option>
                          @endif
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
              </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Call trasnsfer Time<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="time" id="call_transfer_time" placeholder="Call trasnsfer Time" value="{{$account['call_transfer_time']}}" name="call_transfer_time" required="required"  class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">Account Status<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="account_status">
                  <option value="">Select Account Status</option>
                    @if(!empty($account_status))
                    @foreach($account_status as $value)
                      <option @if($account['account_status']==$value['account_status']) selected="" @endif value="{{$value['account_status']}}">{{ucfirst($value['account_status'])}}</option>
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
                  <input type="text" id="number" placeholder="Primary Phone Number" name="mobile" value="{{$account['mobile']}}" required="required"  class="form-control">
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
                      @if(!empty($select))
                        @foreach($select as $TypeOfLead)
                          @if($TypeOfLead['type']=='Type-Of-Leads')
                            <option @if($TypeOfLead['name']==$account['type_of_lead']) selected="" @endif value="{{$TypeOfLead['name']}}">{{$TypeOfLead['name']}}</option>
                          @endif
                        @endforeach
                      @endif
                 </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Date of Lead Recieved<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date" id="date_lead_recieved" placeholder="Date of Lead Recieved" value="{{___d($account['date_lead_recieved'],'Y-m-d')}}" name="date_lead_recieved" required="required"  class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
             <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">Sales Agent<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="sales_agent">
                  <option value="">Select Agent</option>
                   @if(!empty($user_role))
                    @foreach($user_role as $value)
                      <option @if($value['id']==$account['sales_agent']) selected=""  @endif value="{{$value['id']}}">{{ucfirst($value['first_name'].' '.$value['last_name'])}}</option>
                    @endforeach
                  @endif
                 </select>
                </div>
              </div>
              </div>
              @php $myfromnae=[]; $i=0; @endphp
                @if(!empty($account['account_more']))

                @foreach($account['account_more'] as $forms)
                @if($forms['form_details']['section_type']=='account_information')
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
                @endif
                @endforeach
                @endif

                @if(!empty($account_info))
                @foreach($account_info as $forms)
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

            <div class="x_content">
            <div class="col-md-12 col-sm-12">
              <span class="section">Lead Information</span>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Type Of Injury<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <textarea name="injury_type">{{$account['injury_type']}}</textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Date of Injury or Negligence<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date"  value="{{___d($account['date_of_injury'],'Y-m-d')}}" name="date_of_injury"  placeholder="dd-mm-yyyy" class="form-control">
                </div>
              </div>
            </div>
            
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Potential Defendant<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <textarea name="potential_defendant">{{$account['potential_defendant']}}</textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Date Client Became Aware of Injury/Negligence<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date"  value="{{___d($account['date_of_injury_aware'],'Y-m-d')}}" name="date_of_injury_aware"  placeholder="dd-mm-yyyy" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
             <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="textarea">Lead Quality<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                 <select class="form-control" name="lead_quality">
                      <option @if($account['lead_quality']=='high') selected="" @endif value="high">High</option>
                      <option @if($account['lead_quality']=='low') selected="" @endif value="low">Low</option>
                    
                 </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="website">Facebook Injury Date<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date"  value="{{___d($account['facebook_injury_date'],'Y-m-d')}}" name="facebook_injury_date"  placeholder="dd-mm-yyyy" class="form-control">
                </div>
              </div>
            </div>
              @php $myfromnae=[]; $i=0; @endphp
                @if(!empty($account['account_more']))

                @foreach($account['account_more'] as $forms)
                 @if($forms['form_details']['section_type']=='lead_information')
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
                @endif
                @endforeach
                @endif

                @if(!empty($lead_info))
                @foreach($lead_info as $forms)
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
            <div class="ln_solid"></div>
            </div>
            <div class="x_content">
              <div class="col-md-12 col-sm-12">
                <span class="section">Callback Information</span>
              </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Call back Time<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6">
                      <input id="name" class="form-control"  value="{{$account['call_back_time']}}" name="call_back_time" placeholder="Call back Time"  type="time">
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Call Back Date<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6">
                      <input id="name" class="form-control" value="{{$account['call_back_date']}}" name="call_back_date" placeholder="Call Back Date"  type="date">
                    </div>
                  </div>
                </div>
              @php $myfromnae=[]; $i=0; @endphp
                @if(!empty($account['account_more']))

                @foreach($account['account_more'] as $forms)
                 @if($forms['form_details']['section_type']=='callback_information')
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
                @endif
                @endforeach
                @endif

                @if(!empty($callback_info))
                @foreach($callback_info as $forms)
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

              <div class="ln_solid"></div>
            </div>
            <div class="x_content">
            <div class="col-md-12 col-sm-12">
              <span class="section">Customer Information</span>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">First Name<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input id="name" class="form-control" value="{{$account['first_name']}}" name="first_name" placeholder="First Name"  type="text">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Surname<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input id="name" class="form-control" value="{{$account['last_name']}}" name="last_name" placeholder="Surname"  type="text">
                </div>
              </div>
              
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Home Telephone Number <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="telephone" value="{{$account['home_telephone_number']}}" name="home_telephone_number"   placeholder="Home Telephone Number" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Mobile Telephone Number <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="telephone" value="{{$account['mobile_telephone_number']}}" name="mobile_telephone_number"   placeholder="Mobile Telephone Number" class="form-control">
                </div>
              </div>
              
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Social Media handle <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text"  value="{{$account['social_media_handle']}}" name="social_media_handle"   placeholder="Social Media handle" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="text" id="email" value="{{$account['email']}}" name="email"   placeholder="Email" class="form-control">
                </div>
              </div>
              
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Date Of Birth <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <input type="date" id="date_of_birth" value="{{___d($account['date_of_birth'],'Y-m-d')}}" name="date_of_birth"   placeholder="Date Of Birth" class="form-control">
                </div>
              </div>
              <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" >Address, City, Postcode <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                  <textarea type="text" id="telephone" name="address"   placeholder="Address, City, Postcode" class="form-control">{{$account['address']}}</textarea> 
                </div>
              </div>
            </div>
                @php $myfromnae=[]; $i=0; @endphp
                @if(!empty($account['account_more']))

                @foreach($account['account_more'] as $forms)
                 @if($forms['form_details']['section_type']=='customer_information')
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
                @endif
                @endforeach
                @endif

                @if(!empty($customer_info))
                @foreach($customer_info as $forms)
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