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

  <?php 
       $jscss = new js_css; 
       echo $jscss->display(array('bootstrap','default','icon','all_skin','fastclick','datatables','icon_unibba'));
  ?>

  
  <!-- jvectormap 
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">-->
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

 
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
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/Admin/frm_stat_mhs.js"></script>

<script type="text/javascript">
    function filter()
  {
     var sem = $("#sem").val();
     $("#data").html('<?php echo $box_loading->display(); ?>');
     $("#data1").html('<?php echo $box_loading->display(); ?>');
     call_ajax("filter_stat_mhs","sem=" + sem,'JSON',filter_call);     
  }

 $(function () {
     filter();
     $("#filter").click(function () {
       filter();
     });
  <?php if($hak==1){ ?>   
     $("#add").click(function () {
       var sem = $("#sem").val();
       $("#data").html('<?php echo $box_loading->display(); ?>');
       call_ajax('frm_add',"sem=" + sem,'JSON',add_call);       
     });

     $("#edit").click(function () {
       var sem = $("#sem").val();
       $("#data").html('<?php echo $box_loading->display(); ?>');
       call_ajax('frm_edit',"sem=" + sem,'JSON',edit_call);
     });

     $("#del").click(function () {
       var sem = $("#sem").val();
       $("#data").html('<?php echo $box_loading->display(); ?>');
       call_ajax('frm_del',"sem=" + sem,'JSON',delete_call);
     });

     $("#import").click(function () {
       var sem = $("#sem").val();
       $("#data").html('<?php echo $box_loading->display(); ?>');
       call_ajax('import',"sem=" + sem,'html',gen_call);       
     });

   <?php } ?>  

     $("#ctk").click(function () {
       var sem = $("#sem").val();
       window.location = "cetak/"+sem;       
     });
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
        Status Mahasiswa        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Mahasiswa</a></li>
        <li class="active">Status Mahasiswa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php
                   
                   $box=array('class'=>'');
                   $header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));

                   $frm = new html_form();
                   $form_group = new form_group("Semester",$frm->addSelectList("sem",$lst_sem,true,null,null,array('class'=>'form-control','id'=>'sem')));
                   //$content2 = array(array($form_group->display())); 
                   
                   //$row = array('jml'=>1);
                  // $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   //$divrowcol = new div_row_col($row,$col,$content2);
                   $body1=$form_group->display();

                   $header_box['title']='Filter';                   
                   
                   $button = $frm->addInput('submit',"Filter","Filter",array('class'=>'btn btn-info pull-right','id'=>'filter')).
                    $frm->addInput('submit',"ctk","Cetak Ke Excel",array('class'=>'btn btn-info pull-right','id'=>'ctk'));

                   if($hak==1){
                    $button.=$frm->addInput('submit',"Add","Add",array('class'=>'btn btn-info pull-left','id'=>'add')).
                    $frm->addInput('submit',"Edit","Edit",array('class'=>'btn btn-info pull-left','id'=>'edit')).
                    $frm->addInput('submit',"Delete","Delete",array('class'=>'btn btn-info pull-left','id'=>'del')).
                    $frm->addInput('submit',"Import","TA-1 -> TA",array('class'=>'btn btn-info pull-left','id'=>'import'));
                   } 

                   $tempbox=new box($box,$header_box,$body1,$button); 
                   $content1=array(array($tempbox->display()));                   

                   $body2='<div id="data">'.$box_loading->display().'</div>'; 
                   $footer='<div id="btn"></div>'; 

                   $header_box['title']='Status Mahasiswa :<div id="txt"></div>';
                   $tempbox=new box($box,$header_box,$body2,$footer); 
                   $content1[]=array($tempbox->display());

                   $body3='<div id="data1">'.$box_loading->display().'</div>'; 

                   $header_box['title']='Summarry : <div id="txt1"></div>';
                   $tempbox=new box($box,$header_box,$body3); 
                  $content1[]=array($tempbox->display());

                   $row = array('jml'=>3);
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
