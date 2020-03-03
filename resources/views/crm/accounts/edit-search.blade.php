<style type="text/css">
form h2
{
  padding-top:20px;
}
  form .my1
  {
    line-height: 50px;

  }
 form  select,input[type="text"],input[type="date"]
  {
    box-shadow: 2px 2px 5px grey;
  }
 .option
  {
    color:grey;
    font-size:15px;
  }
  form .tabs1
  {
    margin-top:40px;
  }ul li a
  {
    color:#73879C;
  }
  .tab-pane
  {
    padding:0px 50px 20px 50px;
  }
  .btn-success,.btn-primary
  {
    margin-top:10px;
  }
</style>
<div class="right_col" role="main">
  <div class="container">
    
      <form method="POST" action="{{url('crm/filter/'.___encrypt($filter['id']))}}" role="create-filter">
        <input type="hidden" name="_method" value="PUT">
        <!------------Details--->
        <h2>Details</h2>
            <div class="form-row">
              <div class="col-sm-4 my-1">
                <input type="text" value="{{$filter['view_name']}}" class="form-control" placeholder="View name" name="view_name">
              </div>
               <div class="col-sm-2 my-1">
                <div class=" mr-sm-2">
                  <input type="checkbox" @if($filter['set_as_default']=='on') checked="" @endif name="set_as_default" >
                  <label class="-label" for="customControlAutosizing">Set as Default</label>
                </div>
              </div>
               <div class="col-sm-2 my-1">
                <div class=" mr-sm-2">
                  <input type="checkbox" @if($filter['list_in_metrics']=='on') checked="" @endif name="list_in_metrics" >
                  <label class="-label" for="customControlAutosizing">List in Matrix</label>
                </div>
              </div>
               <div class="col-auto my-1">
                <div class=" mr-sm-2">
                  <input type="checkbox" @if($filter['set_as_public']=='on') checked="" @endif name="set_as_public" >
                  <label class="-label" for="customControlAutosizing">Set as public</label>
                </div>
              </div>
            </div>
               <!------------Column Details--->
             <h2>Choose columns</h2>
            <div class="form-row">
              <div class="col-sm-3 my-1">
                       
                  <select id="inputState" class="form-control option" name="column[column_name1]">
                      @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name1']);
                  </select>
              </div>
                <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name2]">
                    @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name2']);
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name3]">
                    @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name3']);
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name4]">
                    @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name4']);
                  </select>
              </div>
            </div>


             <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name5]">
                   @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name5']);
                  </select>
              </div>
                <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name6]">
                    @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name6']);
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name7]">
                   @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name7']);
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name8]">
                    @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name8']);
                  </select>
              </div>
            </div>

              <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name9]">
                    @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name9']);
                  </select>
              </div>
            </div>
            <input type="hidden" name="dups_column">
               <!------------  End--->
          <div class="container tabs1">
            <ul class="nav nav-tabs nav-justified md-tabs indigo" id="myTabJust" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just"
                aria-selected="true">Standard Filters</a>
            </li>
           <!--  <li class="nav-item">
              <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just"
                aria-selected="false">Advanced Filters</a>
            </li> -->
          </ul>
          <div class="tab-content card pt-5" id="myTabContentJust">
            <div class="tab-pane fade show active" id="home-just" role="tabpanel" aria-labelledby="home-tab-just">
              <h2 class="heading">Simple Time Filter</h2>
               <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Select a Column</label>
                       </div>
                        <div class="col-sm-10 my-1">
                            <select id="inputState" class="form-control option" name="column_from">
                            <!--  @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name10']); -->
                            <option value="date_of_injury">Date Of Injury</option>
                            <option value="date_of_injury">Date Lead Recieved</option>
                            <option value="date_of_injury_aware">Date Client Became Aware of Injury</option>
                            <option value="date_of_injury">facebook_injury_date</option>
                            <option value="call_back_date">Call Back Date</option>
                            </select>
                        </div>

                </div>
                <div class="form-row">
                      <div class="col-sm-2 my-1">
                          <label>Select a Column</label>
                     </div>
                      <div class="col-sm-10 my-1">
                          <select id="inputState" class="form-control option" name="column_days">
                              <option value="custom">Custom</option>
                              <option value="prevfy">Previous FY</option>
                              <option value="thisfy">Current FY</option>
                              <option value="nextfy">Next FY</option>
                              <option value="prevfq">Previous FQ</option>
                              <option value="thisfq">Current FQ</option>
                              <option value="nextfq">Next FQ</option>
                              <option value="yesterday">Yesterday</option>
                              <option value="today">Today</option>
                              <option value="tomorrow">Tomorrow</option>
                              <option value="lastweek">Last Week</option>
                              <option value="thisweek">Current Week</option>
                              <option value="nextweek">Next Week</option>
                              <option value="lastmonth">Last Month</option>
                              <option value="thismonth">Current Month</option>
                              <option value="nextmonth">Next Month</option>
                              <option value="last7days">Last 7 Days</option>
                              <option value="last30days">Last 30 Days</option>
                              <option value="last60days">Last 60 Days</option>
                              <option value="last90days">Last 90 Days</option>
                              <option value="last120days">Last 120 Days</option>
                              <option value="next30days">Next 30 Days</option>
                              <option value="next60days">Next 60 Days</option>
                              <option value="next90days">Next 90 Days</option>
                              <option value="next120days">Next 120 Days</option>
                              <option value="overdue">Overdue</option>
                          </select>
                      </div>

                </div>
                <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Start Date</label>
                       </div>
                        <div class="col-sm-10 my-1">
                             <input type="date" class="form-control" placeholder="Value" name="start_date">
                        </div>

                </div>
                 <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Start Date</label>
                       </div>
                        <div class="col-sm-10 my-1">
                             <input type="date" class="form-control" placeholder="Value" name="end_date">
                        </div>

                </div>
            </div>
            <!-- <div style="display: none" class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">
               <h2 class="heading">Advance Search</h2>
                <div class="form-row pull-right"> 
                    <button class="btn btn-info btn-sm">New Group</button> 
                </div> 
                <br/><br/>
                  <input type="hidden" name="filter_type" value="advace">
                    <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name12]">
                    @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name12']);
                  </select>
              </div>
                <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name13]">
                    @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name13']);
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name14]">
                    @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name14']);
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <input type="search" class="form-control" placeholder="search" name="column[search]">
              </div>
            </div>
            </div> -->
          </div>
          </div>
            <div class="form-row">
                 <div class="col-sm-2 my-1"></div>
                <div class="col-sm-1 my-1">
                  <button type="button" data-request="ajax-submit" data-target='[role="create-filter"]' class="btn btn-success">Save</button>
                </div>
                <div class="col-sm-3 my-1">
                  <button class="btn btn-primary">Cancel</button>
                </div>
            </div>

      </form>
  </div>
</div>
@section('requirejs')
  <script type="text/javascript">
   function showDateRange( type ) {
        if (type!="custom") {
          document.CustomView.startdate.readOnly=true
          document.CustomView.enddate.readOnly=true
          getObj("jscal_trigger_date_start").style.visibility="hidden"
          getObj("jscal_trigger_date_end").style.visibility="hidden"
        } else {
          document.CustomView.startdate.readOnly=false
          document.CustomView.enddate.readOnly=false
          getObj("jscal_trigger_date_start").style.visibility="visible"
          getObj("jscal_trigger_date_end").style.visibility="visible"
        }
        if( type == "today" ) {
          document.CustomView.startdate.value = "06-12-2019";
          document.CustomView.enddate.value = "06-12-2019";

        } else if( type == "yesterday" ) {
          document.CustomView.startdate.value = "05-12-2019";
          document.CustomView.enddate.value = "05-12-2019";

        } else if( type == "tomorrow" ) {
          document.CustomView.startdate.value = "07-12-2019";
          document.CustomView.enddate.value = "07-12-2019";

        } else if( type == "thisweek" ) {
          document.CustomView.startdate.value = "01-12-2019";
          document.CustomView.enddate.value = "07-12-2019";

        } else if( type == "lastweek" ) {
          document.CustomView.startdate.value = "24-11-2019";
          document.CustomView.enddate.value = "30-11-2019";

        } else if( type == "nextweek" ) {
          document.CustomView.startdate.value = "08-12-2019";
          document.CustomView.enddate.value = "14-12-2019";

        } else if( type == "thismonth" ) {
          document.CustomView.startdate.value = "01-12-2019";
          document.CustomView.enddate.value = "31-12-2019";

        } else if( type == "lastmonth" ) {
          document.CustomView.startdate.value = "01-11-2019";
          document.CustomView.enddate.value = "30-11-2019";

        } else if( type == "nextmonth" ) {
          document.CustomView.startdate.value = "01-01-2020";
          document.CustomView.enddate.value = "31-01-2020";

        } else if( type == "next7days" ) {
          document.CustomView.startdate.value = "06-12-2019";
          document.CustomView.enddate.value = "12-12-2019";

        } else if( type == "next30days" ) {
          document.CustomView.startdate.value = "06-12-2019";
          document.CustomView.enddate.value = "04-01-2020";

        } else if( type == "next60days" ) {
          document.CustomView.startdate.value = "06-12-2019";
          document.CustomView.enddate.value = "03-02-2020";

        } else if( type == "next90days" ) {
          document.CustomView.startdate.value = "06-12-2019";
          document.CustomView.enddate.value = "04-03-2020";

        } else if( type == "next120days" ) {
          document.CustomView.startdate.value = "06-12-2019";
          document.CustomView.enddate.value = "03-04-2020";

        } else if( type == "last7days" ) {
          document.CustomView.startdate.value = "30-11-2019";
          document.CustomView.enddate.value =  "06-12-2019";

        } else if( type == "last30days" ) {
          document.CustomView.startdate.value = "07-11-2019";
          document.CustomView.enddate.value = "06-12-2019";

        } else if( type == "last60days" ) {
          document.CustomView.startdate.value = "08-10-2019";
          document.CustomView.enddate.value = "06-12-2019";

        } else if( type == "last90days" ) {
          document.CustomView.startdate.value = "08-09-2019";
          document.CustomView.enddate.value = "06-12-2019";

        } else if( type == "last120days" ) {
          document.CustomView.startdate.value = "09-08-2019";
          document.CustomView.enddate.value = "06-12-2019";

        } else if( type == "thisfy" ) {
          document.CustomView.startdate.value = "01-01-2019";
          document.CustomView.enddate.value = "31-12-2019";

        } else if( type == "prevfy" ) {
          document.CustomView.startdate.value = "01-01-2018";
          document.CustomView.enddate.value = "31-12-2018";

        } else if( type == "nextfy" ) {
          document.CustomView.startdate.value = "01-01-2020";
          document.CustomView.enddate.value = "31-12-2020";

        } else if( type == "nextfq" ) {
          document.CustomView.startdate.value = "01-01-2020";
          document.CustomView.enddate.value = "31-03-2020";

        } else if( type == "prevfq" ) {
          document.CustomView.startdate.value = "01-07-2019";
          document.CustomView.enddate.value = "30-09-2019";

        } else if( type == "thisfq" ) {
          document.CustomView.startdate.value = "01-10-2019";
          document.CustomView.enddate.value = "31-12-2019";

        } else {
          document.CustomView.startdate.value = "";
          document.CustomView.enddate.value = "";
        }
      }
  </script>
@endsection