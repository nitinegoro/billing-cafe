<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Product page Model.
 * Excel Manipulation Data
 * 
 * @see https://github.com/nitinegoro/billing-cafe
 * @version 1.0.1
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 */

class Ex_product extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Excel/PHPExcel','upload'));
	}

	public function set()
	{
		$config['upload_path'] = 'assets/excel';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']  = '5120';
		
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('file_excel')) 
		{
			$this->template->alert(
				$this->upload->display_errors('<span>','</span>'), 
				array('type' => 'success','icon' => 'check')
			);
		} else {

			$file_excel = "./assets/excel/{$this->upload->file_name}";

			// Identifikasi File Excel Reader
			try {

				$excelReader = new PHPExcel_Reader_Excel2007();

            	$loadExcel = $excelReader->load($file_excel);	

            	$sheet = $loadExcel->getActiveSheet()->toArray(null, true, true ,true);
		        // Loops Excel data reader

		        foreach ($sheet as $key => $value) 
		        {
		        	// Mulai Dari Baris ketiga
		        	if($key > 1)
		        	{
		        		if($this->check_code($value['B']) == TRUE)
		        			continue;

		        		if($this->category(trim(strtolower($value['D']))))
		        		{
		        			$category = $this->category(trim(strtolower($value['D'])));
		        		} else {
		        			$category_in = array(
		        				'product_sales' => $value['D'],
		        				'description_sales' => '' 
		        			);
		        			$this->db->insert('product_sales', $category_in);
		        			$category = $this->db->insert_id();
		        		}

		        		$products = array(
							'code' => $value['B'],
							'ps_ID' => $category,
							'product_name' => $value['C'],
							'description_product' => $value['E'],
							'price' => $value['F'],
							'status' => $value['G'] 
		        		);

		        		$this->db->insert('product_item', $products);

		        	// End Baris ketiga
		        	}
		        // End Loop
		        }

		        unlink("./assets/excel/{$this->upload->file_name}");

				$this->template->alert(
					' Product Added.', 
					array('type' => 'success','icon' => 'check')
				);
			} catch (Exception $e) {
				$this->template->alert(
					' Failed '. $e->getMessage(), 
					array('type' => 'warning','icon' => 'check')
				);
			}
		}
	}

	public function category($param = '')
	{
		$query = $this->db->select('ps_ID')
				 		  ->like('product_sales', $param)
				 		  ->get('product_sales');	

		if($query->num_rows())
		{
			return $query->row('ps_ID');
		} else {
			return 0;
		}
	}

	/**
	 * Cek Validasi Kode Produk
	 *
	 * @return Bolean
	 **/
	public function check_code($param = '')
	{
		$this->db->where('code', $param);	
		return $this->db->get('product_item')->num_rows();
	}

	public function get_all()
	{
		$this->db->join('product_sales', 'product_item.ps_ID = product_sales.ps_ID', 'left');
		return $this->db->get('product_item')->result();
	}
	
	public function get()
	{
		$objPHPExcel = new PHPExcel();

		$worksheet = $objPHPExcel->createSheet(0);

	    for ($cell='A'; $cell<='G'; $cell++)
	    {
	        $worksheet->getStyle($cell.'1')->getFont()->setBold(true);
	    }

	    $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

	    $worksheet->getStyle('A1:G1')->applyFromArray($style);

		// Header dokumen
		 $worksheet->setCellValue('A1', 'NO.')
		 		   ->setCellValue('B1', 'CODE')
		 		   ->setCellValue('C1', 'PRODUCT NAME')
		 		   ->setCellValue('D1', 'CATEGORY')
		 		   ->setCellValue('E1', 'DESCRIPTION')
		 		   ->setCellValue('F1', 'PRICE')
		 		   ->setCellValue('G1', 'STATUS');

		// Set Value Data
		$row_cell = 2;
		foreach($this->get_all() as $key => $value)
		{
		 $worksheet->setCellValue('A'.$row_cell, ++$key)
		 		   ->setCellValue('B'.$row_cell, $value->code)
		 		   ->setCellValue('C'.$row_cell, $value->product_name)
		 		   ->setCellValue('D'.$row_cell, $value->product_sales)
		 		   ->setCellValue('E'.$row_cell, $value->description_product)
		 		   ->setCellValue('F'.$row_cell, $value->price)
		 		   ->setCellValue('G'.$row_cell, ucfirst($value->status));

			$row_cell++;
		}


		// Sheet Title
		$worksheet->setTitle("PRODUCT SALES");

		$objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');\
        header('Content-Disposition: attachment; filename="PRODUCT-SALES.xlsx"');
        $objWriter->save("php://output");
	}
}

/* End of file Ex_product.php */
/* Location: ./application/models/Ex_product.php */