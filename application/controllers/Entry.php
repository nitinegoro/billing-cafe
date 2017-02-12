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
	 * masukkan Nomor table Ke kerangjang Order
	 *
	 * @return Integer (Table Number) 
	 **/
	public function insert_table($param = 0)
	{
		$order = array(
			'order' => array(
				'table_number' => "Table Number : ".$param
			), 
		);

		$this->session->set_userdata( $order );

		$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => TRUE, 'table_number' => "Table Number : ".$param)));
	}

	/**
	 * Insert Prodcut To Cart
	 *
	 * @param Integer 
	 * @return string
	 **/
	public function add_to_cart($param = 0)
	{
		$get = $this->entry->product_detail($param);

		$data = array(
			'id'      => $get->item_ID,
			'qty'     => $this->input->post('quantity'),
			'price'   => $get->price,
			'name'    => $get->product_name,
		);

		$this->cart->insert($data);
	}

	/**
	 * Insert Prodcut To Cart
	 *
	 * @param Integer 
	 * @return string
	 **/
	public function update_cart($param = 0)
	{
		$data = array(
			'rowid'      => $param,
			'qty'     => $this->input->post('quantity'),
		);

		$this->cart->update($data);
	}

	/**
	 * Delete Prodcut From Cart
	 *
	 * @param Integer 
	 * @return string
	 **/
	public function delete_from_cart($param = 0)
	{
		$this->cart->remove($param);
	}

	/**
	 * Showing Order Cart Data
	 *
	 * @return string
	 **/
	public function get_order()
	{
		$output = array(
			'status' => TRUE,
			'table_number' => "Table Number : ".$this->session->userdata('order')['table_number'],
			'data' => array(),
			'total_heading' => '<span class="pull-right">Total :</span>',
		);

		$total = 0;
		foreach ($this->cart->contents() as $row) 
		{
			$output['data'][] = array(
				'<span class="show-details-btn pointer" data-id="'.$row['rowid'].'" data-product-name="'.$row['name'].'" data-qty="'.$row['qty'].'">'.$row['name']."<span class='text-primary'>(x".$row['qty'].")</span></span>",
				"Rp.".number_format($row['subtotal'])
			);
			$total += $row['subtotal'];
		}

		$output['total'] = '<span class="tprice">Rp.'.number_format($total) . '</span>';

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
		$this->session->unset_userdata('order');
		$this->cart->destroy();
		$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => TRUE, 'message' => "Menu order canceled.")));
	}

}

/* End of file Entry.php */
/* Location: ./application/controllers/Entry.php */