<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Report Transactions page controller.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Report_transactions extends Application 
{
	public $from_date;

	public $end_date;

	public $range;

	public $query;

	public $cashier;

	public $per_page;

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');

		$this->breadcrumbs->unshift(1, 'Report Data', 'report_transactions');
		
		$this->load->js(base_url('assets/app/report_transactions.js?v1.0.1'));

		$this->load->model('mtransaction', 'transaction');

		$this->load->model(array('ex_transaction'));

		$this->query = $this->input->get('query');

		$this->per_page = $this->input->get('per_page');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Transactions', '#');

		$this->page_title->push('Report Data', 'Transactions');

		// set pagination
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url(
			"report_transactions?per_page={$this->per_page}&query={$this->query}"
		);

		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->transaction->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Transactions",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'transactions' => $this->transaction->get_all($config['per_page'], $this->input->get('page'), 'result'),
			'num_transactions' => $config['total_rows']
		);
		$this->template->view('transaction/data-transaction', $this->data);	
	}

}

/* End of file Report_transactions.php */
/* Location: ./application/controllers/Report_transactions.php */