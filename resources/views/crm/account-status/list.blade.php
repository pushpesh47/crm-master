<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
               {{$title}}
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <a href="{{url('crm/account-status/create')}}" type="button" class="btn btn-info">Add New {{$create_title}}</a>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
       
        <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
          {!! $html->table() !!}
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@section('requirejs')
{!! $html->scripts()!!}
@endsection