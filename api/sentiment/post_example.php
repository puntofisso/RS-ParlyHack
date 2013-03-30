<?php
$val = "The weatehr is amazing";
$url = 'http://championtest.puntofisso.net/api/sentiment/';
$data = array('sentence' => $val);

// use key 'http' even if you send the request to https://...
$options = array('http' => array('method'  => 'POST','content' => http_build_query($data)));
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);


print $result;



?>
