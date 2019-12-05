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

               <!------------  End--->
          <div class="container tabs1">
            <ul class="nav nav-tabs nav-justified md-tabs indigo" id="myTabJust" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just"
                aria-selected="true">Standard Filters</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just"
                aria-selected="false">Advanced Filters</a>
            </li>
          </ul>
          <div class="tab-content card pt-5" id="myTabContentJust">
            <div class="tab-pane fade show active" id="home-just" role="tabpanel" aria-labelledby="home-tab-just">
              <h2 class="heading">Simple Time Filter</h2>
               <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Select a Column</label>
                       </div>
                        <div class="col-sm-10 my-1">
                            <select id="inputState" class="form-control option" name="column[column_name10]">
                             @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name10']);
                            </select>
                        </div>

                </div>
                <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Select a Column</label>
                       </div>
                        <div class="col-sm-10 my-1">
                            <select id="inputState" class="form-control option" name="column[column_name11]">
                              @includeif('crm.accounts._common_field_list_edit',['filter'=>$filter,'columns'=>$columns,'column_name'=>'column_name11']);
                            </select>
                        </div>

                </div>
                <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Start Date</label>
                       </div>
                        <div class="col-sm-10 my-1">
                             <input type="date" class="form-control" placeholder="Value" name="column[start_date]">
                        </div>

                </div>
                 <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Start Date</label>
                       </div>
                        <div class="col-sm-10 my-1">
                             <input type="date" class="form-control" placeholder="Value" name="column[end_date]">
                        </div>

                </div>
            </div>
            <div style="display: none" class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">
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
            </div>
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
    $('#home-tab-just').click(function(){
      $('#home-just').show();
      $('#profile-just').hide();
    });
    $('#profile-tab-just').click(function(){
      $('#profile-just').show();
      $('#home-just').hide();
    });
  </script>
@endsection