<?php

if (! function_exists('pre')) {
    function pre($array){
        echo '<h1>Powered by Laravel Custom Helper</h1>';
        echo "<h3>Current Time : ".date('dMY (h:i:sa)')."</h3>";
        echo "<hr>";
        echo "<pre>";
        print_r($array);
        exit;
    }
}
function adminAssets($url = '')
{
    return URL::to('/backend/'.$url);
}