<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    
		<meta name="description" content="">
	    <meta name="author" content="">

	    <link rel="icon" href="assets/system_images/<?php echo $this->db->get_where('setting' , array('setting_id' => '2'))->row()->value; ?>">

	    <title><?php echo $this->db->get_where('setting' , array('setting_id' => '1'))->row()->value; ?></title>

	   	<?php include 'includes_top.php'; ?> 

	   	<style type="text/css">
	   		<?php $background_id = $this->db->get_where('user' , array('user_id' => $this->session->userdata('user_id')))->row()->background_id; ?>
	        body{
	           background-image: url("assets/backgrounds/<?php echo $this->db->get_where('background' , array('background_id' => $background_id))->row()->name; ?>");
	           background-size: cover;
	           font-family: 'Roboto Slab', serif;
	        }

          	#screen{
          	   background-image: url("assets/system_images/screen.png");
          	}
        </style>
  	</head>

  	<body>
	    <div class="container" style="margin-top: 4%">
	    	<div class="table-responsive">
			  	<table class="table table-bordered">
			    	<tbody>
			    		<tr>
			    			<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2" id="menu">
			    				<?php include 'menu_items.php'; ?>
			    			</td>
			    			<td class="col-xs-2 col-sm-2 col-md-10 col-lg-10" id="screen">
			    				<?php include $page_name . '.php' ?>

	    						<?php include 'modal.php'; ?>
			    			</td>
			    		</tr>
			    	</tbody>
			  	</table>
			</div>
	    </div> 
	</body>

	<?php include 'includes_bottom.php'; ?>

</html>