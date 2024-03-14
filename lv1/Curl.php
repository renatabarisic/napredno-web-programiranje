<?php
function fetch_url($url){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    $r = curl_exec($curl);
    curl_close($curl);
    return $r;
}
?>