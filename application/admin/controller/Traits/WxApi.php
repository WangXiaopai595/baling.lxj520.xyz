<?php

namespace app\admin\controller\Traits;
use think\Cache;
use think\paginator\driver\Bootstrap;
trait WxApi
{
	/**
	 * 获取并缓存微信token
	 */
	public function wxtoken()
	{
		$token = Cache::get('wxtoken');
		if(empty($token)){
			$wxconfig = config('wx_config');
			$appid = $wxconfig['appid'];
			$appsecret = $wxconfig['appsecret'];
			$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
			$result = $this->sendcurl($url,array(),array(),'GET',true);
			$result = json_decode($result,true);
			if(!empty($result['access_token'])){
				$token = $result['access_token'];
				Cache::set('wxtoken',$token,3600);
			}else{
				$token = $result['errmsg'];
			}
		}
		return $token;
	}

	/**
	 * curl请求
	 * Created by：Mp_Lxj
	 * @date 2018/9/20 10:26
	 * $url为请求地址,
	 * $data为请求参数内容(可以是数组也可以是字符串),
	 * $header为请求报头,
	 * $method为请求方式,
	 * $ssl为是否https安全连接,默认不是false
	 * @return mixed
	 */
	private function sendcurl($url,$data=[],$header=[],$method='POST',$ssl=false)
	{
		$ch = curl_init($url);
		curl_setopt($ch , CURLOPT_CUSTOMREQUEST , $method);  //设置请求方式为POST
		curl_setopt($ch , CURLOPT_POSTFIELDS , $data);  //设置请求发送参数内容,参数值为关联数组
		curl_setopt($ch , CURLOPT_HTTPHEADER , $header );  //设置请求报头的请求格式为json, 参数值为非关联数组
		curl_setopt($ch , CURLOPT_RETURNTRANSFER , true);
		if($ssl){
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //服务器要求使用安全链接https请求时，不验证证书和hosts
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}

		$result = curl_exec($ch);  //发送请求并获取结果

		curl_close($ch); //关闭curl
		return $result;
	}

	/**
	 * @param $url 请求地址  token值前面部分
	 * @param $date 请求内容
	 * @param $isjson 请求内容是否为json
	 * @param string $dataType 请求类型  POST  GET
	 * @param string $type  请求地址type值  有则写  没有不写
	 * @return mixed   微信curl请求
	 */
	public function wxcurl($url,$date,$isjson = true,$dataType = 'POST',$type = '')
	{
		$token = $this->wxtoken();
		if($isjson){
			$date = $this->toJson($date);
		}
		if($type != ''){
			$url .= $token.'&type='.$type;
		}else{
			$url .= $token;
		}

		$result = $this->sendcurl($url,$date,array(),$dataType,true);
		$result = json_decode($result,true);
		return $result;
	}

	/**
	 * @param $data  传入数组或字符串
	 * @return string 数组或字符串转换json中文不转UNICODE码
	 */
	private function toJson($data)
	{
		$result = json_encode($data,JSON_UNESCAPED_UNICODE);
		return $result;
	}

	/**
	 * 获取微信素材列表
	 * Created by：Mp_Lxj
	 * @date 2018/9/20 9:25
	 * @param $type
	 * @param $offset
	 * @param $count
	 * @return mixed
	 */
	public function getWxFodder($type,$offset,$count)
	{
		$url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=';
		$data = [
			'type' => $type,
			'offset' => $offset,
			'count' => $count
		];
		$result = $this->wxcurl($url,$data);

		//分页
		$page = Bootstrap::make('',$count,input('page'),$result['total_count']);

		//根据不同类型采取不同操作
		if($type == 'image'){
			$result = $this->cacheWxFodder($result);
		}else{
			$result = $this->cacheWxNews($result);
		}

		$res['data'] = $result;
		$res['page'] = $page->render();
		return $res;
	}

	/**
	 * 获取并缓存图文信息
	 * Created by：Mp_Lxj
	 * @date 2018/9/20 10:10
	 * @param $data
	 * @return array
	 */
	private function cacheWxNews($data)
	{
		$result = [];
		foreach($data['item'] as $value){
			foreach($value['content']['news_item'] as $v){
				$v['create_time'] = $value['content']['create_time'];
				$result[] = $v;
				Cache::set('news_' . $v['title'],$v);
			}
		}
		return $result;
	}

	/**
	 * 缓存微信图片素材
	 * Created by：Mp_Lxj
	 * @date 2018/9/20 9:44
	 * @param $data
	 * @return array
	 */
	private function cacheWxFodder($data)
	{
		$result = [];
		foreach($data['item'] as $value){
//			$value['url'] = $this->pregReplace($value['url']);
			Cache::set('image_' . $value['media_id'],$value);
			$result[] = $value;
		}
		return $result;
	}

	//正则处理图片地址
	public function pregReplace($str){
		$preg = '/\?{1}.*/';
		$str = preg_replace($preg,'',$str);
		return $str;
	}
}