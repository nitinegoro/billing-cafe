<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Entry page controller.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Entry extends Application 
{
	public $category;

	public $query;

	public $status;

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Order', 'entry');
		
		$this->load->js(base_url('assets/app/entry.js?v1.0.1'));

		$this->load->model('mproduct', 'product');

		$this->load->model(array('ex_product'));

		$this->category = $this->input->get('category');

		$this->status = $this->input->get('status');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->page_title->push('Entry Order', '');

		$this->data = array(
			'title' => "Order Entry",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('entry/waitress-entry', $this->data);
	}

}

/* End of file Entry.php */
/* Location: ./application/controllers/Entry.php */