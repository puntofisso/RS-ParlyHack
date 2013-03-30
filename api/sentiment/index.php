<?php
include 'sentiment.class.php';

$sentiment = new Sentiment();

$sentence = $_POST['sentence'];
$scores = $sentiment->score($sentence);


$ex['pos'] = $scores["pos"];
$ex['neg'] = $scores["neg"];
$ex['neu'] = $scores["neu"];


print json_encode($ex);

?>
