<?php
/**
 * 图灵SDK
 * User: doylee
 * Date: 18-7-11
 * Time: 下午7:31
 */

namespace turingApi_sdk;

/**
 * 图灵sdk-CURL类
 * Class curl
 */
class turing
{
	private static $emotion;
	private static $intent;
	private static $results;
	
	/**
	 * 配置感情
	 * @param mixed $emotion
	 * @return turing
	 */
	public function setEmotion ($emotion)
	: turing
	{
		self::$emotion = $emotion;
		
		return $this;
	}
	
	/**
	 * 配置请求意图
	 * @param mixed $intent
	 * @return turing
	 * @throws \Error
	 */
	public function setIntent ($intent)
	: turing
	{
		if ( $intent['code'] !== 10004 ) throw new \Error(self::getResults()[0]['values']['text'], $intent['code']);
		
		self::$intent = $intent;
		
		return $this;
	}
	
	/**
	 * 获取输出结果集
	 * @return mixed
	 */
	public static function getResults ()
	: array
	{
		return self::simplifyReturn(self::$results);
	}
	
	/**
	 * 简化返回值
	 * @param array $results
	 * @return array
	 */
	private static function simplifyReturn (array $results)
	: array
	{
		$res = [];
		foreach ( $results as $result ) $res[ $result['groupType'] ][ $result['resultType'] ] = $result['values']['text'];
		
		return $res;
	}
	
	/**
	 * 配置输出结果集
	 * @param $results
	 * @return \turingApi_sdk\turing
	 */
	public function setResults ($results)
	: turing
	{
		self::$results = $results;
		
		return $this;
	}
	
	/**
	 * 获取感情
	 * @return mixed
	 */
	public static function getEmotion ()
	{
		return self::$emotion;
	}
	
	/**
	 * 获取请求意图
	 * @return mixed
	 */
	public static function getIntent ()
	{
		return self::$intent;
	}
	
}