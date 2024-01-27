<?php

// session
session_start();

// header
header('Access-Control-Allow-Origin: *');
header('Access-Control-Max-Age: 86400');
header('Access-Control-Allow-Headers: x-requested-with');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

// require
require_once __DIR__ .'/../_inc/define.php';
require_once __DIR__ .'/../_inc/function.php';
