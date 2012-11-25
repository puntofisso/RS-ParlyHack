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
		$query = "SELECT name, id, x, keyword, sum(x) as summy, total, sum(x)/total*100 AS ratio from Keywords WHERE keyword='". $thiskey . "' group by keyword, name ORDER by x desc LIMIT 0,20";
		$result = mySQLquery($query);

		while($row = mysql_fetch_assoc( $result )) {
         		$name = $row['name'];
               	 	$keyword = $row['keyword'];
 			$value = $row['x'];
               		$ratio = $row['ratio'];
			$id = $row['id'];
			$a[$name][$keyword] = $ratio;
			$idarr = explode("/",$id);
			$a[$name]["id"] = end($idarr);
			$a[$name][$keyword] = $value;
			//$a[$name]["value"] = $value;
        	}	
	}

	return json_encode($a);

}


function queryTheyWorkForYou($id) {
	$myout = array();

	// get TWFYinfo
	$pid =  getTWFYid($id);

        // They Work for You main info
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "http://www.theyworkforyou.com/api/getMP?id=$pid&key=CPmndLARaZ76DJLwuiB7ZqQ7"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);  
	$arr = json_decode($output,true);

	// They Work for you extended info
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://www.theyworkforyou.com/api/getMPinfo?id=$pid&key=CPmndLARaZ76DJLwuiB7ZqQ7");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch); 
        $arr_ext = json_decode($output,true);


	foreach ($arr as $entry) {
		if (strstr($entry["left_house"],"9999")) {
			$myout["lastname"] = $entry["last_name"];
			$myout["firstname"] = $entry["first_name"];
			$constituency = $entry["constituency"];
			$myout["constituency"] = $entry["constituency"];
			$myout["TWFYimage"] = $entry["image"];
			$myout["TWFYid"] = $pid;
			$myout["enteredhouse"] = $entry["entered_house"];
			//$myout[""] = $entry[""];
		}
	}


	$query = "SELECT name, id, keyword, x from Keywords WHERE id='uk.org.publicwhip/member/" . $id . "' ORDER by x desc LIMIT 0,50";
	$result = mySQLquery($query);
	
	$keywords = array();
	while($row = mysql_fetch_assoc( $result )) {
                $key = $row['keyword'];
                $value = $row['x'];
		$keywords[$key] = $value;
        }

	$myout['depts'] = $arr_ext["wrans_departments"];
	$myout['subjects'] = $arr_ext["wrans_subjects"];
	$myout['expenses2009'] = $arr_ext["expenses2009_total"];
	$myout['keywords'] = $keywords;
	

	$query = "SELECT w.ConstituencyName as constituency, u.ConstRate as unemploymentrate, u.ConstNumber as unemploymentnumber, w.MedianWageConst as medianweeklywage from Wages w, Unemployment u where w.ConstituencyName = u.ConstituencyName and u.ConstituencyName='" . $constituency ."'";
	$result = mySQLquery($query);
	while ($row = mysql_fetch_assoc ( $result )) {
		$myout['unemploymentrate'] = $row['unemploymentrate'];
		$myout['unemploymentnumber'] = $row['unemploymentnumber'];
		$myout['medianweeklywage'] = $row['medianweeklywage'];
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
