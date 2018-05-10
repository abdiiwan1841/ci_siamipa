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
<script type="text/javascript" src="<?php echo base_url();?>assets/dist/js/Admin/frm_rkrs_mhs.js"></script>
<script type="text/javascript">
 var load = '<?php echo $box_loading->display(); ?>';
 var nim;
 var tb_idx=2;
 var sem;

 function edit(var_nim)
 {
     $("#frmedt").html(load);
     nim=var_nim;
     //sem = $("#sem").val();

        
        switch(tb_idx)
        {
           case 1 : 
                    get_lkrs(); 
                    get_ltdkkrs();
                    break;
           case 2 : 
                    get_akrs(); 
                    get_atdkkrs();
                    break;           
        }


     var vmyajax = new myajax();
         vmyajax.url = "edt_dt_rkrs";
         vmyajax.data = "nim="+nim+'&sem='+sem;
         vmyajax.dataType = 'html';
         vmyajax.success = function success(data) {
          $("#frmedt").html(data);
          init_tb("lst_krs",2);

               $('#close').click(function () {
                  $("#frmedt").html('');
               });


              $('#ambil').click(function () {
                 $('#data1').html(load);
                 call_ajax("ambil_mtk_rkrs","nim="+nim+'&sem='+sem,'json',ambil_call);                                 
              });

              $('#ulang').click(function () {
                 $('#data1').html(load);
                 call_ajax("ulang_mtk_rkrs","nim="+nim+'&sem='+sem,'json',ulang_call);
              });  

              $('#edit').click(function () {
                 $('#data1').html(load);
                 call_ajax("kelas_mtk_rkrs","nim="+nim+'&sem='+sem,'json',edit_call);                 
              });

              $('#hapus').click(function () {
                 $('#data1').html(load);
                 call_ajax("hapus_mtk_rkrs","nim="+nim+'&sem='+sem,'json',hapus_call);
              });  

              $("#ctkexcel").click(function () {
                 window.location = "rkrs_ctk_excel/"+nim+"/"+sem;        
              });

             $("#ctkpdf").click(function () {
                 window.location = "rkrs_ctk_pdf/"+nim+"/"+sem; 
             });

             


        }
      vmyajax.getdata();

 }

  function filter()
  {
     sem = $("#sem").val();
     call_ajax("filter_rkrs","sem=" + sem,'JSON',filter_call);     
  }

 $(function () {
   FastClick.attach(document.body);
   filter();
     $("#filter").click(function () {
       $("#frmedt").html('');
       filter();
     });

    $('#tb2 a[data-toggle="tab"]').on('shown.bs.tab', function(e){
       tb_idx=2;
       get_akrs(); 
       get_atdkkrs();       
    });

    $('#tb1 a[data-toggle="tab"]').on('shown.bs.tab', function(e){
       tb_idx=1;
       get_lkrs(); 
       get_ltdkkrs();       
    });

    $('#tb a[data-toggle="tab"]').on('shown.bs.tab', function(e){
       get_lkrs();
       get_akrs(); 
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
        Riwayat Kartu Rencana Studi (KRS)        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Mahasiswa</a></li>
        <li class="active">Riwayat Kartu Rencana Studi (KRS)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php
          
                   $box=array('class'=>'');
                   $header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));

                   $frm = new html_form();
                   $form_group = new form_group("Semester",$frm->addSelectList("sem",$lst_sem,true,null,null,array('class'=>'form-control','id'=>'sem')));
                   
                   $body1=$form_group->display();

                   $header_box['title']='Filter';                   
                   
                   $button = $frm->addInput('submit',"Filter","Filter",array('class'=>'btn btn-info pull-right','id'=>'filter'));                   

                   $tempbox=new box($box,$header_box,$body1,$button); 
                   echo $tempbox->display();

          echo '<div id="frmedt"></div>';
          
          $content2[]="<div id='akrs' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
          $content2[]="<div id='atdkkrs' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";           

          $header = array('Mengisi KRS','Tidak Mengisi KRS');
          $mytabs = new mytabs('tb2',$header,$content2);
          $content[]=$mytabs->display();          

          $content1[]="<div id='lkrs' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
          $content1[]="<div id='ltdkkrs' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
          
          $mytabs = new mytabs('tb1',$header,$content1);
          $content[]=$mytabs->display();

          $header = array('Mahasiswa Aktif','Mahasiswa Dengan Status Lain');
          $mytabs = new mytabs('tb',$header,$content);
          $body=$mytabs->display(); 

              
           

          $box=array('class'=>'');
          $header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));

          
          $header_box['title']='Kartu Rencana Studi (KRS) <div id="TA"></div>';
          $tempbox=new box($box,$header_box,$body);           
          echo $tempbox->display();
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
