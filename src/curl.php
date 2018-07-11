<?php
/**
 * 图灵SDK
 * User: doylee
 * Date: 18-7-11
 * Time: 下午6:46
 */

namespace turingApi_sdk;

/**
 * 图灵sdk-CURL类
 * Class curl
 */
class curl
{
	/** @var string 图灵api */
	const to = 'http://openapi.tuling123.com/openapi/api/v2';
	
	/** @var string 机器人标识 */
	const api_key = '722577318ee04de4ab4dedaa11c8d19b';
	
	/** @var array 请求参数 */
	private static $data = [
		"reqType"    => 0,
		"perception" => [],
		"userInfo"   => []
	];
	/** @var int 输入类型 */
	private static $reqType = 0;
	/** @var array 输入信息 */
	private static $perception = [
		"inputText" => [
			"text" => "你好"
		]
	];
	/** @var array 用户参数 */
	private static $userInfo = [
		"apiKey" => self::api_key,
		"userId" => "1"
	];
	
	/**
	 * curl示例
	 * @return string
	 */
	public function demo ()
	: string
	{
		return self::request(self::getData());
	}
	
	/**
	 * 发起对图灵API的curl请求
	 * @param $data
	 * @return mixed
	 */
	public static function request ($data)
	{
		// 对传值进行转换格式
		$data = is_array($data) || is_object($data)
			? json_encode((object)$data)
			: $data;
		// 创建curl资源句柄
		$ch = curl_init(self::to);
		
		// 设置url
		curl_setopt_array($ch, [
			CURLOPT_POST           => true,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_POSTFIELDS     => $data,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER     => [
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data)
			]
		]);
		
		// 获取响应
		$output = curl_exec($ch);
		
		// 关闭curl句柄
		curl_close($ch);
		
		return $output;
	}
	
	/**
	 * 获取请求参数，在各种赋值之后运行，否则使用默认参数进行传递
	 * @return array
	 */
	public static function getData ()
	: array
	{
		self::$data = [
			'reqType'    => self::getReqType(),
			'perception' => self::getPerception(),
			'userInfo'   => self::getUserInfo()
		];
		
		return self::$data;
	}
	
	/**
	 * 一步完成对需要传递的data进行整体赋值
	 * @param $data
	 * @return array
	 */
	public static function setData ($data)
	{
		self::$data = $data;
		
		return self::$data;
	}
	
	/**
	 * 获取输入类型
	 * @return int
	 */
	public static function getReqType ()
	: int
	{
		return self::$reqType;
	}
	
	/**
	 * 获取输入信息
	 * @return array
	 */
	public static function getPerception ()
	: array
	{
		return self::$perception;
	}
	
	/**
	 * 获取请求用户参数
	 * @return array
	 */
	public static function getUserInfo ()
	: array
	{
		return self::$userInfo;
	}
	
	/**
	 * 配置用户参数
	 * @param array $userInfo
	 * @return \turingApi_sdk\curl
	 */
	public function setUserInfo (array $userInfo)
	: curl
	{
		self::$userInfo = $userInfo;
		
		return $this;
	}
	
	/**
	 * 配置输入类型
	 * @param int $reqType
	 * @return \turingApi_sdk\curl
	 */
	public function setReqType (int $reqType)
	: curl
	{
		self::$reqType = $reqType;
		
		return $this;
	}
	
	/**
	 * 配置输入信息
	 * @param array $perception
	 * @return \turingApi_sdk\curl
	 */
	public function setPerception (array $perception)
	: curl
	{
		self::$perception = $perception;
		
		return $this;
	}
}