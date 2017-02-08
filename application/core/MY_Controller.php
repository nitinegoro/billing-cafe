<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
}
/**
 * Parent Class Controller 
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */
class Application extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('template','breadcrumbs','page_title','config','table'));

		$this->load->helper(array('menus'));
		
		$this->load->model(array('app'));
		
		date_default_timezone_set('Asia/Jakarta');

		$this->breadcrumbs->unshift(0, 'Dashboard', 'main');

		if($this->session->has_userdata('is_login')==FALSE)
			redirect('login?from_url='.current_url());
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */