<?php
namespace app\index\controller;
use think\Controller;
use think\Loader;

class Index extends Controller
{
	/**
	 * 设计列表页查询
	 * @return mixed
	 */
	public function index(){
		//幻灯片查询
		$bannerField = ['banner','url'];
		$banner = Loader::model('Banner')->bannerList($bannerField);
		$this->assign('banner',$banner);

		//文章列表查询
		$field = [
			'id',
			'title',
			'cover',
			'sketch',
			'url'
		];
		$map['type'] = 1;
		$article = Loader::model('Article')->articleList($map,$field,'0,10');
		$this->assign('article',$article);
		return $this->fetch();
	}

	/**
	 * 文章详情页
	 * @return mixed
	 */
	public function detail(){
		$data = \think\Request::instance()->param();
		$map['id'] = $data['id'];
		$field = [
			'time',
			'id',
			'title',
			'content',
			'url'
		];
		$article = Loader::model('Article')->dataSingle($map,$field);
		$this->assign('article',$article);
		return $this->fetch();
	}

	/**
	 * 上拉加载更多
	 * @return array
	 */
	public function articleMore(){
		$data = \think\Request::instance()->param();
		$length = 10;
		$limit = $data['page'] * $length . ',' . $length;
		//文章列表查询
		$field = [
			'id',
			'title',
			'cover',
			'sketch'
		];
		$map['type'] = $data['type'];
		$article = Loader::model('Article')->articleList($map,$field,$limit);
		if(empty($article)){
			$result = ['status' => 0,'masg' => '暂无数据'];
		}else{
			foreach($article as $k=>$v){
				$article[$k]['url'] = \think\Url::build('index/detail',['id'=>$v['id']]);
			}
			$result = ['status' => 1,'data' => $article];
		}
		return $result;
	}

	/**
	 * 施工档案列表页
	 * @return mixed
	 */
	public function build(){
		//幻灯片查询
		$bannerField = ['banner','url'];
		$banner = Loader::model('Banner')->bannerList($bannerField);
		$this->assign('banner',$banner);

		//文章列表查询
		$field = [
			'id',
			'title',
			'cover',
			'sketch'
		];
		$map['type'] = 2;
		$article = Loader::model('Article')->articleList($map,$field,'0,10');
		$this->assign('article',$article);
		return $this->fetch();
	}
}