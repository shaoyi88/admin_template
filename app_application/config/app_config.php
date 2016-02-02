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

$config['rights'] = array(
	array(
		'module' => '系统管理',
		'roles' => array(
			array('分组权限列表', 'role_list'),
			array('分组权限增加', 'role_add'),
			array('分组权限编辑', 'role_edit'),
			array('分组权限删除', 'role_del', TRUE),
			array('系统用户列表', 'admin_list'),
			array('系统用户增加', 'admin_add'),
			array('系统用户编辑', 'admin_edit'),
			array('系统用户删除', 'admin_del'),
		),
		'right' => 'sys'
	)
);