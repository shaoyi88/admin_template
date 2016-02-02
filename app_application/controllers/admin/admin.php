<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends APP_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	/**
	 * 
	 * 修改密码
	 */
	public function changePassword()
	{
		$data = $this->input->post();
		$data['admin_password'] = md5($data['admin_password']);
		$this->load->model('APP_Admin');
		$data['info'] = $this->APP_Admin->update($data);
		$this->session->sess_destroy();
		redirect(formatUrl('login/index?msg='.urlencode('请使用新密码重新登录')));
	}
	
	/**
	 * 
	 * 系统用户首页
	 */
	public function index()
	{
		$data = array();
		if(checkRight('admin_list') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		if($this->input->get('msg')){
			$data['msg'] = $this->input->get('msg');
		}
		$this->load->model('APP_Admin');
		$keyword = '';
		if($this->input->get('keyword')){
			$keyword = $this->input->get('keyword');
		}
		$offset = 0;
		$pageUrl = '';
		page(formatUrl('admin/index').'?', $this->APP_Admin->getCount($keyword), PER_COUNT, $offset, $pageUrl);
		$dataList = $this->APP_Admin->getList($keyword, $offset, PER_COUNT);
		$data['pageUrl'] = $pageUrl;
		$data['adminList'] = $dataList;
		$data['keyword'] = $keyword;
		$this->showView('adminList', $data);
	}
	
	/**
	 * 
	 * 增加/编辑用户
	 */
	public function add()
	{
		$data = array();
		$this->load->model('APP_Role');
		$data['roleList'] = $this->APP_Role->getAll();
		if($this->input->get('id')){
			if(checkRight('admin_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$id = $this->input->get('id');
			$this->load->model('APP_Admin');
			$data['info'] = $this->APP_Admin->getInfo($id);
			$data['typeMsg'] = '编辑';
		}else{
			if(checkRight('admin_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data['typeMsg'] = '新增';
		}
		$this->showView('adminAdd', $data);
	}
	
	/**
	 * 
	 * 增加/编辑逻辑
	 */
	public function doAdd()
	{
		$data = array();
		if($this->input->post('admin_id')){
			if(checkRight('admin_edit') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			if($data['admin_password']){
        		$data['admin_password'] = md5($data['admin_password']);
        	}else{
        		unset($data['admin_password']);
        	}
			$this->load->model('APP_Admin');
			$this->APP_Admin->update($data);
			redirect(formatUrl('admin/index'));
		}else{
			if(checkRight('admin_add') === FALSE){
				$this->showView('denied', $data);
				exit;
			}
			$data = $this->input->post();
			$data['admin_password'] = md5($data['admin_password']);
			$data['reg_time'] = time();
			$this->load->model('APP_Admin');
			$msg = '';
			$adminInfo = $this->APP_Admin->queryAdminByAccount($data['admin_account']);
			if(empty($adminInfo)){
				if($this->APP_Admin->add($data) === FALSE){
					$msg = '&msg='.urlencode('创建失败');
				}
			}else{
				$msg = '&msg='.urlencode('该系统用户已存在，请勿重复新增');
			}
			redirect(formatUrl('admin/index?'.$msg));
		}
	}
	
	/**
	 * 
	 * 删除
	 */
	public function doDel()
	{
		$data = array();
		if(checkRight('admin_del') === FALSE){
			$this->showView('denied', $data);
			exit;
		}
		$id = $this->input->get('id');
		$this->load->model('APP_Admin');
		$this->APP_Admin->del($id);
		redirect(formatUrl('admin/index'));
	}
}