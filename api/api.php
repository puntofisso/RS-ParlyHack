<?php
//$postcode = urldecode($_GET['postcode']);
//exec("python api.py \"$postcode\"", $output, $ret_code);
//json_decode($output);
//print_r(implode("\n",$output));

$apicall=$_GET['api'];
$keywords=$_GET['keywords'];
$id = $_GET['uid'];


if ($apicall=="searchMP") 
	$ret = searchMP($keywords);
if ($apicall=="getMPinfo")
        $ret = queryTheyWorkForYou($id);
if ($apicall=="getTWFYid") 
	$ret = getTWFYid($id);

header('Access-Control-Allow-Origin: *');
print $ret;

function searchMP($keys) {


	$keysARR = explode(",", $keys);

	$a = array();

	foreach ($keysARR as $thiskey) {
		$query = "SELECT name, id, keyword, sum(x) as summy, total, sum(x)/total*100 AS ratio from Keywords WHERE keyword='". $thiskey . "' group by keyword, name ORDER by ratio LIMIT 0,20";
		$result = mySQLquery($query);

		while($row = mysql_fetch_assoc( $result )) {
         		$name = $row['name'];
               	 	$keyword = $row['keyword'];
               		$ratio = $row['ratio'];
			$id = $row['id'];
			$a[$name][$keyword] = $ratio;
			$idarr = explode("/",$id);
			$a[$name]["id"] = end($idarr);
        	}	
	}

	return json_encode($a);

}


function queryTheyWorkForYou($id) {
        // create curl resource 
        $ch = curl_init(); 

	// get TWFYinfo
	$pid =  getTWFYid($id);

        // set url 
	//$query = "http://www.theyworkforyou.com/api/getMP?id=".$pid."&key=CPmndLARaZ76DJLwuiB7ZqQ7";
        curl_setopt($ch, CURLOPT_URL, "http://www.theyworkforyou.com/api/getMP?id=$pid&key=CPmndLARaZ76DJLwuiB7ZqQ7"); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);  
	$arr = json_decode($output,true);

	$myout = array();

	foreach ($arr as $entry) {
		if (strstr($entry["left_house"],"9999")) {
			$myout["lastname"] = $entry["last_name"];
			$myout["firstname"] = $entry["first_name"];
			$myout["constituency"] = $entry["constituency"];
			$myout["TWFYimage"] = $entry["image"];
			$myout["TWFYid"] = $pid;
			$myout["enteredhouse"] = $entry["entered_house"];
			//$myout[""] = $entry[""];
		}
	}

	return json_encode($myout);

	
}

function getTWFYid($uid) {
	$query = "SELECT NAME, MEMBER_ID, PERSON_ID from MPs WHERE MEMBER_ID=" . $uid;
	$result = mySQLquery($query);
	
	while($row = mysql_fetch_assoc( $result )) {
		$name = $row['NAME'];
		$member_id = $row['MEMBER_ID'];
		$person_id = $row['PERSON_ID'];
		// This is very Dirty, but we only need one and there should only be one
		return $person_id;
	}
}

function mySQLquery($query) {
mysql_connect("localhost", "rewired", "rewired") or die(mysql_error());
mysql_select_db("RS-ParlyHack") or die(mysql_error());

$result = mysql_query("$query") or die(mysql_error());  

// keeps getting the next row until there are no more to get
#while($row = mysql_fetch_array( $result )) {
#	// Print out the contents of each row into a table
#}
return $result; 
}

?>
