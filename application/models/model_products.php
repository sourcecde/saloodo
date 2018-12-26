<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_products extends CI_Model {
	
		public function all_products()
		{
			$show = $this->db->get('products');
			if($show->num_rows() > 0 ) {
					return $show->result();
			} else {
					 return array();
			} //end if num_rows
					
		}//end function all_products
		
		public function dis_products()
		{
				$this->db->distinct();
				$query = $this->db->query('SELECT DISTINCT pro_name FROM products');
				return $query->result();
		}//without repeated values
		
		public function showme($pro_name)
		{ 
			
			$query = $this->db->get_where('products', array('pro_name' => $pro_name));
			return $query->result();
			
		}//end function this --------- this will find product and show all same product
		
		public function find($pro_id)
			//this is for find record id->product
		{ 
			$code = $this->db->where('pro_id',$pro_id)
							->limit(1)
							->get('products');
			if ($code->num_rows() > 0 )
				{
					return $code->row();
				}else {
					return array();
				}//end if code->num_rows > 0 
				
		}//end function find
		
		public function create($data_products)
		{
			//guery insert into database 	
			$this->db->insert('products',$data_products);
				
		}//end function craete
		
		public function edit($pro_id,$data_products)
		{
			//guery update FROM .. WHERE id->products
			$this->db->where('pro_id',$pro_id)->update('products',$data_products);
		}
		
		public function delete($pro_id)
		{
			//guery delete id->products
			$this->db->where('pro_id',$pro_id)
					->delete('products');
		}
		
	public function report($report_products)
	{
		
		$this->db->insert('reports',$report_products);
		
	}//end function craete
	
	public function reports()
	{ 
		$report = $this->db->get('reports');
		if($report->num_rows() > 0 ) {
			return $report->result();
		} else {
			return array();
		} //end if num_rows
		
	}//end function report
	
	public function del_report($rep_id_product)
	{
		$this->db->where('rep_id_product',$rep_id_product)->delete('reports');
	}
	
} //end class Model_products
///////////////////////////////  Model_products : this is use in controller admin/products + home 