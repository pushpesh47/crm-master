<div class="x_content">
  <form action="{{url('crm/emails/sent')}}" role="sent-emails" method="POST">
    {{csrf_field()}}
    <div class="form-group">
      <label for="email">To:</label>
      <select class="form-control" name="email_to[]" multiple="multiple">
        @if(!empty($account))
          @foreach($account as $acc)
            <option value="{{$acc['email']}}" @if(in_array($acc['id'],$user_id)) selected="" @endif>{{$acc['email']}}</option>
          @endforeach
        @endif
      </select>
    </div>
    <div class="form-group">
      <label for="email">Cc:</label>
      <input type="text" class="form-control" id="email" name="email_to[]">
    </div>
    <div class="form-group">
      <label for="email">Bcc:</label>
      <input type="text" class="form-control" id="email" name="email_to[]">
    </div>
    <div class="form-group">
      <label for="email">Subject:</label>
      <input type="text" class="form-control" id="subject" name="subject">
    </div>
   
    <div class="form-group">
      <label for="email">Attachment:</label>
      <input type="file" class="form-control" id="email" name="attachment">
    </div>
    <div class="form-group">
      <label for="email">Select template:</label>
      <select class="form-control" name="template" id="template">
        <option value="">Choose Template</option>
        @if(!empty($template))
          @foreach($template as $temp)
            <option value="{{$temp['id']}}">{{$temp['title']}}</option>
          @endforeach
        @endif
      </select>
    </div>
    <div class="form-group">
      <label for="email">Message:</label>
      <textarea  class="form-control" id="message" rows="20" name="message"></textarea>
    </div>
    <div class="btn-group">
        <button type="button" name="save" class="btn btn-warning" value="save" data-request="ajax-submit" data-target='[role="sent-emails"]'>Save</button>
        <button type="button" name="send" class="btn btn-success" value="send" data-request="ajax-submit" data-target='[role="sent-emails"]'>Send</button>
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