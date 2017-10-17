<?php

$db_host = 'localhost';
//$db_host = 'www.sonub.com';

$db_user = 'root';
$db_name = 'poster';
$db_password = '7777';



include_once "ezSQL/shared/ez_sql_core.php";
include_once "ezSQL/mysqli/ez_sql_mysqli.php";



$db = new ezSQL_mysqli( $db_user, $db_password, $db_name, $db_host);

$db->query("SET CHARACTER SET utf8");
$db->query("set session character_set_connection=utf8;");
$db->query("set session character_set_results=utf8;");
$db->query("set session character_set_client=utf8;");




function db_success($site, $action) {
	global $db;
	$time = time();
	$db->query("INSERT INTO poster_log (site, action, result, stamp) VALUES ('$site', '$action', 'Y', '$time')");
}

/**
 * @param $site
 * @param $action
 * @return void
 */
function db_failure($site, $action) {
	global $db;
	$time = time();
	$db->query("INSERT INTO poster_log (site, action, result, stamp) VALUES ('$site', '$action', 'N', '$time')");
	return;
}
