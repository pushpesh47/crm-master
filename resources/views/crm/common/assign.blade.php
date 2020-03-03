<div class="x_content">
  <form action="{{url('crm/accounts/assign/client')}}" role="sent-emails" method="POST">
    {{csrf_field()}}
    <div class="form-group">
      <label for="email">Assign To Client:</label>
      <select class="form-control" name="assign_email[]" multiple="multiple">
        @if(!empty($user))
          @foreach($user as $users)
            <option value="{{$users['id']}}" >{{$users['email']}}</option>
          @endforeach
        @endif
      </select>
    </div>
    <div class="container">
      <table class="table">

        <tr>
          <th>Customer Name</th>
          <th>Customer Number</th>
          <th>email</th>
          <th>Mobile</th>
        </tr>
        @if(!empty($account))
            @foreach($account as $acc)
          <tr>
            <input type="hidden" name="assign_id[]" value="{{$acc['id']}}">
            <input type="hidden" name="module_type" value="accounts">
            <td>{{$acc['name']}}</td>
            <td>{{$acc['customer_number']}}</td>
            <td>{{$acc['email']}}</td>
            <td>{{$acc['mobile']}}</td>
          </tr>
        @endforeach
      @endif
      </table>
    </div>
    <div class="btn-group">
        <!-- <button type="button" name="save" class="btn btn-warning" value="save" data-request="ajax-submit" data-target='[role="sent-emails"]'>Save</button> -->
        <button type="button" name="send" class="btn btn-success" value="send" data-request="ajax-submit" data-target='[role="sent-emails"]'>Assign</button>
        <a href="{{redirect()->getUrlGenerator()->previous()}}" class="btn btn-info">Cancel</a>
    </div>
    
    
  </form>
</div>
<script type="text/javascript">
    $("#template").change(function(){
      var id = $("#template").val();
     // var data = CKEDITOR.instances.message.getData();
        $.ajax({
          url: '{{url('crm/accounts/get-mail-template')}}',
          type: 'POST',
          data: { id : id },
          success: function(output){
            $('#subject').val(output.subject);
           // $('#message').val(output.message);
            CKEDITOR.instances.message.setData(output.message);

          }
        });
    });
   
    $('select').select2({
        createTag: function (params) {
            var term = $.trim(params.term);
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            }
        }
    });
  CKEDITOR.replace( 'message' ); 
</script>