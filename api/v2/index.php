<?
include("api.php");
require("Toro.php");

class RootHandler {
    function get() {
      echo "chaMPion API v. 2 DB_HOST $DB_HOST";
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
    function get() {
      echo "Hello, world";
    }
}

class getTWFYidHandler {
    function get() {
      echo "Hello, world";
    }
}




Toro::serve(array(
    "/" => "RootHandler",
    "/searchMP/:string" => "searchMPHandler",
    "/queryTheyWorkForYou" => "queryTheyWorkForYouHandler",
    "/getTWFYid" => "getTWFYidHandler",
));
