<?php
//$postcode = urldecode($_GET['postcode']);
//exec("python api.py \"$postcode\"", $output, $ret_code);
//json_decode($output);
//print_r(implode("\n",$output));

$apicall=$_GET['api'];
$keywords=$_GET['keywords'];
$id = $_GET['uid'];

if ($apicall=="getMP") 
	$ret = searchMP($keywords);
if ($apicall=="getMPinfo")
        $ret = queryTheyWorkForYou($id);


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

function queryTheyWorkForYou($id) {
        // create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "http://www.theyworkforyou.com/api/getMP?person_id=1567&key=CPmndLARaZ76DJLwuiB7ZqQ7"); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
	
        // close curl resource to free up system resources 
        curl_close($ch);  

	return $output;
}

function getTWFYid($uid) {

}

function mySQL()

?>
