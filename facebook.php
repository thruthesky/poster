<?php
define('SITENAME', 'facebook');
require_once 'library.php';
require_once 'db.php';



list ( $header, $html ) = get_website("https://www.facebook.com/", "http://facebook.com/");
if ( ! $header ) return db_failure(SITENAME, ACTION_OPEN_LOGIN_PAGE);
else db_success(SITENAME, ACTION_OPEN_LOGIN_PAGE);


print_r(get_cookies( $header ));



urL: https://www.facebook.com/login.php?login_attempt=1&lwv=110



