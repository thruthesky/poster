<?php


define('ACTION_OPEN_LOGIN_PAGE', 'open-login-page');


/**
 * @param $url
 * @param null $referer
 *
 * @return array
 *
 * @code
 *          list ( $header, $html ) = get_website("https://www.facebook.com/", "http://facebook.com/");
 * @endcode
 */
function get_website( $url, $referer = null ) {

	$headers = [
		"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
		"Accept-Encoding: gzip, deflate",
		"Accept-Language: ko-KR,ko;q=0.8,en-US;q=0.6,en;q=0.4",
	];
	$o = [
		CURLOPT_URL => $url,
		CURLOPT_HTTPHEADER => $headers,
		CURLOPT_HEADER => 1, // 결과 값에 HEADER 정보 출력 여부
		CURLOPT_FRESH_CONNECT => 1, // 캐시 사용 0, 새로 연결 1
		CURLOPT_RETURNTRANSFER => 1, // 리턴되는 결과 처리 방식. 1을 변수 저장. 2는 출력.
		CURLOPT_SSL_VERIFYPEER => 0, // HTTPS 검사 여부
		CURLOPT_REFERER => $referer,
		CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36',
	];
	$ch = curl_init();
	curl_setopt_array( $ch, $o );
	try {
		$res = curl_exec( $ch );
		list( $header, $data ) = explode("\r\n\r\n", $res, 2);
		$html = gzdecode ( $data );
	}
	catch ( exception $e ) {
		$html = null;
		$header = null;
	}

	curl_close( $ch );

	return [ $header, $html ];
}

function get_cookies( $header ) {

	preg_match_all('|Set-Cookie: (.*);|U', $header, $results);

	$cookies = [];
	if ( $results ) {
		foreach($results[1] as $cookie ) {
			list ( $k, $v ) = explode('=', $cookie, 2);
			$cookies[$k] = $v;
		}
	}


	return $cookies;

}