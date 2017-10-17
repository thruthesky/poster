<?php
define('SITENAME', 'daum');
require_once 'library.php';
require_once 'db.php';


list ( $header, $html ) = get_website("https://search.daum.net/search?w=tot&DA=YZR&t__nil_searchbox=btn&sug=&sugo=&q=%ED%95%84%EB%A6%AC%ED%95%80",
	"https://www.daum.net/");

if ( $header ) db_success( SITENAME, 'get search result' );

print_r(get_cookies( $header ));

