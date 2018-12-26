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

## Create user:
http://localhost/saloodo/index.php/api/products/createusers

### Params
usr_name:debraj <br />
usr_password:debraj1987 (md5 generated value insert into DB) <br />
usr_group:3 <br />
Usr_group should be 1 or 3 .1 for admin and 3 for customers <br />
### Method: POST

## Bundle product
http://localhost/saloodo/index.php/api/products/bundleProduct

### Params
name:suvambasak <br />
price:108 <br />
stock:3 <br />
pro_id:[{"pro_id":"1"},{"pro_id":"4"},{"pro_id":"25"}] <br />

### Method: POST
Prams pro_id takes a JSON string as parameter (Ex.pro_id:”[{"pro_id":"1"},{"pro_id":"4"},{"pro_id":"25"}]“)

![bundle](https://user-images.githubusercontent.com/34945950/50458189-4edf4200-0987-11e9-971e-23411091a71b.JPG)






