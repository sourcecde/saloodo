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
pro_name:hjgj
pro_title:hjhj
pro_description:kkh
pro_price:787
pro_stock:5
pro_discount:65
Pro_discount_type:concrete

Pro_discount_type should be concrete/percentage
### Method: POST

