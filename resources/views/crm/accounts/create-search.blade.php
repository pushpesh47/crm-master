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
    
      <form method="POST" action="{{url('crm/filter')}}" role="create-filter">

        <!------------Details--->
        <h2>Details</h2>
            <div class="form-row">
              <div class="col-sm-4 my-1">
                <input type="text" class="form-control" placeholder="View name" name="view_name">
              </div>
               <div class="col-sm-2 my-1">
                <div class=" mr-sm-2">
                  <input type="checkbox" name="set_as_default" >
                  <label class="-label" for="customControlAutosizing">Set as Default</label>
                </div>
              </div>
               <div class="col-sm-2 my-1">
                <div class=" mr-sm-2">
                  <input type="checkbox" name="list_in_metrics" >
                  <label class="-label" for="customControlAutosizing">List in Matrix</label>
                </div>
              </div>
               <div class="col-auto my-1">
                <div class=" mr-sm-2">
                  <input type="checkbox" name="set_as_public" >
                  <label class="-label" for="customControlAutosizing">Set as public</label>
                </div>
              </div>
            </div>
               <!------------Column Details--->
             <h2>Choose columns</h2>
            <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name1]">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
                <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name2]">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name3]">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name4]">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
            </div>


             <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name5]">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
                <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name6]">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name7]">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name8]">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
            </div>
            <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name9]">
                    @includeif('crm.accounts._common_field_list');
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
            <!-- <li class="nav-item">
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
                            <select id="inputState_date" class="form-control option" name="column_days">
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
                             <input type="date" id="start_date" class="form-control"  name="start_date">
                        </div>

                </div>
                 <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Start Date</label>
                       </div>
                        <div class="col-sm-10 my-1">
                             <input type="date" id="end_date" class="form-control"  name="end_date">
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
                  <select id="inputState" class="form-control option" name="column_name">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
                <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name13]">
                    @includeif('crm.accounts._common_field_list');
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option" name="column[column_name14]">
                    @includeif('crm.accounts._common_field_list');
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
  $('#inputState_date').on('change', function() {
      var date = new Date();
    if(this.value=='prevfy'){
      var intYear = date.getFullYear() - 1;
      var start_date='01-01-'+intYear;
      var end_date='31-12-'+intYear;
      $('#start_date').val(start_date);
      $('#end_date').val(end_date);
      console.log(start_date);
    }else if(this.value=='thisfy'){
       var intYear = date.getFullYear();
        var start_date='01-01-'+intYear;
        var end_date='31-12-'+intYear;
        $('#start_date').val(start_date);
        $('#end_date').val(end_date);
    }else if(this.value=='nextfy'){
       var intYear = date.getFullYear() + 1;
        var start_date='01-'+'-'+intYear;
        var end_date='31-12-'+intYear;
        $('#start_date').val(start_date);
        $('#end_date').val(end_date);
    }/*else if(this.value=='prevfq'){
       var intYear = date.getMonth()-3;
        var start_date='01-01-'+intYear;
        var end_date='31-12-'+intYear;
        $('#start_date').val(start_date);
        $('#end_date').val(end_date);
        console.log(intYear);
    }else if(this.value=='thisfq'){
       var intYear = date.getMonth()+3;
        var start_date='01-01-'+intYear;
        var end_date='31-12-'+intYear;
        $('#start_date').val(start_date);
        $('#end_date').val(end_date);
        console.log(intYear);
    }else if(this.value=='nextfq'){
       var intYear = date.getMonth()+6;
        var start_date='01-01-'+intYear;
        var end_date='31-12-'+intYear;
        $('#start_date').val(start_date);
        $('#end_date').val(end_date);
        console.log(intYear);
    }*/
  });
</script>
  
@endsection