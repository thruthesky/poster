<?php
define('SITENAME', 'facebook');
require_once 'library.php';
require_once 'db.php';

require __DIR__ . '/vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;


list ( $header, $html ) = get_website("https://www.facebook.com/", "http://facebook.com/");
if ( ! $header ) return db_failure(SITENAME, ACTION_OPEN_LOGIN_PAGE);
else db_success(SITENAME, ACTION_OPEN_LOGIN_PAGE);


//print_r(get_cookies( $header ));


//echo $html;


$crawler = new Crawler($html);
//print_r($crawler);



	$form = $crawler->filter('#login_form');


$url = $form->attr('action');

echo "url: $url\n";

$hiddens = $form->filter("input[type='hidden']");

$count = $hiddens->count();
echo "input hidden found: $count\n";

$hiddens_kvs = [];
for ( $i = 0; $i < $count; $i ++ ) {
	$name = $hiddens->eq($i)->attr('name') . "\n";
	$value = $hiddens->eq($i)->attr('value') . "\n";
	$name = trim($name);
	$hiddens_kvs[ $name ] = $value;
}

print_r($hiddens_kvs);



