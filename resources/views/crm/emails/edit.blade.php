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
            <h2>{{$title}} <small>Edit</small></h2>
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
          <div class="x_content">
            <form class="form-horizontal" role="add-emails" method="POST" action="{{url('crm/emails/'.___encrypt($email['id']))}}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$email['id']}}">
              <span class="section">{{$title}} Info</span>
             
                <div class="form-group">
                <label for="email">Title:</label>
                <input type="text" name="title" value="{{$email['title']}}" class="form-control" id="title">
              </div>
              <div class="form-group">
                <label for="email">Description:</label>
                <input type="text" name="alias" value="{{$email['alias']}}" class="form-control" id="alias">
              </div>
              <!-- <div class="form-group">
                <label for="email">Bcc:</label>
                <input type="text" name="title" class="form-control" id="email">
              </div> -->
              <div class="form-group">
                <label for="email">Subject:</label>
                <input type="text" name="subject" value="{{$email['subject']}}" class="form-control" id="subject">
              </div>
              <div class="form-group">
                <label for="email">Message:</label>
                <textarea  name="content" class="form-control" id="content">{{$email['content']}}</textarea>
              </div>
              <!-- <div class="form-group">
                <label for="email">Attachment:</label>
                <input type="file" class="form-control" id="email">
              </div>
              <div class="btn-group">
                  <button type="button" class="btn btn-success">Select Template</button>
                  <button type="button" class="btn btn-success">Save</button>
                  <button type="button" class="btn btn-success">Send</button>
                  <button type="button" class="btn btn-info">Cancel</button>
              </div> -->
               <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 offset-md-3">
                  <a href="{{redirect()->getUrlGenerator()->previous()}}" class="btn btn-primary">Cancel</a>
                  <button  data-request="ajax-submit" data-target='[role="add-emails"]' type="button" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@section('requirejs')
<script type="text/javascript">
    CKEDITOR.replace( 'content' ); 
</script>
@endsection