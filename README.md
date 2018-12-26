# Requirements
PHP 5.4.0 or later
#NOTE : if you have php 7 it wii not working as fine  ,
# Installation
<hr>
# Step 1 :

Create database "saloodo" and  import shop-omline.sql to your database
<hr>
# Step 2 :
if you use wammp server create file " saloodo "  inside WWW 
or if you use xampp create file " saloodo " inside htdocs 
<hr>
# Step 3 :
application => config = > config.php

edit  $config['base_url'] = ' your localhost ' ;

application => config = > database.php

edit          'hostname' => 'your localhost',
              'username' => 'root',
	'password' => ''

# API REST interfaces

## Add Product:
URL: http://localhost/saloodo/index.php/api/products/createproduct
### Params:
pro_name:Dell Laptop <br />
pro_title:Computer  <br />
pro_description:Dell Laptop with bags <br />
pro_price:500 <br />
pro_stock:5 <br />
pro_discount:50 <br />
Pro_discount_type:concrete <br />

Pro_discount_type should be concrete/percentage <br />
### Method: POST

## Update Product: 
http://localhost/saloodo/index.php/api/products/product_update/ {id}

### Params:
pro_name:LG TV <br />
pro_title:TV <br />
pro_description:Ne Gen Television <br />
pro_price:787 <br />
pro_stock:5 <br />
pro_discount:65 <br />
Pro_discount_type:concrete <br />

Pro_discount_type should be concrete/percentage
### Method: POST

## Delete Product: 
http://localhost/saloodo/index.php/api/products/product_delete/ {id}

### Method: DELETE


## Get All Product:
http://localhost/saloodo/index.php/api/products/allProductList

### Method: GET



