<?php
//$postcode = urldecode($_GET['postcode']);
//exec("python api.py \"$postcode\"", $output, $ret_code);
//json_decode($output);
//print_r(implode("\n",$output));

$apicall=$_GET['api'];
$keywords=$_GET['keywords'];


if ($apicall=="getMP") 
	$ret = searchMP($keywords);


print $ret;

function searchMP($keys) {

	$a = array();
	for ($i = 0; $i < 5; $i++) {
		$a[$i]["id"] = "test";
		$a[$i]["name"] = "test";
		$a[$i]["keywords"] = array();
                for ($j = 0; $j < 10; $j ++) {
			$a[$i]["keywords"][$j]["keyword"+$j] = $j;
		}
	}
	return json_encode($a);

}

function MPstats($id) {

}

function MPwordcloud($id) {

}

function MPinfo($id) {

}

?>
