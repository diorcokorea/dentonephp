<?php

define('doctorhost', $_SERVER['HTTP_HOST']);
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . doctorhost ;
define('CSS', $url.'/resource/css');
define('JS', $url.'/resource/js');
define('IMAGE', $url.'/resource/images');
define('DOMAIN', $url.'/');
?>