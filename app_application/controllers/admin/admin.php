<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends APP_Controller 
{
	protected function initialize()
	{
		parent::initialize();
		checkLogin();
	}
	
	
}