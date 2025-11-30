<?php
header('Content-Type: application/json');

define('WALLET_ID', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX');

if(isset($_GET['url'])) {
	$url = $_GET['url'];
	$data = reqDownload($url);
    echo json_encode($data);
}

function isFind($string, $find) {
    $pos = stripos($string, $find);
    if($pos === false) {
        return false;
    }
    return true;
}
function removeBefore($string, $before) {
    $pos = strpos($string, $before);
    return $pos !== false ? substr($string, $pos + strlen($before), strlen($string)) : $in;
}
function removeAfter($string, $after) {
    if(isFind($string, $after)) {
        return substr($string, 0, (strpos($string, $after) + strlen($after)));
    }
    return $string;
}
function getStringNumbers($string) {
	$return = "";
	for($i = 0; $i < strlen($string); $i++) {
    	if(is_numeric($string[$i])) {
        	$return .= $string[$i];
        }
    }
    return $return;
}
function reqDownload($url) {
	$wallet_id = WALLET_ID;
    $cookie = 'cookies.txt';
    $useragent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36';
    $result = array('status' => false, 'message' => 'something went wrong');
    if(isFind($url, 'freepik.com')) {
        $link_id = 0;
        if(isFind($url, '#')) {
            $url = removeAfter($url, '#');
            $url = str_replace('#', '', $url);
        }
        if(isFind($url, '_')) {
            $link_id = removeBefore($url, '_');
            $link_id = getStringNumbers($link_id);
        }
       
        $_url = "https://www.freepik.com/api/regular/download?resource=$link_id&action=download&walletId=$wallet_id&locale=en";
        if(isFind($url, '-video/')) $_url = "https://www.freepik.com/api/video/download?optionId=$link_id";
        elseif(isFind($url, '/icon/')) $_url = "https://www.freepik.com/api/icon/download?optionId=$link_id&format=png&type=original&pngSize=512";
        $ch = curl_init($_url);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("User-Agent: $useragent"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
		curl_close($ch);
        $download_data = json_decode($result);
        if(isset($download_data->filename, $download_data->url)) {
			$result = array('status' => true, 'filename' => $download_data->filename, 'download' => $download_data->url, 'res' => json_decode($result, true));
        }
        else {
            $result = array('status' => false, 'message' => 'unable to download');
        }
    }
    else {
        $result = array('status' => false, 'message' => 'invalid url');
    }
    return $result;
}
