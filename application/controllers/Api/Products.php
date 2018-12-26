<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/API_Controller.php';

class Products extends API_Controller
{

    private $allowed_img_types;

    function __construct()
    {
        parent::__construct();

         $this->load->model('Api_model');
         $this->allowed_img_types = $this->config->item('allowed_img_types');

    }

    /* Create User */

    public function createusers()
    {
        $errors = [];

        if($_POST){
             if (!isset($_POST['usr_name']) || empty($_POST['usr_name'])) {
            $errors[] = 'No User Name array or empty';
            }
            if (!isset($_POST['usr_password']) || empty($_POST['usr_password'])) {
                $errors[] = 'No Password array or empty';
            }

            if (!isset($_POST['usr_group'])) {
                $errors[] = 'usr_group not found';
            }


            if (!empty($errors)) {
                $error = implode(", ", $errors);
                header('Content-Type: application/json');
                echo json_encode(  $error );
            } 
            else {
                $this->Api_model->register_new($_POST);
                $response = array();
                $response['error'] = false;
                $response['message'] = "User created";
                header('Content-Type: application/json');
                echo json_encode(  $response );
            }
        } else {
             $response = array();
            $response['error'] = true;
            $response['message'] = "Invalid request";
            header('Content-Type: application/json');
            echo json_encode(  $response );
        }

    }


    /*  Get the list of products */

    public function allProductList()
    {
        $products = $this->Api_model->getProducts();
        // Check if the products data store contains products (in case the database result returns NULL)

        if ($products) {
            // Set the response and exit
            header('Content-Type: application/json');
            echo json_encode( $products );
        } else {
            // Set the response and exit
            $response = array();
            $response['status'] = false;
            $response['message'] = "No product were found";
            header('Content-Type: application/json');
            echo json_encode(  $response );
        }
    }

    /* Get the list of products and respective prices for customers */

    public function customerProductList()
    {
        $products = $this->Api_model->getProducts();
        // Check if the products data store contains products (in case the database result returns NULL)
        $response = array();
        if ($products) {
            foreach($products as $product){
                $price = $product['pro_price'];
                $discount = $product['pro_discount'];
                if($product['pro_discount_type'] == 'concrete')
                {
                    $product['discounted_price'] = $price - $discount;
                } else{
                    $percentage = ($price*$discount)/100;
                    $product['discounted_price'] = $price - $percentage;
                }

                array_push($response, $product); 
            }
            header('Content-Type: application/json');
            echo json_encode( $response );
        } else {
            // Set the response and exit

            $response = array();
            $response['status'] = false;
            $response['message'] = "No product were found";
            header('Content-Type: application/json');
            echo json_encode(  $response );
        }
    }

    /* Get One Product for Customer */

    public function customerProductView($id)
    {
        $product = $this->Api_model->getProduct($id);

        if ($product) {

            $price = $product['pro_price'];
            $discount = $product['pro_discount'];
                if($product['pro_discount_type'] == 'concrete')
                {
                    $product['pro_price'] = $price - $discount;
                } else{
                    $percentage = ($price*$discount)/100;
                    $product['pro_price'] = $price - $percentage;
                }

            header('Content-Type: application/json');
            echo json_encode( $product );
        } else {

            $response = array();
            $response['status'] = false;
            $response['message'] = "No product were found";
            header('Content-Type: application/json');
            echo json_encode(  $response );

        }
    }


    /* Create Product */

    public function createproduct()
    {
        $errors = [];

        //$_POST['image'] = $this->uploadImage();
        
        if (!isset($_POST['pro_name']) || empty($_POST['pro_name'])) {
            $errors[] = 'No pro_name array or empty';
        }
        if (!isset($_POST['pro_title']) || empty($_POST['pro_title'])) {
            $errors[] = 'No pro_title array or empty';
        }
        if (!isset($_POST['pro_description']) || empty($_POST['pro_description'])) {
            $errors[] = 'No description array or empty';
        }
        if (!isset($_POST['pro_price']) || empty($_POST['pro_price'])) {
            $errors[] = 'No pro_price array or empty';
        }

        if (!isset($_POST['pro_stock'])) {
            $errors[] = 'pro_stock not found';
        }

        if (!isset($_POST['pro_discount'])) {
            $errors[] = 'pro_discount not found';
        }

        if (!isset($_POST['pro_discount_type'])) {
            $errors[] = 'pro_discount_type not found';
        }

        if (!empty($errors)) {
            $error = implode(", ", $errors);
            header('Content-Type: application/json');
            echo json_encode(  $error );
        } 
        else {
            $createProduct = $this->Api_model->setProduct($_POST);
                $response = array();
                $response['status'] = true;
                $response['message'] = "Product added";
                header('Content-Type: application/json');
                echo json_encode(  $response );
        }
    }
 

    // private function uploadImage()
    // {
    //     $config['upload_path'] = './assets/uploads/';
    //     $config['allowed_types'] = $this->allowed_img_types;
    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);
    //     if (!$this->upload->do_upload('pro_img')) {
    //         log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
    //     }
    //     $img = $this->upload->data();
    //     return $img['file_name'];
    // }

    public function product_update($id)
    {
        $id = (int) $id;
        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $response = array();
            $response['status'] = false;
            $response['message'] = "No id were found";
            header('Content-Type: application/json');
            echo json_encode(  $response );
        }

        $this->Api_model->updateProduct($id,$_POST);

            $response = array();
            $response['status'] = true;
            $response['id'] = $id;
            $response['message'] = "Product updated";
            header('Content-Type: application/json');
            echo json_encode(  $response );
    }

    public function product_delete($id)
    {
        $id = (int) $id;
        // Validate the id.
        if ($id <= 0) {
            $response = array();
            $response['status'] = false;
            $response['message'] = "No id were found";
            header('Content-Type: application/json');
            echo json_encode(  $response );
        }
        $this->Api_model->deleteProduct($id);

            $response = array();
            $response['status'] = true;
            $response['id'] = $id;
            $response['message'] = "Product deleted";
            header('Content-Type: application/json');
            echo json_encode(  $response );
    }

    public function orderItem()
    {
            $orderItem = $this->Api_model->process($_POST);
        
            $response = array();
            if($orderItem){
                $response['status'] = true;
                $response['message'] = "Order Placed";
                header('Content-Type: application/json');
                echo json_encode(  $response );
            } else{
                $response['status'] = false;
                $response['message'] = "Order not placed";
                header('Content-Type: application/json');
                echo json_encode(  $response );
            }
            
        }

    public function get_invoice_by_id($id)
    {
        $id = (int) $id;
        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $response = array();
            $response['status'] = false;
            $response['message'] = "No id were found";
            header('Content-Type: application/json');
            echo json_encode(  $response );
        }
        $invoice = $this->Api_model->get_invoice_by_id($id);
        if ($invoice) {
            // Set the response and exit
            header('Content-Type: application/json');
            echo json_encode( $invoice );
        } else {
            // Set the response and exit

            $response = array();
            $response['status'] = false;
            $response['id'] = $id;
            $response['message'] = "No invoices were found";
            header('Content-Type: application/json');
            echo json_encode(  $response );
        }
    }

    public function get_orders_by_order_id($id)
    {
        $id = (int) $id;
        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $oreders = $this->Api_model->get_orders_by_invoice($id);
        if ($oreders) {
            // Set the response and exit
            header('Content-Type: application/json');
            echo json_encode( $oreders );
        } else {
            // Set the response and exit

            $response = array();
            $response['status'] = false;
            $response['id'] = $id;
            $response['message'] = "No oreders were found";
            header('Content-Type: application/json');
            echo json_encode(  $response );
        }
    }

    public function bundleProduct()
    {

            $orderItem = $this->Api_model->bundleProduct($_POST);
        
            $response = array();
                $response['status'] = true;
                $response['message'] = "Bundle Created";
                header('Content-Type: application/json');
                echo json_encode(  $response );
           
            
        }

}
