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

<script type="text/javascript">
 
  function filter()
  {
     var nim = $("#Mhs").val();
     
     $("#data").html('<?php echo $box_loading->display(); ?>');
     var vmyajax = new myajax();
     vmyajax.url = "transkrip";
     vmyajax.data = "nim="+nim;
     vmyajax.dataType = 'JSON';
     vmyajax.success = function success(data) {
          $("#nmmhs").html(data.nm);
          $("#data").html(data.table);
          
          var vmydatatable = new mydatatable;
              vmydatatable.id = 'tb_trans';
              vmydatatable.template = 1;
              vmydatatable.title = 1;
              vmydatatable.bPaginate = true;
              vmydatatable.bInfo = true;
              vmydatatable.bFilter= true;
              vmydatatable.bAutoWidth= false;
              vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},
                                      { "sWidth": "1%"},                                     
                                     ];               
              vmydatatable.settemplate();
              vmydatatable.footerfilter();
              vmydatatable.create();
      }
     vmyajax.getdata();
  } 

 function update_kelas(thnmsmshs) {
  var my_ajax = new myajax;
  my_ajax.url = "transambilkelas";
  my_ajax.data = "thnmsmshs=" + thnmsmshs;
  my_ajax.success = function success(data) {
    $("#kls").html(data);
    var kelas = $("#kls").val();
    update_cmb_mhs(thnmsmshs, kelas);
  }
  my_ajax.getdata();
}

function update_cmb_mhs(thnmsmshs, kelas) {
  var my_ajax = new myajax;
  my_ajax.url = "transambilnm";
  my_ajax.data = "thnmsmshs=" + thnmsmshs + "&kelas=" + kelas;
  my_ajax.success = function success(data) {
    $("#Mhs").html(data);
  }
  my_ajax.getdata();
}


function ctkpdf(nim)
{
  var my_ajax = new myajax;
  my_ajax.url = "trans_ctk_pdf";
  my_ajax.data = "nim="+nim;
  my_ajax.success = function success(data) {
    alert(data);
    window.open(data, 'Download');
  }
  my_ajax.getdata();
}


 $(function () {
     FastClick.attach(document.body);
     filter();
     $("#filter").click(function () {
       filter();
     });

     $("#Angkatan").change(function () {
       var thnmsmshs = $("#Angkatan").val();
       update_kelas(thnmsmshs);
     });

     $("#kls").change(function () {
       var thnmsmshs = $("#Angkatan").val();
       var kelas = $("#kls").val();
       update_cmb_mhs(thnmsmshs, kelas);
     });

     $("#ctkexcel").click(function () {
        var nim = $("#Mhs").val();
        window.location = "trans_ctk_excel/"+nim;        
      });

     $("#ctkpdf").click(function () {
        var nim = $("#Mhs").val();
        ctkpdf(nim);
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
        Transkrip Nilai        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Mahasiswa</a></li>
        <li class="active">Transkrip Nilai</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php
                   
                   $box=array('class'=>'');
                   $header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));

                   $frm = new html_form();
                   $form_group = new form_group("Angkatan",$frm->addSelectList("Angkatan",$lst_ang,true,null,null,array('class'=>'form-control','id'=>'Angkatan')));
                   $content2[0][0] = $form_group->display(); 

                   $form_group = new form_group("Kelas",$frm->addSelectList("kls",$lst_kls,true,null,null,array('class'=>'form-control','id'=>'kls')));
                   $content2[0][1] = $form_group->display();

                   $form_group = new form_group("Mahasiswa",$frm->addSelectList("Mhs",$lst_mhs,true,null,null,array('class'=>'form-control','id'=>'Mhs')));
                   $content2[0][2] = $form_group->display(); 

                   $row = array('jml'=>1);
                   $col = array('jml'=>3,'class'=>array('col-xs-4','col-xs-4','col-xs-4'));
                   $divrowcol = new div_row_col($row,$col,$content2);
                   $body1=$divrowcol->display();

                   $header_box['title']='Filter';                   
                   $tempbox=new box($box,$header_box,$body1,$frm->addInput('submit',"Filter","Filter",array('class'=>'btn btn-info pull-right','id'=>'filter')).
                    $frm->addInput('submit',"ctkexcel","Cetak Ke Excel",array('class'=>'btn btn-info pull-left','id'=>'ctkexcel')).
                    $frm->addInput('submit',"ctkpdf","Cetak Ke Pdf",array('class'=>'btn btn-info pull-left','id'=>'ctkpdf'))); 
                   $content1=array(array($tempbox->display()));                   

                   $body2='<div id="data">'.$box_loading->display().'<div>'; 

                   $header_box['title']='Transkrip : <div id="nmmhs"><div>';
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
