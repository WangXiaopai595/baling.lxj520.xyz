<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Article extends Model
{
	public $tableName = 'article';

	public function __construct()
	{
		parent::__construct();
		$this->commonModel = Db::name($this->tableName);
	}

	/**
	 * 分页列表
	 * @return mixed 列表信息  分页标签类
	 */
	public function articleList($map,$field,$limit){
		$result = $this->commonModel->where($map)->field($field)->order('time desc')->limit($limit)->select();
		return $result;
	}

	/**
	 * 单条查询
	 * @param $data 接收的参数
	 * @return array|false|\PDOStatement|string|Model 返回查询结果
	 */
	public function dataSingle($map,$field){
		$result = $this->commonModel->where($map)->field($field)->find();
		return $result;
	}
}