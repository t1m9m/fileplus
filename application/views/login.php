<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
        
        <link rel="icon" href="assets/system_images/<?php echo $this->db->get_where('setting' , array('setting_id' => '2'))->row()->value; ?>">

        <title><?php echo $this->db->get_where('setting' , array('setting_id' => '1'))->row()->value; ?></title>

        <!-- DEFAULT STYLESHEET-->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap-theme.css" rel="stylesheet">

        <style type="text/css">
            body{
                background-image: url("assets/system_images/login_background.jpg");
                background-size: cover;
                font-family: 'Roboto Slab', serif;
            }

            .jumbotron{
                margin-top: 50%;
                background-color: black;
            }
        </style>

    </head>

    <body style="background-color: black">
        <div class="col-md-4"></div>
        <div class="col-md-4" align="center">
            <div class="jumbotron" id="login_panel">
                <div class="container">
                    <div style="margin-top:-6%;margin-bottom:6%">
                        <img width="13%" src="assets/system_images/<?php echo $this->db->get_where('setting' , array('setting_id' => '2'))->row()->value; ?>" class="img-circle">
                    </div>
                    
                    <div style="margin-bottom:-6%">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <form action="<?php echo base_url(); ?>index.php?login/signin/" class="form-horizontal" method="post">
                                <div class="form-group">
                                    <input required type="email" name="email" class="form-control" placeholder="Please type your Email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input required type="password" name="password" class="form-control" placeholder="Please type your Password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-block">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </body>

    <!-- DEFAULT JAVASCRIPT -->
    <script src="assets/js/jquery-1.10.2.js" ></script>
    <script src="assets/js/jquery-1.11.3.min.js"></script>
    <script src="assets/js/bootstrap.js" ></script>
    <script src="assets/js/bootstrap.min.js" ></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#login_panel').fadeTo("slow" , '0.6');
        });
    </script> 

</html>







