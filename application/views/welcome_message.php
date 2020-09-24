<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Login Sikop</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Fullscreen Background Image Slideshow with CSS3 - A Css-only fullscreen background image slideshow" />
        <meta name="keywords" content="css3, css-only, fullscreen, background, slideshow, images, content" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset_login/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset_login/css/style1.css" />
<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet"> 
<script src="<?= base_url() ?>assets/js/jquery-2.1.4.min.js"></script>



        <script type="text/javascript" src="<?= base_url() ?>asset_login/js/modernizr.custom.86080.js"></script>

    </head>
    <body id="page">
        <ul class="cb-slideshow">
            <li ><span></span><div>
            <h2 style="float:left;margin-top:-35%; margin-left: 20px;">Koperasi Sukses Jaya</h2>
            <h6>blabla</h6>

            </div>
            </li>
            <li><span></span><div><h6>qui·e·tude</h6></div></li>
            <li><span></span><div><h6>bal·ance</h6></div></li>
        </ul>
            <div style="float: right;" class="container">    
        <div id="loginbox" style="float: left;margin-left: 20%; margin-top: 16%;" class="mainbox col-md-5">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" action="<?php echo base_url().'login/aksi_login'; ?>" method="post">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">                                        
                                    </div>
                                
                            <div style="margin-bottom: 6px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>
                                    <h6 style="float:left;color:blue; margin-left: 10px">&nbsp;Show Password<a id="showme" style="float:left;background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;"><i class="fa fa-eye"></i></a></h6>
                                    



                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <a id="btn-fblogin" href="#" class="btn btn-primary">Silahkan Login</a>

                                    </div>
                                </div>
  
                            </form>     



                        </div>                     
                    </div>  
        </div>
 
    </div>
    </body>
    <script type="text/javascript">
        $('#showme').on('mouseenter',function(){
    
    $('#password').attr('type','text');
  
});

$('#showme').on('mouseleave',function(){
    
    $('#password').attr('type','password');
  
});
    </script>
</html>
