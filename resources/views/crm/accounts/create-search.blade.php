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
    
      <form>

        <!------------Details--->
        <h2>Details</h2>
            <div class="form-row">
              <div class="col-sm-4 my-1">
                <input type="text" class="form-control" placeholder="Value" name="value">
              </div>
               <div class="col-sm-2 my-1">
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                  <label class="custom-control-label" for="customControlAutosizing">Set as Default</label>
                </div>
              </div>
               <div class="col-sm-2 my-1">
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                  <label class="custom-control-label" for="customControlAutosizing">List in Matrix</label>
                </div>
              </div>
               <div class="col-auto my-1">
                <div class="custom-control custom-checkbox mr-sm-2">
                  <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                  <label class="custom-control-label" for="customControlAutosizing">Set as public</label>
                </div>
              </div>
            </div>
               <!------------Column Details--->
             <h2>Choose columns</h2>
            <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>Customer Name...</option>
                    <option>...</option>
                  </select>
              </div>
                <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>Sales Agent...</option>
                    <option>...</option>
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None...</option>
                    <option>...</option>
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None...</option>
                    <option>...</option>
                  </select>
              </div>
            </div>


             <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None...</option>
                    <option>...</option>
                  </select>
              </div>
                <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None..</option>
                    <option>...</option>
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None...</option>
                    <option>...</option>
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None...</option>
                    <option>...</option>
                  </select>
              </div>
            </div>

              <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None...</option>
                    <option>...</option>
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
                            <select id="inputState" class="form-control option">
                              <option selected>None...</option>
                              <option>...</option>
                            </select>
                        </div>

                </div>
                <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Select a Column</label>
                       </div>
                        <div class="col-sm-10 my-1">
                            <select id="inputState" class="form-control option">
                              <option selected>None...</option>
                              <option>...</option>
                            </select>
                        </div>

                </div>
                <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Start Date</label>
                       </div>
                        <div class="col-sm-10 my-1">
                             <input type="date" class="form-control" placeholder="Value" name="value">
                        </div>

                </div>
                 <div class="form-row">
                        <div class="col-sm-2 my-1">
                            <label>Start Date</label>
                       </div>
                        <div class="col-sm-10 my-1">
                             <input type="date" class="form-control" placeholder="Value" name="value">
                        </div>

                </div>
            </div>
            <div class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">
               <h2 class="heading">Advance Search</h2>
                <div class="form-row pull-right"> 
                    <button class="btn btn-info btn-sm">New Group</button> 
                </div> 
                <br/><br/>
              
                    <div class="form-row">
              <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None...</option>
                    <option>...</option>
                  </select>
              </div>
                <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None..</option>
                    <option>...</option>
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <select id="inputState" class="form-control option">
                    <option selected>None...</option>
                    <option>...</option>
                  </select>
              </div>
               <div class="col-sm-3 my-1">
                  <input type="search" class="form-control" placeholder="search" name="value">
              </div>
            </div>
               
            </div>
          </div>
          </div>
            <div class="form-row">
                 <div class="col-sm-2 my-1"></div>
                <div class="col-sm-1 my-1">
                  <button class="btn btn-success">Save</button>
                </div>
                <div class="col-sm-3 my-1">
                  <button class="btn btn-primary">Cancle</button>
                </div>
            </div>

      </form>
  </div>
</div>

