<?php
include 'converter.php';
$PROXY_HOST = "host";
$PROXY_PORT = "port";   
$PROXY_USER = "userid";  
$PROXY_PASS = "password";  
$auth = base64_encode("$PROXY_USER:$PROXY_PASS");
stream_context_set_default(
 array(
  'http' => array(
   'proxy' => "tcp://$PROXY_HOST:$PROXY_PORT",
   'request_fulluri' => true,
   'header' => "Proxy-Authorization: Basic $auth"
  )
 )
);

	$json_string = file_get_contents("http://api.fixer.io/latest?base=USD");
	$parsed_string = json_decode($json_string, true);
	$str = file_get_contents('currencies.json');
	$json = json_decode($str, true);
	foreach($json as $key=>$value)
	{
		$name = $value['Name'];
		if($name != 'USD')
		{
		$json[$key]['Rate'] = $parsed_string['rates'][$name];
		}
	}
	$new_json = json_encode($json);
	file_put_contents('currencies.json', $new_json);
	conversion();
?>
