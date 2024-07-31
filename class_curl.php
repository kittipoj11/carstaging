<?php
function curl_get($url){
$ch = curl_init(); // create cURL handle (ch)
if (!$ch) {
    die("Couldn't initialize a cURL handle");
}
// set some cURL options
$ret = curl_setopt($ch, CURLOPT_URL,$url);
//$ret = curl_setopt($ch, CURLOPT_HEADER,0);
//$ret = curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$ret = curl_setopt($ch, CURLOPT_TIMEOUT,30);

// execute
$ret = curl_exec($ch);

if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
} else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler

    if (empty($info['http_code'])) {
            die("No HTTP code was returned"); 
    } else {
        // load the HTTP codes
//        $http_codes = parse_ini_file("path/to/the/ini/file/I/pasted/above");
//        
//        // echo results
//        echo "The server responded: <br />";
//        echo $info['http_code'] . " " . $http_codes[$info['http_code']];
    }

}
    return $ret;
}
?>