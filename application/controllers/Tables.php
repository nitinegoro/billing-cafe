<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Product page controller.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Tables extends Application 
{
	public $query;

	public $status;

	public $per_page;

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');

		$this->breadcrumbs->unshift(1, 'Master Data', 'tables');
		
		$this->load->js(base_url('assets/app/table.js?v1.0.1'));

		$this->load->model('Mtables', 'tables');

		$this->status = $this->input->get('status');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Tables', '#');

		$this->page_title->push('Master Data', 'Tables');

		// set pagination
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("tables?per_page={$this->per_page}&status={$this->status}&query={$this->query}");

		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->tables->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Tables",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'tables' => $this->tables->get_all($config['per_page'], $this->input->get('page'), 'result'),
			'num_tables' => $config['total_rows']
		);
		$this->template->view('tables/data-tables', $this->data);
	}

}

/* End of file Tables.php */
/* Location: ./application/controllers/Tables.php */