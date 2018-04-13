<?php
defined('BASEPATH') OR exit('No direct script access allowed');

                   $box1=array('class'=>'box-danger box-solid');
                   $header_box1 = array('class'=>'','title'=>'Loading...');
                   $overlay = array('class'=>'overlay','icon'=>'fa fa-refresh fa-spin');
                   $body6 = 'Loading Data';                    
                   $box_loading=new box($box1,$header_box1,$body6,'',$overlay); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIAMIPA | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="icon" href="<?php echo base_url();?>assets/img/unibba.ico" type="image/x-icon">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="<?php echo base_url();?>assets/dist/js/pages/dashboard2.js"></script>-->
<!-- AdminLTE for demo purposes 
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/siamipa.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script type="text/javascript">

  function submit_button(url_ajax)
  {
                        $("#dtmhs").submit(function(e) {
                              //prevent Default functionality
                              e.preventDefault();
                              var isvalid = $("#dtmhs").valid();
                              if (isvalid) {
                                  var vmyajax = new myajax();
                                  vmyajax.url = url_ajax;
                                  vmyajax.data = $("#dtmhs").serialize();
                                  vmyajax.dataType = 'json';  
                                  vmyajax.success = function success(data) {
                                    if(data.msg==''){
                                         $("#modal").html('');
                                          get_dt_mhs();
                                    }else{ 
                                      $('#ketdtmhs').html(data.msg);
                                    }
                                      
                                  }
                                  vmyajax.getdata();

                              }        
                          });

     $("#close").click(function () {
       $("#modal").html('');
     });
  }

  function get_dt_mhs()
  {
     $("#data").html('<?php echo $box_loading->display(); ?>');
     var vmyajax = new myajax();
     vmyajax.url = "get_dt_mhs";
     vmyajax.dataType = 'html';
     vmyajax.success = function success(data) {
          $("#data").html(data);
              //$("#lst_mhs").dataTable();
              var vmydatatable = new mydatatable;
              vmydatatable.id = 'lst_mhs';
              vmydatatable.template = 1;
              vmydatatable.title = 2;
              vmydatatable.bPaginate = true;
              vmydatatable.bInfo = true;
              vmydatatable.bFilter = true;
         <?php  if($hak==1){ ?>     
              vmydatatable.dom =   "<'row'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>";
              vmydatatable.buttons =  [
            {
                text: 'Input Data Mahasiswa',
                action: function ( e, dt, node, config ) {
                     var vmyajax = new myajax();
                     vmyajax.url = "frm_dt_mhs";
                     vmyajax.data = 'idx=1';
                     vmyajax.success = function success(data) {                 
                          $("#modal").html(data);
                          
                          $('#datepicker').datepicker({
                            format: 'dd-mm-yyyy',
                            autoclose: true
                          });
                          $("[data-mask]").inputmask();                                  

                          $("#dtmhs").validate();
                          submit_button("insert_dt_mhs");                         
                     }                   
                     vmyajax.getdata();
                }
            }
        ]; 

        <?php } ?>
              vmydatatable.settemplate(); 
              vmydatatable.footerfilter();      
              oTable=vmydatatable.create();
     }
     vmyajax.getdata();
  } 
 <?php  if($hak==1){ ?> 
 function edit(nim)
 {
     var vmyajax = new myajax();
     vmyajax.url = "frm_dt_mhs";
     vmyajax.data = 'idx=2'+'&nim='+nim;
     vmyajax.dataType = 'html';
     vmyajax.success = function success(data) {
       $("#modal").html(data);
       $('#datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
       $("[data-mask]").inputmask();      

        $("#dtmhs").validate();
        submit_button('save_dt_mhs');                                 
                                    
     }
     vmyajax.getdata();
 }

 function view(nim)
 {
     var vmyajax = new myajax();
     vmyajax.url = "view_dt_mhs";
     vmyajax.data = 'idx=1'+'&nim='+nim;
     vmyajax.dataType = 'html';
     vmyajax.success = function success(data) {
       $("#modal").html(data);
        $("#close").click(function () {
          $("#modal").html('');
        });
                      
    }
     vmyajax.getdata();
 }

function del(nim)
 {
     var vmyajax = new myajax();
     vmyajax.url = "view_dt_mhs";
     vmyajax.data = 'idx=2'+'&nim='+nim;
     vmyajax.dataType = 'html';
     vmyajax.success = function success(data) {
       $("#modal").html(data);
       
                         $("#dtmhs").submit(function(e) {
                              //prevent Default functionality
                              e.preventDefault();
                              
                                  var vmyajax = new myajax();
                                  vmyajax.url = "delete_dt_mhs";
                                  vmyajax.data = $("#dtmhs").serialize();
                                  vmyajax.dataType = 'html';  
                                  vmyajax.success = function success(data) {
                                      $("#modal").html('');
                                      get_dt_mhs();                                     
                                  }
                                  vmyajax.getdata();
                                      
                          });

                          $("#close").click(function () {
                            $("#modal").html('');
                          });                  
    }
     vmyajax.getdata();
 }

  <?php } ?>

 $(function () {
   get_dt_mhs();  
 }); 


</script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php   
    $this->load->view('Admin/header');
    $this->load->view('Admin/sidebar');  
?>
  
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Mahasiswa        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Mahasiswa</a></li>
        <li class="active">Data Mahasiswa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php
                   
                   $box=array('class'=>'');
                   $header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));                   
                  
                  $content1[]=array("<div id='modal'></div>"); 

                   $header_box['title']='Data Mahasiswa';
                   $body2='<div id="data">'.$box_loading->display().'<div>'; 
                   $tempbox=new box($box,$header_box,$body2); 
                   $content1[]=array($tempbox->display());

                   $row = array('jml'=>2);
                   $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   $divrowcol = new div_row_col($row,$col,$content1);
                   echo $divrowcol->display();   
       ?> 
 

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018 <a href="#">Cecep Suwanda</a>.</strong> All rights
    reserved.
  </footer>

  

</div>
<!-- ./wrapper -->


</body>
</html>
