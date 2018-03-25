<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIAMIPA | Login Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">
  <link rel="icon" href="<?php echo base_url();?>assets/img/unibba.ico" type="image/x-icon">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    Login Admin
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
     <div id='msg'>
       
     </div>          
    <p class="login-box-msg">Masukkan username dan password untuk login</p>

    <form action="#" method="post" id="login">
      <div class="form-group has-feedback">
        <input type="text" name="user" value="" class="form-control" placeholder="Username" data-msg="Username Harus Diisi !!!"  required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pass" value="" class="form-control" placeholder="Password" data-msg="Password Harus Diisi !!!"  required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
         
         <div class="col-xs-4">
          <button type="submit" name="login" value="login" class="btn btn-primary btn-block btn-flat" >Login</button>
         </div>
         <div class="col-xs-5">
         <!-- <button type="button" name="reset" class="btn btn-primary btn-block btn-flat">Reset</button> -->
           
              <a href="<?php echo base_url();?>index.php/Wisudawan_dashboard/lupa">Lupa Password ?</a>
           
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script>
  
 function myajax(id,data1,url,fbefore=null,fafter=null) {
        
        if(fbefore != null){
            if(typeof fbefore==='function'){
               fbefore();
            }
        }
        
        $.ajax({
            "type" : "post",
            "url" : url,
            "cache" : false,
            "data" : data1,
            success : function (data) {
                if(id!=''){                  
                  $('#'+id).html(data);
                }
                
                if(fafter != null){
                    if(typeof fafter==='function'){
                       fafter(data);
                    }
                }
            }
        });
     }


  function after($data)
  {
    if($data=="")
    {
      window.location.replace("<?php echo base_url();?>Admin/admin_sum_exec");
    }
  }

  $(function () {
    
    var lati=0.0,longi=0.0;

    function success(position) {
       lati=position.coords.latitude;
       longi=position.coords.longitude; 
    }

    function error(msg) {   

      // console.log(arguments);
    }   

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(success, error);
    } else {}


   $("#login").validate();
   $( "#login" ).submit(function(e) {
        var isvalid = $("#login").valid();
        if (isvalid) {            
           data= $("#login").serialize()+'&lati='+lati+'&longi='+longi;
           myajax('msg',data,'<?php echo base_url();?>Admin/cek_login',null,after);
        }
      e.preventDefault();
    });
  
  });
</script>
</body>
</html>
