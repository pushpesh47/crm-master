<div class="x_content">
  <form action="{{url('crm/accounts/pdf-export')}}"  method="POST">
    {{csrf_field()}}
    <div class="form-group">
      <label for="email">PDF EXPORT TO:</label>
      <input type="email" name="email" class="form-control"  required="">
    </div>
    <div class="form-group">
      <label for="email">User Name:</label>
      <input type="text" name="name" class="form-control" required="">
    </div>
    <div class="form-group">
      <label for="email">PDF MAKER EXPORT:</label>
      <select class="form-control" name="export_formate" required="" >
          <option value="">SELECT PDF MAKER EXPORT</option>
          <option value="dsad">Lead Export</option>
          <option value="">Lead Information</option>
          <option value="">Correct Lead Sheet</option>
      </select>
    </div>
    @if(!empty($account))
      @foreach($account as $acc)
        <input type="hidden" name="accounts[]" value="{{$acc['id']}}">
      @endforeach
    @endif
    <div class="btn-group">
        <button type="submit" name="export" class="btn btn-warning" value="save" >Export</button>
        
        <a href="{{redirect()->getUrlGenerator()->previous()}}" class="btn btn-info">Cancel</a>
    </div>
    
  </form>
</div>
<script type="text/javascript">
  $("#template").change(function(){
    var id = $("#template").val();
      $.ajax({
        url: '{{url('crm/accounts/get-mail-template')}}',
        type: 'POST',
        data: { id : id },
        success: function(output){
          $('#subject').val(output.subject);
          $('#message').val(output.message);
        }
      });
  });
  
</script>
