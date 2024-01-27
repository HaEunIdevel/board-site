<?php
// config 정리
$config                 = array();

$config['ip']['office'] = array(
    '127.0.0.1',
    '218.49.254.228'
);

$config['ip']['dev']    = array(
    '127.0.0.1',
    '::1'
);

$config['ip']['test']   = array(
    '10.41.179.60', // wtest.biz
);

$config['ip']['real']   = array(
    '',
);

//ip check
if (php_sapi_name() == 'cli'){
    $config['isOffice']     = FALSE;
    $config['isDev']        = FALSE;
    $config['isTest']       = FALSE;
    $config['isReal']       = TRUE;

} else {
    $config['isOffice']     = in_array( $_SERVER['REMOTE_ADDR'], $config['ip']['office'] );
    $config['isDev']        = in_array( $_SERVER['SERVER_ADDR'], $config['ip']['dev'] );
    $config['isTest']       = in_array( $_SERVER['SERVER_ADDR'], $config['ip']['test'] );
    $config['isReal']       = in_array( $_SERVER['SERVER_ADDR'], $config['ip']['real'] );

}

if ($config['isOffice']){
    define('ISOFFICE',      TRUE);

} else {
    define('ISOFFICE',      FALSE);
}

if ( $config['isDev'] ){
    define('DBHOST',        'localhost');
    define('DBUSERNAME',    'root');
    define('DBPASSWD',      '');
    define('DBNAME',        'my_site');
    define('WWW',           '');
    define('SSLWWW',        'http://my_site.com:8080');
    define('UPLOADS',        '/uploads');

    define('CSSYYYYMMDD',   time());
    define('JSYYYYMMDD',    time());

} else if ( $config['isTest'] ){
    define('DBHOST',        'localhost');
    define('DBUSERNAME',    'kepco5g');
    define('DBPASSWD',      'Kepco5g!2023@');
    define('DBNAME',        'dbkepco5g');
    define('WWW',           'http://papi-5g.wtest.biz');
    define('SSLWWW',        'https://papi-5g.wtest.biz');
    define('UPLOADS',        '/uploads');

    define('CSSYYYYMMDD',   time());
    define('JSYYYYMMDD',    time());

} else if ( $config['isReal'] ){//localhost
    define('DBHOST',        '100.1.222.180');
    define('DBUSERNAME',    'kepco5g');
    define('DBPASSWD',      'root');
    define('DBNAME',        'root');
    define('WWW',           'http://papi-5g.wtest.biz');
    define('SSLWWW',        'https://papi-5g.wtest.biz');
    define('UPLOADS',        '/uploads');

    define('CSSYYYYMMDD',   time());
    define('JSYYYYMMDD',    time());
}

if (php_sapi_name() == 'cli'){
    define('IP',            '127.0.0.1');
    define('URL',           $_SERVER['PHP_SELF']);

} else{
    define('IP',            $_SERVER['REMOTE_ADDR']);
    define('URL',           $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING']);
}

// 페이징
const PAGING_SIZE   = 10;
const PAGING_SCALE  = 10;

// 세션 정리
$_SE_SEQ        = !empty($_SESSION['SE_SEQ'])       ? $_SESSION['SE_SEQ']       : 0;

// 로그인 여부
if ($_SE_SEQ) {
    define('ISLOGIN',       TRUE);

} else {
    define('ISLOGIN',       FALSE);
}

// db 접속
$_mysqli = new mysqli(DBHOST, DBUSERNAME, DBPASSWD, DBNAME);

if ($_mysqli->connect_errno){
    die('Connect Error: ' . $_mysqli->connect_errno);
}
