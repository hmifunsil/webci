<?php
$application_host = 'hmif/api'; //leave blank if site is root host;
$mode = 'development'; // 'development', 'production', 'testing';

function base($path = ''){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . '/' . $path;
}
$url = base();
$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';

define('APPHOST', $application_host == '' ? '' : $application_host . '/');
define('MYSITE', $url . $_SERVER['REQUEST_URI']);
define('ASSETS', $url . (APPHOST == '' ? '' : APPHOST ) . 'assets/');
define('IMAGES', ASSETS . 'images/');
define('JS', ASSETS  . 'js/');
define('CSS', ASSETS  . 'css/');
define('VENDORS',ASSETS . 'vendors/');
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : $mode);
define('BASEURL', $_SERVER['SERVER_NAME'] == 'localhost' ? $http . $_SERVER['SERVER_NAME'] . '/'. APPHOST : $http . $_SERVER['SERVER_NAME'] . '/');
