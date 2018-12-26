<?php

class Api_model extends CI_Model
{

    public function register_new($data_register_new)
    {
        if (!$this->db->insert('users', array(
                //'image' => $post['image'],
                'usr_name' => $data_register_new['usr_name'],
                'usr_password' => md5($data_register_new['usr_password']),
                'usr_group' => $data_register_new['usr_group']
            ))) {
            log_message('error', print_r($this->db->error(), true));
        }     
    }

    public function getProducts()
    {
        $query =  $this->db->get('products');
        return $query->result_array();
    }

    public function getProduct($id)
    {

        $this->db->where('products.pro_id', $id);
        $this->db->limit(1);
        $query = $this->db->get('products');
        return $query->row_array();
    }


    public function bundleProduct($post)
    {

        //here for create new bundle
                $bundle = array(
                                'name'      =>  $post['name'],
                                'price'      =>  $post['price'],
                                'date'      =>  date('Y-m-d H:i:s')
                                );
                $this->db->insert('bundles',$bundle);
                $bundle_id = $this->db->insert_id();
        //here for create new bundle product
                $no_of_product_list = json_decode($post['pro_id'], true);

                foreach ($no_of_product_list as $datas) {

                $bundle_product = array(
                                'bundle_id'      =>  $bundle_id,
                                'product_id'     =>  $datas['pro_id']
                                );
                $this->db->insert('bundle_product',$bundle_product);
            }

                if (!$this->db->insert('products', array(
                    'pro_name' => $post['name'],
                    'pro_price' => $post['price'],
                    'pro_stock' => $post['stock'],
                    'bundle_id' => $bundle_id
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function setProduct($post)
    {
        //print_r($post);exit;
        if (!$this->db->insert('products', array(
                    'pro_name' => $post['pro_name'],
                    'pro_title' => $post['pro_title'],
                    'pro_description' => $post['pro_description'],
                    'pro_price' => $post['pro_price'],
                    'pro_stock' => $post['pro_stock'],
                    //'pro_image' => $post['pro_img'],
                    'pro_discount' => $post['pro_discount'],
                    'pro_discount_type' => $post['pro_discount_type']
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
        $id = $this->db->insert_id();
    }


    public function updateProduct($id,$data_products)
    {
        $this->db->where('pro_id',$id)
                    ->update('products',$data_products);
    }

    public function deleteProduct($id)
    {
        $this->db->where('pro_id',$id)
                    ->delete('products');
    }

    public function process($data)
    {  

        $user_id = $data['user_id'];

        $checkUser = $this->db->where('usr_id',$user_id)
                            ->limit(1)
                            ->get('users');

        if ($checkUser->num_rows() > 0 )
        {
        $no_of_product_list = json_decode($data['pro_id'], true);
        foreach ($no_of_product_list as $datas) {
            //print_r($datas);exit;
        $result = $this->db->where('pro_id',$datas['pro_id'])
                            ->limit(1)
                            ->get('products');
        }
        if ($result->num_rows() > 0 )
            {                                   
                if (!$this->db->insert('orders', array(
                    'user_id'        => $user_id,
                    'order_date'     => date('Y-m-d H:i:s'),
                    'status'         =>'confirm'
                     ))){
                        log_message('error', print_r($this->db->error(), true));
                    }
                $order_id = $this->db->insert_id();

                //here for create new invoice
                $invoice = array(
                                'data'      =>  date('Y-m-d H:i:s'),
                                'due_date'  =>  date('Y-m-d H:i:s',mktime(date('H'),date('i'),date('s'),date('m'),date('d') + 1,date('Y'))),
                                 'user_id'   => $user_id,
                                'status'    =>  'unpaid'
                                );
                $this->db->insert('invoices',$invoice);
                $invoice_id = $this->db->insert_id();
        //here for put ordered items in orders table

            foreach ($no_of_product_list as $datas) {

            $result = $this->db->where('pro_id',$datas['pro_id'])
                            ->limit(1)
                            ->get('products');

            if(!$result->num_rows()){
                return false;
            }

                    $getProduct = $result->row_array();
                    $price = $getProduct['pro_price'];
                    $discount = $getProduct['pro_discount'];
                    if($getProduct['pro_discount_type'] == 'concrete')
                    {
                        $getProduct['discounted_price'] = $datas['qty']*($price - $discount);
                    } else{
                        $percentage = ($price*$discount)/100;
                        $getProduct['discounted_price'] = $datas['qty']*($price - $percentage);
                    }

                    if (!$this->db->insert('order_details', array(
                        'invoice_id'        => $invoice_id,
                        'order_id'          => $order_id,
                        'product_id'        => $datas['pro_id'],
                        'product_type'      => $getProduct['pro_name'],
                        'product_title'     => $getProduct['pro_title'],
                        'qty'               => $datas['qty'],
                        'price'             => $getProduct['pro_price'],
                        'discout_price'     => $getProduct['pro_discount'],
                        'sell_price'        => $getProduct['discounted_price']
                         ))){
            log_message('error', print_r($this->db->error(), true));
                }
                $order_id = $this->db->insert_id();
                
            }
        }
        return true;
       }
       else{
        return false;
       } 
    }
    public function all_invoices()
    { // get all orders from orders tble
        $get_orders = $this->db->get('invoices');
            if($get_orders->num_rows() > 0 ) {
                    return $get_orders->result();
            } else {
                     return array();
            }
    }
    public function get_invoice_by_id($invoice_id)
    {
        $get_invoice_by = $this->db->where('id',$invoice_id)->limit(1)->get('invoices');
        if($get_invoice_by->num_rows() > 0 ) {
                    return $get_invoice_by->result();
            } else {
                     return FALSE;
                    }
    }
    
    public function get_orders_by_invoice($order_id)
    {
        $get_orders_by = $this->db->where('order_id',$order_id)->get('order_details');
        if($get_orders_by->num_rows() > 0 ) {
                    return $get_orders_by->result();
            } else {
                     return FALSE;
                    }
    }

}
