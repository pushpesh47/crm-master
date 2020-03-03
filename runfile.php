<?php
$URL='http://localhost/crm/facebook-leads';
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,$URL);
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);
echo $buffer;
?>