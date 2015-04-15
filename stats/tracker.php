<?php
define("API_KEY","");
define("HTTP_SERVER_HOST","localhost");
define("DB_HOST",HTTP_SERVER_HOST);
define("DB_NAME", "admin");
define("DB_USER", "root");
define("DB_PASS", "");
function is_bot(){
	$botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
		"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
		"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
		"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
		"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
		"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
		"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
		"Butterfly","Twitturls","Me.dium","Twiceler","Purebot","facebookexternalhit",
		"Yandex","CatchBot","W3C_Validator","Jigsaw","PostRank","Purebot","Twitterbot",
		"Voyager","zelist");

	foreach($botlist as $bot){
		if(strpos($_SERVER['HTTP_USER_AGENT'],$bot)!==false)
		return true;	// Is a bot
	}
	return false;	// Not a bot
}

// get ip
$ip = $_SERVER['REMOTE_ADDR'];
$query_string = $_SERVER['QUERY_STRING'];
$http_referer = $_SERVER['HTTP_REFERER'];
$http_user_agent = $_SERVER['HTTP_USER_AGENT'];
$remote_host = $_SERVER['REMOTE_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];
$ff = explode('/',$_SERVER['REQUEST_URI']);
$page = $_GET['page'];

// check if it's a bot
if (is_bot())
	$isbot = 1;
else
	$isbot = 0;

// get country and city


include('ip2locationlite.class.php');
//Load the class
$ipLite = new ip2location_lite;
$ipLite->setKey('API_KEY');
 
//Get errors and locations
$locations = $ipLite->getCity($ip);
$errors = $ipLite->getError();
 
//Getting the result
if (!empty($locations) && is_array($locations)) {
  foreach ($locations as $field => $val) {
  	if ($field == 'countryName')
  		$country = $val;
    if ($field == 'cityName')
  		$city = $val;
  }
}

// insert into db
date_default_timezone_set('Asia/Jerusalem');
$date = date("Y-m-d");
$time = date("H:i:s");



//$connId = mysql_connect($server,$username,$password) or die("Cannot connect to server");
//$selectDb = mysql_select_db($database,$connId) or die("Cannot connect to database");

$query = "insert into `tracker` (`country`,`city`,`date`, `time`, `ip`, `query_string`, `http_referer`, `http_user_agent`, `isbot`, `page`) 
values ('$country','$city','$date', '$time', '$ip', '$query_string', '$http_referer' ,'$http_user_agent' , $isbot, '$page')";

//$result = mysql_query($query);
$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// change character set to utf8 and check it
if (!$db_connection->set_charset("utf8")) {
	$errors[] = $db_connection->error;
}

// if no connection errors (= working database connection)
if (!$db_connection->connect_errno) {
	$sql = "select distinct ip from tracker";
	$result = $db_connection->query($query);
}
echo $query;

var_dump( $_SERVER);
?>