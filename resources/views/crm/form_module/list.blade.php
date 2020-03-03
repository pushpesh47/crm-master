<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
             
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
        <a href="{{url('crm/form-module/create')}}" type="button" class="btn btn-info">Add New Form Field</a>
       
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        {{-- <p class="text-muted font-13 m-b-30">
          DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
        </p> --}}
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