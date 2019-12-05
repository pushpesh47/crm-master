<div class="right_col" role="main">
        <div class="">
  <div class="page-title">
    <!-- <div class="title_left">
      <h6>Search</h6>
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Simple collapsible</button>
      <div id="demo" class="collapse">
        Lorem ipsum dolor text....      Lorem ipsum dolor text.... Lorem ipsum dolor text.... Lorem ipsum dolor text.... Lorem ipsum dolor text....
        Lorem ipsum dolor text....
        Lorem ipsum dolor text....
        Lorem ipsum dolor text....
      </div>
    </div> -->
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
<div class="row filter">
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-sm-2">
  </div>
  <div class="col-sm-4">
    <input type="text" placeholder="Search..." name="search" class="form-control" >
  </div>
  <div class="col-sm-4">
    <select name="search_column" class="form-control">
      @if(!empty($viewColumn))
        @foreach($viewColumn as $viewCol)
          <option value="{{$viewCol['meta_value']}}">{{$viewCol['meta_name']}}</option>
        @endforeach
      @endif
      <option value="">customer name</option>
    </select>
  </div>
  <div class="col-sm-2">
  </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-sm-4">
        <form >
           <div class="form-group row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Filter:</label>
              <div class="col-sm-10">
                <select  data-url="{{url('crm/accounts')}}" data-target="#filterAction"  data-id="as" data-type="accounts" data-request="ajax-get-form-change" class="form-control" name="filter" id="filter">
                  <option value="all">All</option>
                 
                @if(!empty($filter))
                  @foreach($filter as $filters)
                  @if(!empty($_REQUEST['filter']))
                    <option  @if($_REQUEST['filter']==___encrypt($filters['id'])) selected="" @endif value="{{___encrypt($filters['id'])}}">{{$filters['view_name']}}</option>
                  @else
                    <option value="{{___encrypt($filters['id'])}}">{{$filters['view_name']}}</option>
                  @endif
                  @endforeach
                @endif
              </select>
              </div>
            </div>
        </form>
    </div>
    <div id="filterAction">
      <div class="col-sm-4">
       <div class="form-group row">
            <ul>
                <li><a href="{{url('crm/filter/create')}}">Create |</a></li>
                @if(!empty($_REQUEST['filter']) && $_REQUEST['filter']!='all')
                  <li><a href="{{url('crm/filter/'.$_REQUEST['filter'].'/edit')}}">Edit |</a></li>
                  <li><a href="{{url('crm/filter/'.$_REQUEST['filter'].'/delete')}}">Delete</a></li>
                @else
                  <li><a href="javascript:void(0)">Edit |</a></li>
                  <li><a href="javascript:void(0)">Delete</a></li>
                @endif
            </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-4"></div>
</div>
</div>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <a href="javascript:void(0);"  data-url="{{url('crm/accounts/bulk-delete')}}" data-ask_image="{{url('assets/images/active-user.png')}}" data-ask="Are you sure you want to delete?" data-request="ajax-confirm" data-id="bulk-delete"  class="btn btn-danger">Delete</a>
        <a href="{{url('crm/accounts/create')}}" type="button" class="btn btn-info">Add New Acccount</a>
         <a href="javascript:void(0);" id="pdf"  data-url="{{url('crm/accounts/pdf')}}" data-request="ajax-get-form" data-id="export" data-target="#section-mail" class="btn btn-success">PDF Export</a>
         <a href="javascript:void(0);" id="mailer-export"  data-url="{{url('crm/accounts/mailer-export')}}" data-request="ajax-get-form" data-id="mail-export" data-target="#section-mail" class="btn btn-success">Mailer Export</a>
         <button   id="mailChecked" data-url="{{url('crm/accounts/mail-sent')}}" data-request="ajax-get-form" data-id="mail" data-target="#section-mail" class="btn btn-warning">Mail</button>
         <a href="" class="btn btn-info">Cancel</a>
        
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
      <div class="x_content" id="section-mail">
       
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
<script type="text/javascript">

  $("#checkedAll").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });

  $('.checkSingle').click(function() {
    if ($('.checkSingle:checked').length == $('.checkSingle').length) {
      $('#checkedAll').prop('checked', true);
    } else {
      $('#checkedAll').prop('checked', false);
    }
  });
  
</script>
@endsection