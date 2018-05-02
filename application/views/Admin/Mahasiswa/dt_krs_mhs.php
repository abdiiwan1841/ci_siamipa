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
<script type="text/javascript">

function get_akrs(){
     $("#akrs").html('<?php echo $box_loading->display(); ?>');
     var vmyajax = new myajax();
         vmyajax.url = "akrs";
         vmyajax.data = "";
         vmyajax.dataType = 'html';
         vmyajax.success = function success(data) {
          $("#akrs").html(data);
          var vmydatatable = new mydatatable;
              vmydatatable.id = "tb_krs";
              vmydatatable.template = 1;
              vmydatatable.title = 2;
              mydatatable.bAutoWidth= false;
              vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                     
                                     ];    
              vmydatatable.settemplate();
              vmydatatable.create();
         }
         vmyajax.getdata();
}

function get_atdkkrs(){
     $("#atdkkrs").html('<?php echo $box_loading->display(); ?>');
     var vmyajax = new myajax();
         vmyajax.url = "atdkkrs";
         vmyajax.data = "";
         vmyajax.dataType = 'html';
         vmyajax.success = function success(data) {
          $("#atdkkrs").html(data);
          var vmydatatable = new mydatatable;
              vmydatatable.id = "tb_krs1";
              vmydatatable.template = 1;
              vmydatatable.title = 2;
              mydatatable.bAutoWidth= false;
              vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                     
                                     ];    
              vmydatatable.settemplate();
              vmydatatable.create();
         }
         vmyajax.getdata();
}

function get_lkrs(){
     $("#lkrs").html('<?php echo $box_loading->display(); ?>');
     var vmyajax = new myajax();
         vmyajax.url = "lkrs";
         vmyajax.data = "";
         vmyajax.dataType = 'html';
         vmyajax.success = function success(data) {
          $("#lkrs").html(data);
          var vmydatatable = new mydatatable;
              vmydatatable.id = "tb_krs2";
              vmydatatable.template = 1;
              vmydatatable.title = 2;
              mydatatable.bAutoWidth= false;
              vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                     
                                     ];    
              vmydatatable.settemplate();
              vmydatatable.create();
         }
         vmyajax.getdata();
}

function get_ltdkkrs(){
     $("#ltdkkrs").html('<?php echo $box_loading->display(); ?>');
     var vmyajax = new myajax();
         vmyajax.url = "ltdkkrs";
         vmyajax.data = "";
         vmyajax.dataType = 'html';
         vmyajax.success = function success(data) {
          $("#ltdkkrs").html(data);
          var vmydatatable = new mydatatable;
              vmydatatable.id = "tb_krs3";
              vmydatatable.template = 1;
              vmydatatable.title = 2;
              mydatatable.bAutoWidth= false;
              vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                     
                                     ];    
              vmydatatable.settemplate();
              vmydatatable.create();
         }
         vmyajax.getdata();
}

 function pilih_mtk(kode){
   
   if($('#mk_'+kode).is(':checked'))
     { 
       $('#kls_'+kode).attr('disabled', false);    
       cek=1;
     }else{
       $('#kls_'+kode).attr('disabled', true);     
       cek=0;
     }

     var vmyajax = new myajax();
     vmyajax.url = "pilih_mtk_krs";
     vmyajax.data = 'kode='+kode+'&cek='+cek;
     vmyajax.dataType = 'JSON';
     vmyajax.success = function success(data) {
        $("#jmlsks").html(data.jmlsks);
     }
     vmyajax.getdata();
 }

 function input_kls(kode){
     
     kls = $('#kls_'+kode).val();

     var vmyajax = new myajax();
     vmyajax.url = "input_kls";
     vmyajax.data = 'kode='+kode+'&kls='+kls;
     vmyajax.dataType = 'JSON';
     vmyajax.success = function success(data) {
        
     }
     vmyajax.getdata();

 }


 function edit(var_nim)
 {
     $("#frmedt").html('<?php echo $box_loading->display(); ?>');
     nim=var_nim;
     var vmyajax = new myajax();
         vmyajax.url = "edt_dt_krs";
         vmyajax.data = "nim="+nim;
         vmyajax.dataType = 'html';
         vmyajax.success = function success(data) {
          $("#frmedt").html(data);
          var vmydatatable = new mydatatable;
              vmydatatable.id = "lst_krs";
              vmydatatable.template = 1;
              vmydatatable.title = 2;
              mydatatable.bAutoWidth= false;
              vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                   
                                     ];    
              vmydatatable.settemplate();
              vmydatatable.create();

               $('#close').click(function () {
                  $("#frmedt").html('');
               });


              $('#ambil').click(function () {
                 $('#data1').html('<?php echo $box_loading->display(); ?>');
                 var vmyajax = new myajax();
                     vmyajax.url = "ambil_mtk_krs";
                     vmyajax.data = "nim="+nim;
                     vmyajax.dataType = 'json';
                     vmyajax.success = function success(data) {
                         $("#data1").html(data.lst_mtk);
                         $("#btn").html(data.btn);
                        var vmydatatable = new mydatatable;
                            vmydatatable.id = "lst_mtk";
                            vmydatatable.template = 1;
                            vmydatatable.title = 2;
                            mydatatable.bAutoWidth= false;
                            vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                  
                                     ];    
                            vmydatatable.settemplate();
                            vmydatatable.create();

                            $('#save_ambil').click(function () {
                                var vmyajax = new myajax();
                                    vmyajax.url = "save_ambil";
                                    vmyajax.data = "nim="+nim;
                                    vmyajax.dataType = 'json';
                                    vmyajax.success = function success(data) {
                                        if(data.msg!=''){
                                           $("#ketkrs").html(data.msg);
                                        }else{
                                          edit(nim);
                                        }                        

                                    }
                                    vmyajax.getdata();                 
                            });


                            $('#cancel').click(function () {
                               edit(nim);
                            });
                     }
                     vmyajax.getdata();
              });

              $('#ulang').click(function () {
                 $('#data1').html('<?php echo $box_loading->display(); ?>');
                 var vmyajax = new myajax();
                     vmyajax.url = "ulang_mtk_krs";
                     vmyajax.data = "nim="+nim;
                     vmyajax.dataType = 'json';
                     vmyajax.success = function success(data) {
                         $("#data1").html(data.lst_mtk);
                         $("#btn").html(data.btn);
                        var vmydatatable = new mydatatable;
                            vmydatatable.id = "lst_mtk";
                            vmydatatable.template = 1;
                            vmydatatable.title = 2;
                            mydatatable.bAutoWidth= false;
                            vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                  
                                     ];    
                            vmydatatable.settemplate();
                            vmydatatable.create();

                            $('#save_ulang').click(function () {
                                var vmyajax = new myajax();
                                    vmyajax.url = "save_ulang";
                                    vmyajax.data = "nim="+nim;
                                    vmyajax.dataType = 'json';
                                    vmyajax.success = function success(data) {
                                       if(data.msg!=''){
                                           $("#ketkrs").html(data.msg);
                                        }else{
                                          edit(nim);
                                        }   
                                    }
                                    vmyajax.getdata();                 
                            });

                            $('#cancel').click(function () {
                               edit(nim);
                            });   
                     }
                     vmyajax.getdata();
              });  

              $('#edit').click(function () {
                 $('#data1').html('<?php echo $box_loading->display(); ?>');
                 var vmyajax = new myajax();
                     vmyajax.url = "kelas_mtk_krs";
                     vmyajax.data = "nim="+nim;
                     vmyajax.dataType = 'json';
                     vmyajax.success = function success(data) {
                         $("#data1").html(data.lst_mtk);
                         $("#btn").html(data.btn);
                        var vmydatatable = new mydatatable;
                            vmydatatable.id = "lst_mtk";
                            vmydatatable.template = 1;
                            vmydatatable.title = 2;
                            mydatatable.bAutoWidth= false;
                            vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                 
                                     ];    
                            vmydatatable.settemplate();
                            vmydatatable.create();

                            $('#save_kelas').click(function () {
                                var vmyajax = new myajax();
                                    vmyajax.url = "save_kelas";
                                    vmyajax.data = "nim="+nim;
                                    vmyajax.dataType = 'json';
                                    vmyajax.success = function success(data) {
                                      $("#ketkrs").html(data.msg);
                                    }
                                    vmyajax.getdata();                 
                            });

                            $('#cancel').click(function () {
                               edit(nim);
                            });
                     }
                     vmyajax.getdata();
              });

              $('#hapus').click(function () {
                 $('#data1').html('<?php echo $box_loading->display(); ?>');
                 var vmyajax = new myajax();
                     vmyajax.url = "hapus_mtk_krs";
                     vmyajax.data = "nim="+nim;
                     vmyajax.dataType = 'json';
                     vmyajax.success = function success(data) {
                         $("#data1").html(data.lst_mtk);
                         $("#btn").html(data.btn);
                        var vmydatatable = new mydatatable;
                            vmydatatable.id = "lst_mtk";
                            vmydatatable.template = 1;
                            vmydatatable.title = 2;
                            mydatatable.bAutoWidth= false;
                            vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"}                                 
                                     ];    
                            vmydatatable.settemplate();
                            vmydatatable.create();

                            $('#del_krs').click(function () {
                                var vmyajax = new myajax();
                                    vmyajax.url = "hapus_krs";
                                    vmyajax.data = "nim="+nim;
                                    vmyajax.dataType = 'json';
                                    vmyajax.success = function success(data) {
                                      $("#ketkrs").html(data.msg);
                                    }
                                    vmyajax.getdata();                 
                            });

                            $('#cancel').click(function () {
                               edit(nim);
                            });
                     }
                     vmyajax.getdata();
              });  



        }
      vmyajax.getdata();

 }

 $(function () {
   FastClick.attach(document.body);
   get_akrs();

    $('#tb2 a[data-toggle="tab"]').on('shown.bs.tab', function(e){
       get_akrs(); 
       get_atdkkrs();       
    });

    $('#tb1 a[data-toggle="tab"]').on('shown.bs.tab', function(e){
       get_lkrs(); 
       get_ltdkkrs();       
    });

    $('#tb a[data-toggle="tab"]').on('shown.bs.tab', function(e){
       get_lkrs();
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
        Kartu Rencana Studi (KRS)        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Mahasiswa</a></li>
        <li class="active">Kartu Rencana Studi (KRS)</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php
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

          
          $frm = new html_form();
           $button='';
           if($hak==1){
                    $button=$frm->addInput('submit',"mig","KRS - (TRNLM,TRNLM_TRNLP)",array('class'=>'btn btn-info pull-left','id'=>'Mig')).
                    $frm->addInput('submit',"del","DELETE KRS (TA-1)",array('class'=>'btn btn-info pull-left','id'=>'Del'));
                   } 

          $box=array('class'=>'');
          $header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));

          $vmythnsem = new mythnsem;
          $header_box['title']='Kartu Rencana Studi (KRS) '.$vmythnsem->gettxtthnsem();
          $tempbox=new box($box,$header_box,$body,$button);           
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
