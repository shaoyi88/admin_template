<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 管理员模型类
 * @author Administrator
 *
 */
class APP_Admin extends CI_Model
{
	private $_table = 'app_admin';
	
	/**
	 * 初始化
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 
	 * 校验用户
	 * @param unknown_type $adminAccount
	 * @param unknown_type $adminPassword
	 */
	public function checkAdmin($adminAccount, $adminPassword)
	{
		$query = $this->db->get_where($this->_table, array('admin_account' => $adminAccount));
		if($query){
			$info = $query->row_array();
			if(!empty($info) && md5($adminPassword) == $info['admin_password']){
				return $info;
			}	
		}
		return FALSE;
	}
	
	/**
	 * 
	 * 增加
	 * @param unknown_type $data
	 */
	public function add($data)
	{
		$this->db->insert($this->_table, $data); 
		if($this->db->affected_rows() <= 0){
			return FALSE;
		}
		$id = $this->db->insert_id();		
		return $id;
	}
	
	/**
	 * 
	 * 编辑
	 * @param unknown_type $data
	 */
	public function update($data)
	{
        $this->db->where('admin_id', $data['admin_id']);
		$this->db->update($this->_table, $data); 
	}
	
	/**
	 * 
	 * 删除
	 * @param unknown_type $ids
	 */
	public function del($id)
	{
		$this->db->where('admin_id', $id);
		$this->db->delete($this->_table); 
	} 
	
	/**
	 * 获取信息
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function getInfo($id)
	{
		$query = $this->db->get_where($this->_table, array('admin_id' => $id));
		$info = array();
		if($query){
			$info = $query->row_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 获取列表
	 */
	public function getList($keyword, $offset, $limit)
	{
		$info = array();
		$this->db->order_by('reg_time','DESC');
		if($keyword != ''){
			$this->db->where('admin_name', $keyword);
			$this->db->or_where('admin_account', $keyword);
		}
		$query = $this->db->get($this->_table, $limit, $offset);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 
	 * 获取总数
	 */
	public function getCount($keyword)
	{
		if($keyword != ''){
			$this->db->where('admin_name', $keyword);
			$this->db->or_where('admin_account', $keyword);
		}
		return $this->db->count_all_results($this->_table);
	}
	
	/**
	 * 通过角色查询用户
	 * Enter description here ...
	 * @param unknown_type $rid
	 */
	public function queryAdminByRole($rid)
	{
		$this->db->where('admin_role', $rid);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
	
	/**
	 * 通过账户名查询
	 * Enter description here ...
	 * @param unknown_type $account
	 */
	public function queryAdminByAccount($account)
	{
		$this->db->where('admin_account', $account);
		$info = array();
		$query = $this->db->get($this->_table);
		if($query){
			$info = $query->result_array();
		}
		return $info;
	}
}