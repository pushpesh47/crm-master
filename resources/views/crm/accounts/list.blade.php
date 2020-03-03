<style type="text/css">
  #demo p
  {
    font-weight: 700;
    line-height: 20px;
  }
  #demo
  {
    box-shadow: 2px 2px 5px grey;
    width: 100%;
  }
  #demo input
  {
    line-height: 30px;
  }
  #demo i
  {
    color:red;
    font-size:30px;
  }
  .btn-new
  {
    background-color:green;
    color:white;
    margin-left:10px;

  }
  .btn-search
  {
   background-color:#17a2b8;
    color:white;
  }

</style>
<div class="right_col" >
  <div class="container-fluid">
      @if(\Auth::user()->user_type=='admin')
    <div class="row">
        <button data-toggle="collapse" data-target="#demo" class="btn btn-success">Go To Advance Search</button>
    </div>
    <div class="row">
      <div id="demo" class="collapse">
         <div class="container-fluid">
              <p>Advance Search</p>
         </div>
         <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <!-- <button class="btn btn-primary btn-sm">New Group</button> -->
            </div>
         
         </div>
         <div class="container-fluid">
           <form class="form-row" method="POST" action="{{url('crm/accounts/advance_search_filter')}}">
             <div class="form-group col-md-3">
               <select id="inputState" id="advance_search" name="filter[advance_search][]" class="form-control advance_search">
                     @includeif('crm.accounts._common_field_list_filter');
                  </select>
             </div>
             {{csrf_field()}}
             <div class="form-group col-md-3">
               <select id="inputState" class="form-control advance_operator" name="filter[advance_operator][]">
                    <option value="">None...</option>
                    <option value="=">Equal</option>
                    <option value="!=">Not Equal To</option>
                    <option value="start_with">Start With</option>
                    <option value="end_with">End With</option>
                    <option value="contains">Contains</option>
                    <option value="does_not_contains">Does Not Contains</option>
                </select>
             </div>
            
             <div class="form-group col-md-2">
               <input type="text" name="filter[search_text][]" id="search_text" placeholder="Enter" class="form-control search_text">
             </div>
             <div class="form-group col-md-2">
                <!-- <a href="javascript:void(0);" data-target="#advanceSearch" data-request="remove"><i class="fa fa-trash" ></i></a> -->
             </div>
            <div class="form-group col-md-2">
               <select id="inputState" id="condition" class="form-control condition" name="filter[condition][]">
                    <option value="AND">AND</option>
                    <option value="OR">OR</option>
                </select>
             </div>
             <div class="row" id="advanceSearch">
             </div>
              <div class="container-fluid">
                <button type="button" data-url="{{url('crm/accounts/advance_search')}}" data-request="add-another" data-id="assign" data-count="0" data-target="#advanceSearch" class="btn-new">New Condition</button>
              </div>
               <div class="container-fluid">
                <div class="col-md-5"></div>
                <div class="col-md-6">
                  <button type="button"  class="btn-search buttons-reload">Search Now</button>
                </div>
              </div>
           </form>
         </div>
      </div>
    </div>
    @endif
  <div class="row filter">
    @if(\Auth::user()->user_type=='admin')
    <div class="col-md-12 col-sm-12 col-xs-12">
      <p>
        <input type="hidden" title="Calendar" id="datepicker" />
        <input  type="hidden" id="input_starttime" class="timepicker">
      </p>
      <form method="get" action="{{url('crm/accounts')}}">
        <div class="col-sm-3">
          <input type="text" id="search" value="{{$search}}" placeholder="Search..." name="search" class="form-control search" >
        </div>
        <div class="col-sm-3">
          <select name="search_column" id="search_column" class="form-control search_column">
            @if(!empty($viewColumn))
              @foreach($viewColumn as $viewCol)

                <option @if($search_column==$viewCol['meta_value']) selected="" @endif value="{{$viewCol['meta_value']}}">{{$viewCol['meta_name']}}</option>
              @endforeach
            @else
              <option @if($search_column=='name') selected="" @endif value="name">Customer name</option>
              <option @if($search_column=='email') selected="" @endif value="email">Email</option>
              <option @if($search_column=='customer_number') selected="" @endif value="customer_number">Customer No</option>
              <option @if($search_column=='mobile') selected="" @endif value="mobile">Mobile Number</option>
              <option @if($search_column=='status') selected="" @endif value="status">Status</option>
            @endif
          </select>
          @if(!empty($_REQUEST['filters']))
            <input type="hidden" name="filters" value="{{$_REQUEST['filters']}}">
            <input type="hidden" name="module" value="{{$_REQUEST['module']}}">
          @endif
        </div>
        <div class="col-sm-3">
          <button type="button"id="standardSearch" class="btn btn-success standardSearch">Search</button>
        </div>
        <div class="col-sm-3">
        </div>
      </form>
    </div>
   
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-sm-4">
            <form >
               <div class="form-group row">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Filter:</label>
                  <div class="col-sm-10">
                    <select  data-url="{{url('crm/accounts')}}" data-target="#filterAction"  data-id="as" data-type="accounts" data-request="ajax-get-form-change" class="form-control" name="filters" id="filters">
                      <option value="all">All</option>
                      @if(!empty($filter))
                        @foreach($filter as $filters)
                          @if(!empty($_REQUEST['filters']))
                            <option  @if($_REQUEST['filters']==___encrypt($filters['id'])) selected="" @endif value="{{___encrypt($filters['id'])}}">{{$filters['view_name']}}</option>
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
                    @if(!empty($_REQUEST['filters']) && $_REQUEST['filters']!='all')
                      <li><a href="{{url('crm/filter/'.$_REQUEST['filters'].'/edit')}}">Edit |</a></li>
                      <li><a href="{{url('crm/filter/'.$_REQUEST['filters'].'/delete')}}">Delete</a></li>
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
     @endif
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        @if(\Auth::user()->user_type=='admin')
        <div class="x_title">
          <a href="javascript:void(0);"  data-url="{{url('crm/accounts/bulk-delete')}}" data-ask_image="{{url('assets/images/active-user.png')}}" data-ask="Are you sure you want to delete?" data-request="ajax-confirm" data-id="bulk-delete"  class="btn btn-danger">Delete</a>
          <a href="{{url('crm/accounts/create')}}" type="button" class="btn btn-info">Add New Acccount</a>
           <a href="javascript:void(0);" id="pdf"  data-url="{{url('crm/accounts/pdf')}}" data-request="ajax-get-form" data-id="export" data-target="#section-mail" class="btn btn-success">PDF Export</a>
           <a href="javascript:void(0);" id="mailer-export"  data-url="{{url('crm/accounts/mailer-export')}}" data-request="ajax-get-form" data-id="mail-export" data-target="#section-mail" class="btn btn-success">Mailer Export</a>
           <button  id="mailChecked" data-url="{{url('crm/accounts/mail-sent')}}" data-request="ajax-get-form" data-id="mail" data-target="#section-mail" class="btn btn-warning">Mail</button>

           <button  id="mailChecked" data-url="{{url('crm/accounts/assign-to-client')}}" data-request="ajax-get-form" data-id="assign" data-target="#section-mail" class="btn btn-success">Assign To Client</button>

           <a href="{{url('crm/accounts/import')}}"  class="btn btn-primary">Import</a>
           <a href="" class="btn btn-info">Back</a>
          
        </div>
        @endif
        <div class="x_content" id="section-mail">
         
          <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
            {!! $html->table() !!}
          </table>
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
 

   $(".standardSearch").click(function(e){
        window.LaravelDataTables["dataTableBuilder"].draw();
    });

    $('#dataTableBuilder').on('preXhr.dt', function ( e, settings, data ) {
        $('.search').each(function () {
            data[$(this).prop('name')] = $(this).val();
             //console.log(data[$(advance_searcadvance_searc).prop('name')]);
        });
        $('.search_column').each(function () {
            data[$(this).prop('name')] = $(this).val();
        });

        
    });
  
    $(".buttons-reload").click(function(e){
        window.LaravelDataTables["dataTableBuilder"].draw();
    });

    $('#dataTableBuilder').on('preXhr.dt', function ( e, settings, data ) {
        console.log(data);
        var i= 0;
        var j=0;
        var k=0;
        var c=0;

        $('.advance_search').each(function () {
            console.log('hdwj'+$(this).val());
            var a = $(this).prop('name');
            data[a.substring(0,a.length-2)+'['+i+']'] = $(this).val();
            i++;
             //console.log(data[$(advance_searcadvance_searc).prop('name')]);
        });
        $('.advance_operator').each(function () {
            var b = $(this).prop('name');
            data[b.substring(0,b.length-2)+'['+j+']']= $(this).val();
            j++;
        });

        $('.condition').each(function () {
            var c = $(this).prop('name');
            data[c.substring(0,c.length-2)+'['+k+']'] = $(this).val();
            k++;
        });
        $('.search_text').each(function () {
            var d = $(this).prop('name');
            data[d.substring(0,d.length-2)+'['+c+']'] = $(this).val();
            c++;
        });
    });
//});


</script>
@endsection