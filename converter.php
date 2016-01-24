<?php
	function conversion(){
	$str = file_get_contents('currencies.json');
	$json = json_decode($str, true);
	$input = $_GET['input'];
	$output = $_GET['output'];
	$ivalue = $_GET['value'];
	$irate = 0;
	$orate = 0;
	foreach($json as $key => $value)
	{
		if($value['Name'] == $input)
		{
			$irate = $value['Rate'];	
		}
		else if($value['Name'] == $output)
		{
			$orate = $value['Rate'];	
		}
	}
	$ans = ($orate/$irate)*$ivalue;
	echo $ans; 
	}
?>
