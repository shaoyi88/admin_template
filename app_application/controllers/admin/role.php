<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends APP_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 分组权限首页
	 * Enter description here ...
	 */
	public function index()
	{
		$data = array();
		if(checkRight('role_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('APP_Role');
		$keyword = '';
		if($this->input->get('keyword')){
			$keyword = $this->input->get('keyword');
		}
		$offset = 0;
		$pageUrl = '';
		page(formatUrl('role/index').'?', $this->APP_Role->getCount($keyword), PER_COUNT, $offset, $pageUrl);
		$dataList = $this->APP_Role->getList($keyword, $offset, PER_COUNT);
		$data['pageUrl'] = $pageUrl;
		$data['roleList'] = $dataList;
		$data['keyword'] = $keyword;
		$this->showView('roleList', $data);
	}
	
	/**
	 * 
	 * 增加/编辑权限
	 */
	public function add()
	{
		$data = array();
		$data['roleList'] = $this->config->item('rights');
		if($this->input->get('id')){
			if(checkRight('role_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$id = $this->input->get('id');
			$this->load->model('APP_Role');
			$data['info'] = $this->APP_Role->getInfo($id);
			$data['roles'] = explode(',', $data['info']['role_rights']);
			$data['typeMsg'] = '编辑';
		}else{
			if(checkRight('role_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$this->showView('roleAdd', $data);
	}
	
/**
	 * 
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if($this->input->post('id')){
			if(checkRight('role_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['role_rights'] = $this->_formatRoles($data['role_rights']);
			$this->load->model('APP_Role');
			$this->APP_Role->update($data);
			redirect(formatUrl('role/index'));
		}else{
			if(checkRight('role_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['role_rights'] = $this->_formatRoles($data['role_rights']);
			$this->load->model('APP_Role');
			$msg = '';
			if($this->APP_Role->add($data) === FALSE){
				$msg = '?msg='.urlencode('创建失败');
			}
			redirect(formatUrl('role/index'.$msg));
		}
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('role_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$id = $this->input->get('id');
		$this->load->model('APP_Admin');
		$adminList = $this->APP_Admin->queryAdminByRole($id);
		$this->load->model('APP_Role');
		if(empty($adminList)){
			$this->APP_Role->del($id);
			redirect(formatUrl('role/index'));
		}else{
			redirect(formatUrl('role/index?msg='.urlencode('该分组下存在'.count($adminList).'个用户，暂时不可删除')));
		}
	}
	
	/**
	 * 
	 * 格式化权限
	 * @param unknown_type $roles
	 */
	private function _formatRoles($roles)
	{
		$allRoles = $this->config->item('rights');
		$roleResult = $roles;
		foreach($allRoles as $item){
			foreach($item['roles'] as $role){
				if(in_array($role[1], $roles)){
					$roleResult[] = $item['right'];
					break;
				}
			}
		}
		return implode(',', $roleResult);
	}
}