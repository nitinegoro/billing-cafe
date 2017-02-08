<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Product page controller.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Product extends Application 
{
	public $category;

	public $query;

	public $status;

	public $per_page;

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');

		$this->breadcrumbs->unshift(1, 'Master Data', 'product');
		
		$this->load->js(base_url('assets/app/product.js?v1.0.1'));

		$this->load->model('mproduct', 'product');

		$this->category = $this->input->get('category');

		$this->status = $this->input->get('status');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Product Sales', '#');

		$this->page_title->push('Master Data', 'Product Sales');

		// set pagination
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url(
			"products/course?per_page={$this->per_page}&status={$this->status}&category={$this->category}&query={$this->query}"
		);

		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->product->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Product Sales",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'product' => $this->product->get_all($config['per_page'], $this->input->get('page'), 'result'),
			'num_product' => $config['total_rows']
		);
		$this->template->view('product/data-product', $this->data);
	}

	public function create()
	{
		$this->breadcrumbs->unshift(2, 'Add Product Sales', 'product');

		$this->page_title->push('Master Data', 'Add Product Sales');

        $this->form_validation->set_rules('code', 'Product Code', 'trim|callback_validate_code');
        $this->form_validation->set_rules('item_ID', 'Item ID', 'trim');
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('price', 'Price', 'trim|alpha_numeric|required');
        $this->form_validation->set_rules('status', 'Product Status', 'trim|required');

        if ($this->form_validation->run() == TRUE)
        {
            $this->product->create();
            redirect('product');
        } 

		$this->data = array(
			'title' => "Add Product Sales",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('product/create-product', $this->data);
	}

	public function update($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'Update Product Sales', 'product');

		$this->page_title->push('Master Data', 'Update Product Sales');

        $this->form_validation->set_rules('code', 'Product Code', 'trim|callback_validate_code');
        $this->form_validation->set_rules('item_ID', 'Item ID', 'trim');
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('price', 'Price', 'trim|alpha_numeric|required');
        $this->form_validation->set_rules('status', 'Product Status', 'trim|required');

        if ($this->form_validation->run() == TRUE)
        {
            $this->product->update($param);
            redirect('product');
        } 

		$this->data = array(
			'title' => "Update Product Sales",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->product->get($param)
		);
		$this->template->view('product/update-product', $this->data);
	}

	/**
	 * Cek Validasi Kode Produk
	 *
	 * @return Bolean
	 **/
	public function validate_code()
	{
		if($this->product->check_code() == TRUE)
		{
			$this->form_validation->set_message('validate_code', 'Sorry! Product Code in use.');
			return false;
		} else {
			return true;
		}
	}
}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */