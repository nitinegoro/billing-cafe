<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login page controller.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Main extends Application 
{
	private $start_date;

	private $end_date;

	private $range;

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->js(base_url('assets/app/dashboard.js?v1.0.1'));

		$this->load->model('mmain', 'main');

		$this->page_title->push('Dashboard', 'Overview & Stats');

		// Satu Minggu terakhir
		$sub_week = date('Y-m-d', strtotime("-1 weeks")); 

		$this->start_date = ($this->input->get('from') != '') ? $this->input->get('from') : $sub_week;
		$this->end_date = ($this->input->get('end') != '') ? $this->input->get('end') : date('Y-m-d');

		// Range 
		$this->range = date_range($this->start_date, $this->end_date);
	}

	public function index()
	{
		$this->data = array(
			'title' => "Main",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('main-dashboard', $this->data);
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */