<?
include("api.php");
require("Toro.php");

class RootHandler {
    function get() {
      echo "chaMPion API v. 2";
    }
}


// $keywords = comma-separated list of keywords
class searchMPHandler {
    function get($keywords) {
      //header('Access-Control-Allow-Origin: *');
      print searchMP($keywords);
    }
}

class queryTheyWorkForYouHandler {
    function get($id) {
      //header('Access-Control-Allow-Origin: *');
      print queryTheyWorkForYou($id);
    }
}

class getTWFYidHandler {
    function get($uid) {
      //header('Access-Control-Allow-Origin: *');
      print getTWFYid($uid);
    }
}

class getAllUniqueKeywordsHandler {
    function get($seed) {
      //header('Access-Control-Allow-Origin: *');
      //print $seed;
      print getAllUniqueKeywords($seed);
    }
}

class getMPKeywords {
function get($seed) {
      //header('Access-Control-Allow-Origin: *');
       $ex=explode("-",$seed);
      print getMPKeyword($ex[0],$ex[1]);
    }
}

Toro::serve(array(
    "/" => "RootHandler",
    "/searchMP/:alpha" => "searchMPHandler",
    "/getTWFYid/:alpha" => "getTWFYidHandler",
    "/queryTheyWorkForYou/:alpha" => "queryTheyWorkForYouHandler",
    "/getAllUniqueKeywords/:alpha" => "getAllUniqueKeywordsHandler",
    "/getMPKeywords/:alpha" => "getMPKeywords",
));
