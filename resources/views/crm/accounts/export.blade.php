
<html>
<head>
  <title>CRM</title>
  <style type="text/css">
    .form-control{
      height: 40px;
    }
  </style>
</head>
  <body>
    @if(!empty($accounts))
    @foreach($accounts as $account)
    <center>
       <h2>Account</h2>
        <div class="row">
                <div class="col-md-12 col-sm-12">
                  <h3>Account Information</h3><hr>
                </div>
                  <div >
                    <div>
                      <label ><b>Customer Name</b></label>
                      
                        <p>{{$account['name']}}</p>
                     
                    </div>
                    <div>
                      <label ><b>Customer Number</b></label>
                      
                        <p>{{$account['customer_number']}}</p>
                    </div>
                  </div>
                  <div >
                    <div >
                       <label ><b>Lead source</b></label>
                      
                              <p>{{ucfirst($account['lead_source'])}}</p>
                        
                      </div>
                    </div>
                    <div class="item form-group">
                       <label ><b>Enquiry Type</b></label>
                      <p>{{ucfirst($account['enquiry_type'])}}</p>
                    </div>
                  </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label><b>Call trasnsfer Time</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['call_transfer_time']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label ><b>Account Status</b></label>
                    <div class="col-md-6 col-sm-6">
                          <p >{{$account['account_status']}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label ><b>Primary Phone Number</b></label>
                    <div class="col-md-6 col-sm-6">
                     <p >{{$account['mobile']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label ><b>Panel Refrence</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['panel_refrence']}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label ><b>Type Of Lead</b></label>
                    <div class="col-md-6 col-sm-6">
                         <p>{{$account['type_of_lead']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label ><b>Date of Lead Recieved</b>
                    </label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['date_lead_recieved']}}</p>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-6 col-sm-6">
                 <div class="item form-group">
                    <label><b>Sales Agent</b></label>
                    <div class="col-md-6 col-sm-6">
                     <select disabled="" class="form-control" name="sales_agent">
                      <option value="">Select Agent</option>
                       @if(!empty($user_role))
                        @foreach($user_role as $value)
                          <option value="{{$value['id']}}">{{ucfirst($value['first_name'].' '.$value['last_name'])}}</option>
                        @endforeach
                      @endif
                     </select>
                    </div>
                  </div>
                  </div> -->
                  @php $myfromnae=[]; $i=0; @endphp
                    @if(!empty($account['account_more']))

                    @foreach($account['account_more'] as $forms)
                    @if($forms['form_details']['section_type']=='account_information')
                    <div class="col-md-6 col-sm-6">
                      <div class="item form-group">
                        <label><b>{{ucfirst($forms['form_details']['field_label'])}}</b></label>
                        <div class="col-md-6 col-sm-6">
                          <p>{{$forms['value']}}</p>
                        </div>
                      </div>
                    </div>
                    @php  $myfromnae[]=$forms['form_details']['field_name']; $i++; @endphp
                    @endif
                    @endforeach
                    @endif

                </div>

                <div class="x_content">
                <div class="col-md-12 col-sm-12">
                  <h3>Lead Information</h3><hr>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label ><b>Type Of Injury</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p >{{$account['injury_type']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label ><b>Date of Injury or Negligence</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['date_of_injury']}}</p>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label><b>Potential Defendant</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['potential_defendant']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label><b>Date Client Became Aware of Injury/Negligence</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['date_of_injury_aware']}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                 <div class="item form-group">
                    <label><b>Lead Quality</b></span>
                    </label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['lead_quality']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label><b>Facebook Injury Date</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['facebook_injury_date']}}</p>
                    </div>
                  </div>
                </div>
                @php $myfromnae=[]; $i=0; @endphp
                @if(!empty($account['account_more']))
                  @foreach($account['account_more'] as $forms)
                     @if($forms['form_details']['section_type']=='lead_information')
                      <div class="col-md-6 col-sm-6">
                        <div class="item form-group">
                          <label><b>{{ucfirst($forms['form_details']['field_label'])}}</b></label>
                          <div class="col-md-6 col-sm-6">
                            <p>{{$forms['value']}}</p>
                          </div>
                        </div>
                      </div>
                    @php  $myfromnae[]=$forms['form_details']['field_name']; $i++; @endphp
                    @endif
                  @endforeach
                @endif
                </div>
                <div class="x_content">
                  <div class="col-md-12 col-sm-12">
                    <h3>Callback Information</h3><hr>
                  </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="item form-group">
                        <label><b>Call back Date</b></label>
                        <div class="col-md-6 col-sm-6">
                          <p>{{$account['call_back_time']}}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="item form-group">
                        <label><b>Call Back Time</b></label>
                        <div class="col-md-6 col-sm-6">
                          <p>{{$account['call_back_date']}}</p>
                        </div>
                      </div>
                    </div>
                  @php $myfromnae=[]; $i=0; @endphp
                    @if(!empty($account['account_more']))

                    @foreach($account['account_more'] as $forms)
                     @if($forms['form_details']['section_type']=='callback_information')
                    <div class="col-md-6 col-sm-6">
                        <div class="item form-group">
                          <label><b>{{ucfirst($forms['form_details']['field_label'])}}</b></label>
                          <div class="col-md-6 col-sm-6">
                            <p>{{$forms['value']}}</p>
                          </div>
                        </div>
                    </div>
                    @php  $myfromnae[]=$forms['form_details']['field_name']; $i++; @endphp
                    @endif
                    @endforeach
                    @endif
                </div>
                <div class="x_content">
                <div class="col-md-12 col-sm-12">
                  <h3>Customer Information</h3><hr>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label><b>First Name</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['first_name']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label><b>Surname</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['last_name']}}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label><b>Home Telephone Number</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['home_telephone_number']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label><b>Mobile Telephone Number</b></label>
                    <div class="col-md-6 col-sm-6">
                     <p>{{$account['mobile_telephone_number']}}</p>
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label><b>Social Media handle</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['social_media_handle']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label><b>Email</b></label>
                    <div class="col-md-6 col-sm-6">
                     <p>{{$account['email']}}</p>
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="item form-group">
                    <label><b>Date Of Birth</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['date_of_birth']}}</p>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label><b>Address, City, Postcode</b></label>
                    <div class="col-md-6 col-sm-6">
                      <p>{{$account['address']}}</p> 
                    </div>
                  </div>
                </div>
                    @php $myfromnae=[]; $i=0; @endphp
                    @if(!empty($account['account_more']))

                    @foreach($account['account_more'] as $forms)
                     @if($forms['form_details']['section_type']=='customer_information')
                    <div class="col-md-6 col-sm-6">
                        <div class="item form-group">
                          <label><b>{{ucfirst($forms['form_details']['field_label'])}}</b></label>
                          <div class="col-md-6 col-sm-6">
                            <p>{{$forms['value']}}</p>
                          </div>
                        </div>
                    </div>
                    @php  $myfromnae[]=$forms['form_details']['field_name']; $i++; @endphp
                    @endif
                    @endforeach
                    @endif
                </center>
            
    @endforeach
@endif
  </body>
</html>
