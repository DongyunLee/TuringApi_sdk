<?php
/**
 * 图灵SDK
 * User: doylee
 * Date: 18-7-11
 * Time: 下午8:50
 */

use turingApi_sdk\curl;
use turingApi_sdk\turing;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require_once './vendor/autoload.php';
// 还没有引入
$GLOBALS['configs'] = require_once './config.php';

if ( $GLOBALS['configs']['debug'] ) {
	// 引入whoops 错误提示
	$whoops = new Run;
	$whoops->pushHandler(new PrettyPageHandler);
	$whoops->register();
}

// -----------=========================需要写入examples里——-------------------————————
$response = json_decode(curl::request(curl::getData()), true);
try {
	$result = (new turing())->setResults($response['results'])
	                        ->setIntent($response['intent'])
	                        ->setEmotion($response['emotion'])::getResults();
	var_dump($result);
} catch ( \Error $error ) {
	die('error');
}
