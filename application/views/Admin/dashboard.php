<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIAMIPA | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <?php 
       $jscss = new js_css; 
       echo $jscss->display(array('bootstrap','default','icon','all_skin','canvas','fastclick','icon_unibba'));
  ?>
    
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<!-- Sparkline 
<script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>-->
<!-- jvectormap 
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>-->
<!-- SlimScroll 1.3.0 
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>-->
<!-- ChartJS 1.0.1 
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="<?php echo base_url();?>assets/dist/js/pages/dashboard2.js"></script>-->
<!-- AdminLTE for demo purposes 
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/siamipa.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/Admin/frm_sum_exec.js"></script>

<script type="text/javascript">
 $(function () {
          FastClick.attach(document.body);

          fgambarchart("chartContainer", 1);
          fgambarchart("chartContainer1", 2);
          fgambarchart("chartContainer2", 3);
          fgambarchart1("chartContainer3", 4);
          fgambarchart1("chartContainer4", 5);
          fgambarchart1("chartContainer5", 6);
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
        Summary Executive        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Admin</a></li>
        <li class="active">Summary Executive</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php
                   $box=array('class'=>'');
                   $header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));
                   
                   $box1=array('class'=>'box-danger box-solid');
                   $header_box1 = array('class'=>'','title'=>'Loading...');
                   $overlay = array('class'=>'overlay','icon'=>'fa fa-refresh fa-spin');
                   $body6 = 'Loading Data';                    
                   $box_loading=new box($box1,$header_box1,$body6,'',$overlay); 
                   
                   $body3="<div id='chartContainer' style='height: 300px; width: 100%'>".$box_loading->display()."</div>";  
                   $header_box['title']='Jumlah Mahasiswa Aktif Sem. Berjalan';                   
                   $tempbox=new box($box,$header_box,$body3); 
                   $content2=array(array($tempbox->display()));

                   $body4="<div id='chartContainer1' style='height: 300px; width: 100%'>".$box_loading->display()."</div>";   
                   $header_box['title']='Jumlah Mahasiswa Aktif 20081-sekarang';
                   $header_box['tools'][0]['icon']='fa fa-plus';
                   $box['class']='collapsed-box';                   
                   $tempbox=new box($box,$header_box,$body4); 
                   $content2[]=array($tempbox->display()); 

                   $body5="<div id='chartContainer2' style='height: 300px; width: 100%'>".$box_loading->display()."</div>"; ;  
                   $header_box['title']='Status Mahasiswa';                   
                   $tempbox=new box($box,$header_box,$body5); 
                   $content2[]=array($tempbox->display()); 


                   $row = array('jml'=>3);
                   $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   $divrowcol = new div_row_col($row,$col,$content2);
                   $content1[]=$divrowcol->display();              
                   
                   $body3="<div id='chartContainer3' style='height: 300px; width: 100%'>".$box_loading->display()."</div>";   
                   $header_box['title']='Jumlah Penerimaan Perbulan';
                   $header_box['tools'][0]['icon']='fa fa-minus';
                   $box['class']='';                   
                   $tempbox=new box($box,$header_box,$body3); 
                   $content2=array(array($tempbox->display()));

                   $body4="<div id='chartContainer4' style='height: 300px; width: 100%'>".$box_loading->display()."</div>";   
                   $header_box['title']='Jumlah Penerimaan Perangkatan';
                   $header_box['tools'][0]['icon']='fa fa-plus';
                   $box['class']='collapsed-box';                   
                   $tempbox=new box($box,$header_box,$body4); 
                   $content2[]=array($tempbox->display()); 

                   $body5="<div id='chartContainer5' style='height: 300px; width: 100%'>".$box_loading->display()."</div>";   
                   $header_box['title']='Jumlah Penerimaan Perakun';                   
                   $tempbox=new box($box,$header_box,$body5); 
                   $content2[]=array($tempbox->display()); 

                   $row = array('jml'=>3);
                   $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   $divrowcol = new div_row_col($row,$col,$content2);
                   $content1[]=$divrowcol->display(); 

                   $header = array('Rekap Status Mahasiswa','Rekap Keuangan');                   
                   $mytabs = new mytabs('tb',$header,$content1);
                   echo $mytabs->display();
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
