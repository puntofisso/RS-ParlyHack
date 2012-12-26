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
      header('Access-Control-Allow-Origin: *');
      print searchMP($keywords);
    }
}

class queryTheyWorkForYouHandler {
    function get($id) {
      header('Access-Control-Allow-Origin: *');
      print queryTheyWorkForYou($id);
    }
}

class getTWFYidHandler {
    function get($uid) {
      header('Access-Control-Allow-Origin: *');
      print getTWFYid($uid);
    }
}





Toro::serve(array(
    "/" => "RootHandler",
    "/searchMP/:alpha" => "searchMPHandler",
    "/getTWFYid/:alpha" => "getTWFYidHandler",
    "/queryTheyWorkForYou/:alpha" => "queryTheyWorkForYouHandler",
));
