<!DOCTYPE html>
<html>
    <head>
        <title>Login Sikop</title>
        <meta charset="UTF-8">
<script src="<?= base_url() ?>assets/js/jquery-2.1.4.min.js"></script>
<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="<?= base_url() ?>assets/css/font-awesome.css" rel="stylesheet"> 
<script type="text/javascript" src="<?=base_url()?>asset_login/js/background.cycle.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("body").backgroundCycle({
                    imageUrls: [
                        'asset_login/res/img/bg1.jpg',
                        'asset_login/res/img/bg2.jpg',
                        'asset_login/res/img/bg3.jpg'
                    ],
                    fadeSpeed: 2000,
                    duration: 5000,
                    backgroundSize: SCALING_MODE_COVER
                });
            });
        </script>
    </head>
    <body style="margin: 0;">
        <div style="float: right;" class="container">    

                    <b><h1 style="color:white;margin-left: 24%;">Koperasi Sukses Jaya</h1>
        <div id="loginbox" style="margin-left: 20%;margin-top:10%;" class="mainbox col-md-5">                    
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
                                      <center><button type="submit" class="btn btn-primary">Silahkan Login</button></center>

                                    </div>
                                </div>
  
                            </form> 




                        </div>

                    </div>
        </div>
 
    </div>
            
        
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">
        $('#showme').on('mouseenter',function(){
    
    $('#password').attr('type','text');
  
});

$('#showme').on('mouseleave',function(){
    
    $('#password').attr('type','password');
  
});
    </script>

    </body>
</html>
