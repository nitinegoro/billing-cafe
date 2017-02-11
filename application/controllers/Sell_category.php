<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Product Category page controller.
 *
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Sell_category extends Application 
{
	public $query;

	public $per_page;

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');

		$this->breadcrumbs->unshift(1, 'Data Management', 'sell_category');
		
		$this->load->js(base_url('assets/app/category.js?v1.0.1'));

		$this->load->model('Msales_category', 'category');

		$this->query = $this->input->get('query');
	}

	public function index()
	{
		$this->breadcrumbs->unshift(2, 'Product Category', '#');

		$this->page_title->push('Data Management', 'Product Category');

		// set pagination
		$config = $this->template->pagination_list();

		$config['base_url'] = site_url("sell_category?per_page={$this->per_page}&query={$this->query}");

		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->category->get_all(null, null, 'num');

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Product Category",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'category' => $this->category->get_all($config['per_page'], $this->input->get('page'), 'result'),
			'num_category' => $config['total_rows']
		);
		$this->template->view('category/data-category', $this->data);
	}

	public function create()
	{
		$this->breadcrumbs->unshift(2, 'Add Category', 'product');

		$this->page_title->push('Data Management', 'Add Category');

        $this->form_validation->set_rules('name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim');

        if ($this->form_validation->run() == TRUE)
        {
            $this->category->create();
            redirect('sell_category');
        } 

		$this->data = array(
			'title' => "Add Category",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('category/create-category', $this->data);
	}

	public function update($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'Update Category', 'product');

		$this->page_title->push('Data Management', 'Update Category');

        $this->form_validation->set_rules('name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim');

        if ($this->form_validation->run() == TRUE)
        {
            $this->category->update($param);
            redirect("sell_category/update/{$param}");
        } 

		$this->data = array(
			'title' => "Update Category",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->category->get($param)
		);
		$this->template->view('category/update-category', $this->data);
	}

	public function delete($param = 0)
	{
		$this->category->delete($param);

		redirect('sell_category');
	}

	public function bulk_action()
	{
		switch ($this->input->post('action')) 
		{
			case 'set_update':
				$this->set_update();
				break;
			case 'update':
				$this->category->multiple_update();
				redirect('sell_category');
				break;
			case 'delete':
				$this->category->multiple_delete();
				redirect('sell_category');
				break;
			default:
				$this->template->alert(
					' Empty data selected.', 
					array('type' => 'warning','icon' => 'times')
				);
				redirect('sell_category');
				break;
		}
	}

	public function set_update()
	{
		$this->breadcrumbs->unshift(2, 'Update Category', 'product');

		$this->page_title->push('Data Management', 'Update Category');

        $this->form_validation->set_rules('name', 'Category Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim');

        if ($this->form_validation->run() == TRUE)
        {
            $this->category->update($param);
            redirect("sell_category/update/{$param}");
        } 

		$this->data = array(
			'title' => "Update Category",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('category/multiple-update-category', $this->data);
	}
}

/* End of file Sell_category.php */
/* Location: ./application/controllers/Sell_category.php */