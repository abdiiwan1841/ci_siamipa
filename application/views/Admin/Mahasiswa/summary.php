<?php
defined('BASEPATH') OR exit('No direct script access allowed');

            $box=array('class'=>'box-danger box-solid');
            $header_box = array('class'=>'','title'=>'Loading...');
            $overlay = array('class'=>'overlay','icon'=>'fa fa-refresh fa-spin');
            $body = 'Loading Data';                    
            $box_loading=new box($box,$header_box,$body,'',$overlay); 
            

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
       echo $jscss->display(array('bootstrap','default','icon','all_skin','datatables','fastclick','icon_unibba'));
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


<script type="text/javascript">

  function init_tb(namatb, bgroup, idx) {
    vmydatatable = new mydatatable;
    vmydatatable.id = namatb;
    vmydatatable.template = 1;
    vmydatatable.title = bgroup;
    vmydatatable.bPaginate = true;
    vmydatatable.bInfo = true;
    vmydatatable.bFilter= true;
    vmydatatable.bAutoWidth= false;
    vmydatatable.aoColumns= [
                              { "sWidth": "1%" },
                              { "sWidth": "1%" },
                              { "sWidth": "10%"},
                              { "sWidth": "1%"},
                              { "sWidth": "1%" },
                              { "sWidth": "1%" },
                              { "sWidth": "1%"},
                              { "sWidth": "1%"}                                    
                            ];   
            
      vmydatatable.bProcessing = true;
      vmydatatable.bServerSide = true;
      vmydatatable.sAjaxSource = "datatable_ajax";
      vmydatatable.sServerMethod = 'POST';

      vmydatatable.fnServerParams = function (aoData) {
        
        aoData.push({
          "name" : "namatb",
          "value" : namatb
        }
        );        
      };
    

    vmydatatable.settemplate();
    vmydatatable.create();
  }



 function filter()
  {
     var nim = $("#Mhs").val();
     
     var loading = '<?php echo $box_loading->display(); ?>';
          $("#nmmhs").html('');
          $("#sks_sem").html(loading);
          $("#jml_sks").html(loading);
          $("#hit_ipk").html(loading); 
          $("#rstat").html(loading);
          $("#mstud").html(loading);
          $("#pos_keu").html(loading);
          $("#nilaiD").html(loading);
          $("#ulangD").html(loading);
          $("#nilaiE").html(loading);
          $("#ulangE").html(loading);
          $("#nilaiT").html(loading);
          $("#ulangT").html(loading);
          $("#blm_amb").html(loading);

     var vmyajax = new myajax();
     vmyajax.url = "filter_sum_mhs";
     vmyajax.data = "nim="+nim;
     vmyajax.dataType = 'JSON';
     vmyajax.success = function success(data) {
          $("#nmmhs").html(data.nm);
          $("#sks_sem").html(data.sks_sem);
          $("#jml_sks").html(data.jml_sks);
          $("#hit_ipk").html(data.hit_ipk); 
          $("#rstat").html(data.rstat);
          $("#mstud").html(data.mstud);
          $("#pos_keu").html(data.pos_keu);
          $("#nilaiD").html(data.nilaiD);
          $("#ulangD").html(data.ulangD);
          $("#nilaiE").html(data.nilaiE);
          $("#ulangE").html(data.ulangE);
          $("#nilaiT").html(data.nilaiT);
          $("#ulangT").html(data.ulangT);
          $("#blm_amb").html(data.blm_amb);

          var vmydatatable = new mydatatable;
              vmydatatable.id = 'tb_blm_amb';
              vmydatatable.template = 1;
              vmydatatable.title = 0;
              vmydatatable.bPaginate = true;
              vmydatatable.bInfo = true;
              vmydatatable.bFilter= true;
              vmydatatable.bAutoWidth= false;
              vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"}                                    
                                     ];               
              vmydatatable.settemplate();
              vmydatatable.create();

          
      }
     vmyajax.getdata();
  }  
 

function update_kelas(thnmsmshs) {
  var my_ajax = new myajax;
  my_ajax.url = "sumambilkelas";
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
  my_ajax.url = "sumambilnm";
  my_ajax.data = "thnmsmshs=" + thnmsmshs + "&kelas=" + kelas;
  my_ajax.success = function success(data) {
    $("#Mhs").html(data);
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

    init_tb("sumaktif1", 2, 0);
    init_tb("sumaktif2", 2, 0);
    init_tb("sumnonaktif", 2, 0);
    init_tb("sumcuti", 2, 0);
    init_tb("sumlulus", 2, 0);
    init_tb("sumkeluar", 2, 0);

    $('#tb1 a[data-toggle="tab"]').on('shown.bs.tab', function(e){
       $('#tb_blm_amb').dataTable().fnDestroy();
            var vmydatatable = new mydatatable;
              vmydatatable.id = 'tb_blm_amb';
              vmydatatable.template = 1;
              vmydatatable.title = 0;
              vmydatatable.bPaginate = true;
              vmydatatable.bInfo = true;
              vmydatatable.bFilter= true;
              vmydatatable.bAutoWidth= false;
              vmydatatable.aoColumns= [
                                      { "sWidth": "1%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "10%"},
                                      { "sWidth": "1%"}                                    
                                     ];               
              vmydatatable.settemplate();
              vmydatatable.create();
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
        Summary        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Mahasiswa</a></li>
        <li class="active">Summary</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php  
            
            $box=array('class'=>'box-success');
            $header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));
            
            $header = array(array("Angkatan","NIM","Nama","Kelas","SKS","IPK","Batas Studi","Sisa Kewajiban"));
            $tbstat = array("id" => "sumaktif1",'width'=>'100%');
            $tbl = new mytable($tbstat,$header,null,"");//$dataaktif1

            $body=$tbl->display();
            $header_box['title']='IPK > 2.75';                   
            $tempbox=new box($box,$header_box,$body); 
            $content3=array(array($tempbox->display()));

            $tbstat = array("id" => "sumaktif2",'width'=>'100%');
            $tbl = new mytable($tbstat,$header,null,"");//$dataaktif

            $body=$tbl->display();
            $header_box['title']='IPK < 2.75';                 
            $tempbox=new box($box,$header_box,$body); 
            $content3[]=array($tempbox->display());

            
            $box=array('class'=>'');
            $header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));

            $row = array('jml'=>2);
            $col = array('jml'=>1,'class'=>array('col-xs-12'));
            $divrowcol = new div_row_col($row,$col,$content3);
            $body=$divrowcol->display(); 

            $header_box['title']='Mahasiswa Aktif';                   
            $tempbox=new box($box,$header_box,$body); 
            $content2=array(array($tempbox->display()));

            $tbstat = array("id" => "sumnonaktif",'width'=>'100%');
            $tbl = new mytable($tbstat,$header,null,"");//$datanonaktif

            $body=$tbl->display();
            $header_box['title']='Mahasiswa Non Aktif';      
            $tempbox=new box($box,$header_box,$body); 
            $content2[]=array($tempbox->display()); 

            $tbstat = array("id" => "sumcuti",'width'=>'100%');
            $tbl = new mytable($tbstat,$header,null,"");//$datacuti

            $body=$tbl->display();  
            $header_box['title']='Mahasiswa Cuti';           
            $tempbox=new box($box,$header_box,$body); 
            $content2[]=array($tempbox->display()); 

            $tbstat = array("id" => "sumlulus",'width'=>'100%');
            $tbl = new mytable($tbstat,$header,null,"");//$datalulus

            $body=$tbl->display();  
            $header_box['title']='Mahasiswa Lulus';          
            $tempbox=new box($box,$header_box,$body); 
            $content2[]=array($tempbox->display()); 

            $tbstat = array("id" => "sumkeluar",'width'=>'100%');
            $tbl = new mytable($tbstat,$header,null,"");//$datakeluar 

            $body=$tbl->display();  
            $header_box['title']='Mahasiswa Keluar';         
            $tempbox=new box($box,$header_box,$body); 
            $content2[]=array($tempbox->display()); 

            $row = array('jml'=>5);
            $col = array('jml'=>1,'class'=>array('col-xs-12'));
            $divrowcol = new div_row_col($row,$col,$content2);
            $content1[]=$divrowcol->display(); 

                   $header_box['tools'][0]['icon']='fa fa-minus';
                   $box['class']='';

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
                   $body=$divrowcol->display();

                   $header_box['title']='Filter';                   
                   $tempbox=new box($box,$header_box,$body,$frm->addInput('submit',"Filter","Filter",array('class'=>'btn btn-info pull-right','id'=>'filter'))); 
                   $content4=array(array($tempbox->display())); 

                   
                   $body="<div id='sks_sem' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Jumlah IPK,IPS dan SKS Persemester';                   
                   $header_box['tools'][0]['icon']='fa fa-minus';
                   $box['class']='box-success';
                   $tempbox=new box($box,$header_box,$body); 
                   $content6=array(array($tempbox->display()));

                   $body="<div id='jml_sks' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Jumlah SKS';                   
                   $tempbox=new box($box,$header_box,$body); 
                   $content6[]=array($tempbox->display());

                   $body="<div id='hit_ipk' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='IPK anda';
                   $tempbox=new box($box,$header_box,$body); 
                   $content6[]=array($tempbox->display());
                   

                   $body="<div id='mstud' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Lama Masa Studi';
                   $tempbox=new box($box,$header_box,$body); 
                   $content7=array(array($tempbox->display()));

                   $body="<div id='rstat' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Riwayat Status';
                   $tempbox=new box($box,$header_box,$body); 
                   $content7[]=array($tempbox->display());


                   $row = array('jml'=>2);
                   $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   $divrowcol = new div_row_col($row,$col,$content7);
                   $body=$divrowcol->display();
                   
                   $header_box['title']='Riwayat Status';
                   $tempbox=new box($box,$header_box,$body); 
                   $content6[]=array($tempbox->display());

                   $body="<div id='pos_keu' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Posisi Keuangan';
                   $tempbox=new box($box,$header_box,$body); 
                   $content6[]=array($tempbox->display());


                   $row = array('jml'=>5);
                   $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   $divrowcol = new div_row_col($row,$col,$content6);
                   $content5[]=$divrowcol->display();
                   
                   
                   $body="<div id='nilaiD' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Matakuliah dengan nilai D';                   
                   $header_box['tools'][0]['icon']='fa fa-minus';
                   $box['class']='box-success';
                   $tempbox=new box($box,$header_box,$body); 
                   $content6=array(array($tempbox->display()));

                   $body="<div id='ulangD' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Nilai Awal/Mengulang dari matakuliah diatas';                   
                   $tempbox=new box($box,$header_box,$body); 
                   $content6[]=array($tempbox->display());


                   $row = array('jml'=>2);
                   $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   $divrowcol = new div_row_col($row,$col,$content6);
                   $content5[]=$divrowcol->display();                    
                   
                   $body="<div id='nilaiE' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Matakuliah dengan nilai E';                                      
                   $tempbox=new box($box,$header_box,$body); 
                   $content6=array(array($tempbox->display()));

                   $body="<div id='ulangE' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Nilai Awal/Mengulang dari matakuliah diatas';                   
                   $tempbox=new box($box,$header_box,$body); 
                   $content6[]=array($tempbox->display());


                   $row = array('jml'=>2);
                   $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   $divrowcol = new div_row_col($row,$col,$content6);
                   $content5[]=$divrowcol->display();
                   
                   $body="<div id='nilaiT' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Matakuliah dengan nilai T';                                      
                   $tempbox=new box($box,$header_box,$body); 
                   $content6=array(array($tempbox->display()));

                   $body="<div id='ulangT' style='height: 100%; width: 100%'>".$box_loading->display()."</div>";
                   $header_box['title']='Nilai Awal/Mengulang dari matakuliah diatas';                   
                   $tempbox=new box($box,$header_box,$body); 
                   $content6[]=array($tempbox->display());


                   $row = array('jml'=>2);
                   $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   $divrowcol = new div_row_col($row,$col,$content6);
                   $content5[]=$divrowcol->display();
                   
                   $content6=array(array("<div id='blm_amb' style='height: 100%; width: 100%'>".$box_loading->display()."</div>"));
                   $row = array('jml'=>1);
                   $col = array('jml'=>1,'class'=>array('col-xs-12'));
                   $divrowcol = new div_row_col($row,$col,$content6);
                   $content5[]=$divrowcol->display();

                   $header = array('SKS,IPS,IPK,Status,Keuangan','Nilai D','Nilai E','Nilai T','Mata Kuliah Yg Belum Diambil');
                   $mytabs = new mytabs('tb1',$header,$content5);
                   $body=$mytabs->display();                   

                   $header_box['title']='Summary : <div id="nmmhs"><div>';
                   $header_box['tools'][0]['icon']='fa fa-minus';
                   $box['class']='';  
                   $tempbox=new box($box,$header_box,$body); 
                   $content4[]=array($tempbox->display());


            $row = array('jml'=>2);
            $col = array('jml'=>1,'class'=>array('col-xs-12'));
            $divrowcol = new div_row_col($row,$col,$content4);
            $content1[]=$divrowcol->display(); 


            $header = array('Summary Semua Mahasiswa','Summary Per Mahasiswa');                   
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
