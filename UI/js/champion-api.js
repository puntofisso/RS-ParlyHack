// Global variables
var SERVER = "http://172.16.132.179:8888"
var URL_GET_MP_DATA = SERVER + "/api/api.php?api=getMPinfo";
var URL_GET_SEARCH = SERVER + "/api/api.php?api=searchMP";

/**
 * Generates the appropriate search URL.
 * interests: an Array of strings
 **/
function generate_search_URL(interests) {
    var url = URL_GET_SEARCH + "&keywords=" + interests.join(",");
    console.log(url);
    return url;
}

/**
 * Generates the appropriate MP details URL.
 **/
function generate_MP_details_URL(id) {
    var url = URL_GET_MP_DATA + "&uid=" + id;
    console.log(url);
    return url;
}

/**
 * Generates a few dummy search results to help test your UI.
 **/
function getDummySearchResults() {
    var res = new Array();
    
    res[0] = new Object();
    res[0].score = 90;
    res[0].name = "Rumpold";
    res[0].uid = '40185';
    
    res[1] = new Object();
    res[1].score = 75;
    res[1].name = "Winnie the Pooh";
    res[1].uid = '40185';
    
    res[2] = new Object();
    res[2].score = 45;
    res[2].name = "Thomas the Tank Engine";
    res[2].uid = '40185';
    
    return res;
}

/**
 * Dumps results to the console.
 * results: probably JSON, can be anything.
 **/
function dumpResults(results) {
    console.log(results);
}
