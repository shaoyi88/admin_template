<?php

$config['menus'] = array(
	array(
		'module' => '系统管理',
		'menu' => array(
			array('分组权限管理', formatUrl('role/index'), 'role_list'),
			array('系统用户管理', formatUrl('admin/index'), 'admin_list'),
		),
		'right' => 'sys'
	)
);