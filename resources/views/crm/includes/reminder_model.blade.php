  @php
    $date = new DateTime;
    $date->modify('-10 minutes');
    $formatted_time = $date->format('H:i');
    $formatted_date = $date->format('Y-m-d');
    $val = _arefy(\App\Models\Account::where('call_back_time','>=',$formatted_time)->where('call_back_date','=',$formatted_date)->get());
  @endphp
  @if(!empty($val))
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Call Reminder</h4>
      </div>
      <div class="modal-body">
        <table style="width:100%">
          <tr>
            <th>Customer Name</th>
            <th>Mobile</th>
            <th>Call Back Date and time</th>
          </tr>
           @foreach($val as $account)
              <tr>
                <td><a href="{{url('crm/accounts/'.___encrypt($account['id']))}}">{{$account['name']}}</a></td>
                <td>{{$account['mobile']}}</td>
                <td>{{$account['call_back_date']}},{{$account['call_back_time']}}</td>
              </tr>
              <tr>
            @endforeach
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endif