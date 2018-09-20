<?php
namespace app\admin\controller;
use app\admin\controller;
use think\Loader;
use think\Request;
use app\admin\controller\Traits\WxApi;
use think\Cache;
class Site extends Common
{
	use WxApi;
	/**
	 * 文章列表
	 * @return mixed
	 */
	public function index()
	{
		$field = [
			'id',//文章id
			'title',//文章标题
			'cover',//封面
			'sketch',//简介
			'time',//发布时间
			'type',//所属板块
			'sort'
		];
		$article = Loader::model('Article')->articleList($field);
		$this->assign('article',$article);
		return $this->fetch();
	}

	/**
	 * 更新文章排序
	 * Created by：Mp_Lxj
	 * @date 2018/9/20 15:22
	 * @return array
	 */
	public function articleSort()
	{
		$data = Request::instance()->param();
		$groupID = explode(',',$data['id']);
		$groupSort = explode(',',$data['sort']);
		$resCode = true;
		\think\Db::startTrans();
		try{
			foreach($groupID as $k=>$v){
				$map['id'] = $v;
				$arr['sort'] = $groupSort[$k];
				Loader::model('Article')->articleEdit($map,$arr);
			}
			\think\Db::commit();
		}catch(\Exception $e){
			$resCode = false;
			\think\Db::rollback();
		}
		if($resCode){
			$result = ['status' => 1,'msg' => '修改成功'];
		}else{
			$result = ['status' => 0,'msg' => '参数错误'];
		}
		return $result;
	}

	/**
	 * 批量写入数据库
	 * Created by：Mp_Lxj
	 * @date 2018/9/20 15:15
	 * @return array
	 */
	public function articleAddAll()
	{
		$param = Request::instance()->param();

		$data = [];
		foreach($param['title'] as $value){
			$article = Cache::get('news_' . $value);
			if(!$article){
				return ['status' => 0,'msg' => '页面已失效，请刷新后再试!'];
			}

			$arr = [];
			$arr['title'] = $article['title'];
			$arr['cover'] = $article['thumb_url'];
			$arr['url'] = $article['url'];
			$arr['sketch'] = $article['digest'];
			$arr['time'] = $article['create_time'];
			$arr['type'] = $param['type'];
			$arr['content'] = str_replace('data-src','src',$article['content']);
			$data[] = $arr;
		}

		$res = Loader::model('Article')->articleAddAll($data);
		if($res){
			return ['status' => 1,'msg' => '添加成功'];
		}else{
			return ['status' => 0,'msg' => '添加失败'];
		}
	}

	/**
	 * 发布文章
	 * @return mixed
	 */
	public function articleAdd()
	{
		$page = input('page') ?: 1;
		$count = 10;
		$offset = ($page - 1) * $count;
		$artice = $this->getWxFodder('news',$offset,$count);
		$artice['data'] = $this->isExistence($artice['data'],input('type'));
		$this->assign('article',$artice);
		$this->assign('type',input('type'));
		return $this->fetch();
	}

	/**
	 * 删除文章
	 * @return array
	 */
	public function articleDel()
	{
		$data = Request::instance()->param();
		$map['id'] = ['in',$data['id']];
		$resCode = Loader::model('Article')->articleDelete($map);
		if($resCode){
			$result = ['status' => 1,'msg' => '删除成功'];
		}else{
			$result = ['status' => 0,'msg' => '参数错误'];
		}
		return $result;
	}

	/**
	 * 修改文章
	 * @return array|mixed
	 */
	public function articleEdit()
	{
		$data = Request::instance()->param();
		if(Request::instance()->isAjax()){
			$data['content'] = $this->pregReplace($data['content']);
			//获取上传图片并保存
			$file = Request::instance()->file();
			$path = uploadFile($file);
			if($path){
				foreach($path as $k=>$v){
					$data[$k] = $v;
				}
			}
			$map['id'] = $data['id'];
			$resCode = Loader::model('Article')->articleEdit($map,$data);
			if($resCode){
				$result = ['status' => 1,'msg' => '修改成功'];
			}else{
				$result = ['status' => 0,'msg' => '什么也没修改'];
			}
			return $result;
		}else{
			$field = [
				'id',//文章id
				'title',//文章标题
				'cover',//封面
				'sketch',//简介
				'content',//文章内容
				'type',//所属板块
			];
			$map['id'] = $data['id'];
			$article = Loader::model('Article')->dataSingle($map,$field);
			$this->assign('article',$article);
			return $this->fetch();
		}
	}

	/**
	 * 幻灯片列表页
	 * @return mixed
	 */
	public function banner()
	{
		$field = ['id','banner','url','sort'];
		$banner = Loader::model('Banner')->bannerList($field);
		$this->assign('banner',$banner);
		return $this->fetch();
	}

	/**
	 * 添加幻灯片
	 * @return array|mixed
	 */
	public function bannerAdd()
	{
		$page = input('page') ?: 1;
		$count = 10;
		$offset = ($page - 1) * $count;
		$image = $this->getWxFodder('image',$offset,$count);
		$this->assign('img',$image);
		return $this->fetch();
	}

	/**
	 * 添加banner图片
	 * Created by：Mp_Lxj
	 * @date 2018/9/20 14:14
	 * @return array
	 */
	public function bannerAddAll()
	{
		$param = Request::instance()->param();
		$img = explode(',',$param['img']);

		$img_url = [];
		foreach($img as $value){
			$arr = [];
			$cache_img = Cache::get('image_' . $value);
			if(!$cache_img){
				return ['status' => 0,'msg' => '页面已失效，请刷新后再试!'];
			}
			$arr['banner'] = $cache_img['url'];
			$img_url[] = $arr;
		}
		$res = Loader::model('Banner')->bannerAddAll($img_url);
		if($res){
			return ['status' => 1,'msg' => '添加成功'];
		}else{
			return ['status' => 0,'msg' => '添加失败'];
		}
	}

	/**
	 * 修改banner信息
	 * Created by：Mp_Lxj
	 * @date 2018/9/20 11:04
	 * @return array|mixed
	 */
	public function bannerEdit()
	{
		$data = Request::instance()->param();
		$map['id'] = $data['id'];
		if(Request::instance()->isAjax()){
			//获取上传图片并保存
//			$file = Request::instance()->file();
//			$path = uploadFile($file);
//			if($path){
//				foreach($path as $k=>$v){
//					$data[$k] = $v;
//				}
//			}
			$resCode = Loader::model('Banner')->bannerEdit($map,$data);
			if($resCode){
				$result = ['status' => 1,'msg' => '修改成功'];
			}else{
				$result = ['status' => 0,'msg' => '什么也没修改'];
			}
			return $result;
		}else{
			$field = ['id','banner','url','sort'];
			$banner = Loader::model('Banner')->dataSingle($map,$field);
			$this->assign('banner',$banner);
			return $this->fetch();
		}
	}

	public function bannerDel()
	{
		$data = Request::instance()->param();
		$map['id'] = ['in',$data];
		$resCode = Loader::model('Banner')->bannerDelete($map);
		if($resCode){
			$result = ['status' => 1,'msg' => '删除成功'];
		}else{
			$result = ['status' => 0,'msg' => '参数错误'];
		}
		return $result;
	}

	/**
	 * 更新排序
	 * @return array
	 */
	public function bannerSort()
	{
		$data = \think\Request::instance()->param();
		$groupID = explode(',',$data['id']);
		$groupSort = explode(',',$data['sort']);
		$resCode = true;
		\think\Db::startTrans();
		try{
			foreach($groupID as $k=>$v){
				$map['id'] = $v;
				$arr['sort'] = $groupSort[$k];
				\think\Loader::model('Banner')->bannerEdit($map,$arr);
			}
			\think\Db::commit();
		}catch(\Exception $e){
			$resCode = false;
			\think\Db::rollback();
		}
		if($resCode){
			$result = ['status' => 1,'msg' => '修改成功'];
		}else{
			$result = ['status' => 0,'msg' => '参数错误'];
		}
		return $result;
	}

	//正则处理图片地址
//	public function pregReplace($str){
//		$preg = '/(<img[^>]*[^data-]src="http.*)\?{1}.*(".*>)/U';
//		$str = preg_replace($preg,'${1}${2}',$str);
//		return $str;
//	}
}