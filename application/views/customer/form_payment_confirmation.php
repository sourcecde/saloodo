<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Payment Confirmation </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('/assets/css/modern-business.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('/assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation Top_Menu -->
    <?php $this->load->view('layout/navigation')?>
    <!-- Header Carousel -->

    <!-- Page Content -->
    <div class="container">

       <hr>
        <!-- /.row -->
        <div class="row">
                        <!-- body items -->
            <!-- load products from table -->
             <div class="col-md-12">

					<div class="panel panel-default">
						<div class="panel-heading">
								<h3>Payment Confirmation :</h3>  
						</div>
						<div class="panel-body" width="100px">
							<div class="col-md-12">
							<h5>Payment for a friend or enter your invoice id ... !</h5>
								<hr>
								<div class="col-md-3"><?php echo validation_errors() ?>
													  <?php echo $this->session->flashdata('error') ?>
								</div>
								
							<div class="col-md-6">
							<?php echo form_open('customer/payment_confirmation/') ?>
								<div class="form-group">
									<label for="invoice_input">Invoice id : </label>
									<input type="text" class="form-control" name="invoice_id_input" value=<?php echo( $invoice_id != 0 ? $invoice_id:'')?> >
								</div>
								<div class="form-group">
									<label for="amount">Amount Transfered : </label>
									<input type="text" class="form-control" name="amount_input" >
								</div>
								<div class="form-group">
								<div class="col-md-2"></div>
								<div class="col-md-7">
									<button type="submit" class="btn btn-success">Confirm My Payment</button>
									<?php echo  anchor(base_url(),'Cancel',['class'=>'btn']) ?>
									
									</div>
								<div class="col-md-3">
									<?php echo  anchor('customer/shopping_history','Back to history',['class'=>'btn btn-default']) ?>
								</div>
								</div>
							<?php echo form_close() ?>
							</div>
							<div class="col-md-3"></div>
									
									
									
									
							</div>  
							
							
					</div>
					</div>  
			
			</div>
        <!-- /.row -->

        <!-- Features Section -->

        <!-- /.row -->
		</div>
        <hr>

        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-default btn-block" href="#">Report For Buggs</a>
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <?php $this->load->view('layout/footer')?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url('/assets/js/jquery.js');?>"></script>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>