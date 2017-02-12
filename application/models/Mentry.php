<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Entry Model page controller.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Mentry extends CI_Model 
{
	public $user;

	public function __construct()
	{
		parent::__construct();
		
		$this->user = $this->session->userdata('ID_user');
	}

	/**
	 * Get Entry data
	 *
	 * @return string
	 **/
	public function get()
	{
		return $this->db->get_where('pre_order', array('status' => 'entry', 'user_ID' => $this->user))->row();
	}

	/**
	 * Insert 
	 *
	 * @var string
	 **/
	public function insert($param = 0)
	{
		$order = array(
			'table_number' => $param,
			'customer_name' => '',
			'order_date' => date('Y-m-d H:i:s'),
			'status' => 'entry',
			'note' => '',
			'user_ID' => $this->user
		);

		if($this->get())
		{
			$this->db->update('pre_order', $order, array('status' => 'entry', 'user_ID' => $this->user));
		} else {
			$this->db->insert('pre_order', $order);
		}
	}

	/**
	 * Inesert Item To Order Entry
	 *
	 * @param Integer (table)
	 * @var string
	 **/
	public function insert_item($param = 0)
	{
		$order = $this->get();

		$item = $this->product_detail($param);
		
		if($this->get() == FALSE)
			return;

		if($this->check_item($param, $order->order_ID))
		{
			$in = $this->check_item($param, $order->order_ID);
			$quantity = ($in->quantity + $this->input->post('quantity'));

			$data = array(
				'quantity' => $quantity,
				'subtotal' => ($item->price * $quantity),
			);

			$this->db->update('order_items', $data, array('order_item_ID' => $in->order_item_ID));
		} else {
			$data = array(
				'product_item_ID' => $item->item_ID,
				'price' => $item->price,
				'quantity' => $this->input->post('quantity'),
				'discount' => 0,
				'subtotal' => ($item->price * $this->input->post('quantity')),
				'order_ID' => $order->order_ID
			);

			$this->db->insert('order_items', $data);
		}
	}

	/**
	 * Inesert Item To Order Entry
	 *
	 * @param Integer (item in order)
	 * @var string
	 **/
	public function update_item($param = 0)
	{
		$order = $this->get();

		$item = $this->product_detail($param);

		$in = $this->check_item($param, $order->order_ID);

		$quantity = ($this->input->post('quantity'));

		$data = array(
			'quantity' => $quantity,
			'subtotal' => ($item->price * $quantity),
		);

		$this->db->update('order_items', $data, array('order_item_ID' => $param));
	}

	/**
	 * Inesert Item To Order Entry
	 *
	 * @param Integer (item in order)
	 * @var string
	 **/
	public function delete_item($param = 0)
	{
		$this->db->delete('order_items', array('order_item_ID' => $param));
	}

	/**
	 * Check Item In Order Entry
	 *
	 * @param Integer (item)
	 * @param Integer (Order)
	 * @var string
	 **/
	public function check_item($param = 0, $order = 0)
	{
		return $this->db->get_where('order_items', array('product_item_ID' => $param, 'order_ID' => $order))->row();
	}

	/**
	 * Delete Entry data
	 *
	 * @return string
	 **/
	public function delete()
	{
		if($this->get())
		{
			$this->db->delete('order_items', array('order_ID' => $this->get()->order_ID));
			$this->db->delete('pre_order', array('status' => 'entry', 'user_ID' => $this->user));
		}
	}

	public function get_order_items()
	{
		$order = $this->get()->order_ID;
		$this->db->join('product_item', 'product_item.item_ID = order_items.product_item_ID', 'left');
		$this->db->where('order_items.order_ID', $order );
		return $this->db->get('order_items')->result();
	}

	public function get_product_items()
	{
		$this->db->order_by('product_name', 'asc');
		return $this->db->get_where('product_item', array('status' => 'available'))->result();
	}

	public function product_detail($param = 0)
	{
		return $this->db->get_where('product_item', array('item_ID' => $param))->row();
	}

	public function table_check($param = 0, $status = 'entry')
	{
		$query = $this->db->get_where('pre_order', array('user_ID' => $this->user,'table_number' => $param, 'status' => $status));

		return $query->num_rows();
	}
}

/* End of file Mentry.php */
/* Location: ./application/models/Mentry.php */