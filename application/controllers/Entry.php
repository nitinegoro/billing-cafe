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

		$this->load->library(array('cart'));

		$this->breadcrumbs->unshift(1, 'Order', 'entry');
		
		$this->load->js(base_url('assets/app/entry.js?v1.0.1'));

		$this->load->model('mproduct', 'product');

		$this->load->model('mentry', 'entry');

		$this->load->model(array('ex_product'));

		$this->category = $this->input->get('category');

		$this->status = $this->input->get('status');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->page_title->push('Entry Order', 'Send Orders to Kitchen');

		$this->data = array(
			'title' => "Order Entry",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('entry/waitress-entry', $this->data);
	}

	/**
	 * Check Entry Table
	 *
	 * @param Integer (table Number)
	 * @return string
	 **/
	public function table_check($param = '')
	{
		if($this->entry->table_check($param) ==  FALSE)
		{
			$output = array('status' => TRUE, 'table' => $param);
		} else {
			$output = array('status' => FALSE, 'table' => $param);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * masukkan Nomor table Ke kerangjang Order
	 *
	 * @return Integer (Table Number) 
	 **/
	public function insert_table($param = 0)
	{
		$this->entry->insert( $param );

		$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => TRUE)));
	}

	/**
	 * Insert Prodcut To Cart
	 *
	 * @param Integer 
	 * @return string
	 **/
	public function add_to_cart($param = 0)
	{
		$this->entry->insert_item($param);
	}

	/**
	 * Insert Prodcut To Cart
	 *
	 * @param Integer 
	 * @return string
	 **/
	public function update_cart($param = 0)
	{
		$this->entry->update_item($param);
	}

	/**
	 * Delete Prodcut From Cart
	 *
	 * @param Integer 
	 * @return string
	 **/
	public function delete_from_cart($param = 0)
	{
		$this->entry->delete_item($param);
	}

	/**
	 * Showing Order Cart Data
	 *
	 * @return string
	 **/
	public function get_order()
	{
		$get = $this->entry->get();

		if($this->entry->get()) 
		{
			$output = array(
				'status' => TRUE,
				'table_number' => "Table Number : ".$get->table_number,
				'data' => array(),
				'total_heading' => '<span class="pull-right">Total :</span>',
			);

			$total = 0;
			foreach ($this->entry->get_order_items() as $row) 
			{
				$output['data'][] = array(
					'<span class="show-details-btn pointer" data-id="'.$row->order_item_ID.'" data-product-name="'.$row->product_name.'" data-qty="'.$row->quantity.'">'.$row->product_name."<span class='text-primary'>(x".$row->quantity.")</span></span>",
					"Rp.".number_format($row->subtotal)
				);

				$total += $row->subtotal;
			}

			$output['total'] = '<span class="tprice">Rp.'.number_format($total) . '</span>';
		} else {
			$output = array(
				'status' => TRUE,
				'table_number' => '',
				'data' => array(),
				'total_heading' => '<span class="pull-right">Total :</span>',
			);
		}


		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Deleting Order From table
	 *
	 * @param Integer table Number
	 * @var string
	 **/
	public function delete_order($param = 0)
	{
		$this->entry->delete($param);
		$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => TRUE, 'message' => "Menu order canceled.")));
	}

}

/* End of file Entry.php */
/* Location: ./application/controllers/Entry.php */