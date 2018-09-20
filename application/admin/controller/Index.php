<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Traits\WxApi;
class Index extends Controller
{
	use WxApi;

	public function __construct()
	{
		parent::__construct();
		if(!\think\Session::has('member')){
			$this->redirect('login/index');
		}else{
			$user = \think\Session::get('member');
			$this->assign('member',$user);
		}
	}

	/**
	 * 后台首页
	 * @return mixed
	 */
	public function index()
    {
		$menu = $this->__menu();
	    $this->assign('menu',$menu);
	    return $this->fetch();
	}

	/**
	 * 当前用户可以访问的菜单
	 */
	public function __menu(){
		$user = \think\Session::get('member');
		$cacheMenu = \think\Cache::get('menu');

		//若缓存存在，则从缓存获取，若不存在，则重新查询数据库
		if(!isset($cacheMenu[$user['id']])){
			//当前用户可操作的组
			$map['t.admin_id'] = $user['id'];
			$map['t1.status'] = 1;
			$roleID = \think\Loader::model('RoleAdmin')->dataFind($map,['t.role_id']);

			//当前用户可操作的权限
			unset($map);
			$map['role_id'] = $roleID['role_id'];
			$field = ['node_id'];
			$nodeID = \think\Loader::model('RoleNode')->roleList($map,$field);
			$arr = [];
			foreach($nodeID as $k=>$v){
				array_push($arr,$v['node_id']);
			}

			//当前用户可访问的菜单
			unset($map);
			$map['t.display'] = ['eq',1];
			$map['t.status'] = ['eq',1];
			$map['t.id'] = ['in',$arr];
			$map['t2.status'] = ['eq',1];
			$field = [
				'title',
				'name',
				'icon'
			];
			$menu = \think\Loader::model('Role')->nodeMenu($map,$field);
			$menu = arrayGroup($menu,'mname',['mname','micon'],'menu');
			foreach($menu as $k=>$v){
				foreach($v['menu'] as $key=>$value){
					$menu[$k]['menu'][$key]['url'] = strtolower($value['pname'].'/'.$value['name']);
					$icon = explode(' ',$value['icon']);
					$menu[$k]['menu'][$key]['cicon'] = isset($icon[1]) ? $icon[1] : '';
					unset($menu[$k]['menu'][$key]['pname']);
					unset($menu[$k]['menu'][$key]['name']);
				}
			}
			$cacheMenu[$user['id']] = $menu;
			\think\Cache::set('menu',$cacheMenu);
		}else{
			$menu = $cacheMenu[$user['id']];
		}
		return $menu;
	}

	/**
	 * 欢迎页
	 */
	public function main()
	{
		$image = $this->getWxFodder('image',0,10);
		dump($image);

		$info = array(
			'运行环境'=>$_SERVER["SERVER_SOFTWARE"],
			'主机名'=>$_SERVER['SERVER_NAME'],
			'WEB服务端口'=>$_SERVER['SERVER_PORT'],
			'浏览器信息'=>substr($_SERVER['HTTP_USER_AGENT'], 0, 40),
			'通信协议'=>$_SERVER['SERVER_PROTOCOL'],
			'请求方法'=>$_SERVER['REQUEST_METHOD'],
			'上传附件限制'=>ini_get('upload_max_filesize'),
			'执行时间限制'=>ini_get('max_execution_time').'秒',
			'服务器时间'=>date("Y年n月j日 H:i:s"),
			'服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
			'用户的IP地址'=>$_SERVER['REMOTE_ADDR'],
		);
		$this->assign('info',$info);
		return $this->fetch();
	}

	/**
	 * 退出登陆
	 * @return array
	 */
	public function loginOut(){
		\think\Session::delete('member');
		$this->redirect('login/index');
	}

	public function form(){
		return $this->fetch();
	}
}
