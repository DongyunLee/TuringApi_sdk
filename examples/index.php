<?php
/**
 * autoload.php-TuringApi_sdk
 * By lidongyun@shuwang-tech.com
 * On 18-7-12 下午6:17
 * Doing good deeds without asking for reward
 */

use turingApi_sdk\curl;
use turingApi_sdk\turing;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require_once '../autoload.php';

// 引入whoops 错误提示
$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

/** @var array $response 获取所有返回值 */
$response = curl::request(curl::getData(),true);

try {
	$result = (new turing())->setResults($response['results'])
	                        ->setIntent($response['intent'])
	                        ->setEmotion($response['emotion'])::getResults();
	var_dump($result);
} catch ( \Error $error ) {
	echo json_encode([
		                 'code' => $error->getCode(),
		                 'msg' => $error->getMessage()
	                 ]);
}