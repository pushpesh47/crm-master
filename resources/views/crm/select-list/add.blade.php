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
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form class="form-horizontal" role="add-account-status" method="POST" action="{{url('crm/select/'.$title)}}">
             
              <span class="section">{{$title}}</span>
              <div class="col-md-12 col-sm-12">
               
                <div class="item form-group">
                  <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <input  class="form-control" name="name" placeholder="Enter Name"  type="text">
                    <input  class="form-control" name="type" value="{{$title}}" type="hidden">
                  </div>
                </div>
                
              </div>
              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 offset-md-3">
                  <a href="{{redirect()->getUrlGenerator()->previous()}}" class="btn btn-primary">Cancel</a>
                  <button  data-request="ajax-submit" data-target='[role="add-account-status"]' type="button" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>