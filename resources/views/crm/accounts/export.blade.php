<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<center><h1>Account</h1></center>
<table>
  <thead>
    <tr>
      <th>Customer no</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Lead Source</th>
      <th>Date Of Inury</th>
      <th>Account Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($account as $accounts)
      <tr>
        <td>{{ $accounts['customer_number'] }}</td>
        <td>{{ $accounts['first_name'].' '.$accounts['last_name']}}</td>
        <td>{{ $accounts['email'] }}</td>
        <td>{{ $accounts['mobile'] }}</td>
        <td>{{ $accounts['lead_source'] }}</td>
        <td>{{ $accounts['date_of_injury'] }}</td>
        <td>{{ ucfirst($accounts['account_status']) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
</body>
</html>