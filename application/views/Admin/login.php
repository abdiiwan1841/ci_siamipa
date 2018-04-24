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
  <?php 
       $jscss = new js_css; 
       echo $jscss->display(array('bootstrap','default','icon','validate','fastclick','icon_unibba'));
  ?>
  
  <!-- iCheck
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">-->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
<!-- iCheck 
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script></script>-->
<script type="text/javascript">
  
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
      window.location.replace("<?php echo base_url();?>Admin/sum_exec");
    }
  }

  $(document).ready(function () {
   var lati=0.0,longi=0.0; 
   FastClick.attach(document.body);
   

   function success(position) {
       lati=position.coords.latitude;
       longi=position.coords.longitude; 
    }

    function error(msg) {
       console.log(arguments);    
    }   

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(success, error);
    } else {

    }  


   $("#login").validate();
   $( "#btnlogin" ).click(function(e) {
        var isvalid = $("#login").valid();
        if (isvalid) {            
           data= $("#login").serialize()+'&lati='+lati+'&longi='+longi;
           myajax('msg',data,'<?php echo base_url();?>Admin/cek_login',null,after);
        }
      e.preventDefault();
    });    

    
  
  });
</script>


</head>
<Body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    Login Admin
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
     <div id='msg'>
       
     </div>          
    <p class="login-box-msg">Masukkan username dan password untuk login</p>

    <form action="" method="post" id="login">
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
          <button type="button" id='btnlogin' name="login" value="login" class="btn btn-primary btn-block btn-flat" style="cursor:pointer" >Login</button>
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

<script type="text/javascript">
   $("#ifrm").remove();
</script>  

</Body>
</html>
