<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Banner extends Model
{
	public $tableName = 'banner';

	public function __construct()
	{
		parent::__construct();
		$this->commonModel = Db::name($this->tableName);
	}

	/**
	 * 分页列表
	 * @return mixed 列表信息  分页标签类
	 */
	public function bannerList($field){
		$result = $this->commonModel->field($field)->order('sort')->select();
		return $result;
	}
}