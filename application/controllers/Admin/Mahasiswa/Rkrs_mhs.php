<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rkrs_mhs extends CI_Controller {

	public function akrs()
	{
       if($this->input->is_ajax_request()){ 
       	  
       	  $sem = $this->input->post('sem');

          $shift = array('R'=>'Reguler','N'=>'Non Reguler');

       	  $vmythnsem = new mythnsem;
          $lst_sem=$vmythnsem->getlstthnsem(20072,$vmythnsem->substhnsem($sem,1));
          $txt_filter = implode(",",array_keys($lst_sem));
          
          $data = $this->Stat_mhs_model->getdata("thnsmsstat_mhs='$sem' and statstat_mhs=1");

          $dataisi=array();
          if($this->Stat_mhs_model->numrows>0)
          {
             foreach ($data as $row) {
             	  $jml_sks=$this->Trnlm_model->getriwayatsks($sem,$row['nimstat_mhs']);
                if($jml_sks>0){ 
             	  $tmp=array();
             	  $dt_mhs = $this->Msmhs_model->getdata('nimhsmsmhs="'.$row['nimstat_mhs'].'"');
             	  $tmp[]=array('Angkatan '.$dt_mhs[0]['tahunmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nimhsmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nmmhsmsmhs'],array());
             	  $tmp[]=array($shift[$dt_mhs[0]['shiftmsmhs']],array());
             	  $tmp_stat = $this->Stat_mhs_model->getstatmhs($sem,$row['nimstat_mhs']);
             	  $tmp[]=array($tmp_stat,array());
                  $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($row['nimstat_mhs'],$txt_filter);						
				          $ipk = ($data1['jml_sks']>0) ? round($data1['jml_sksnm']/$data1['jml_sks'],2) : 0;  
             	  $tmp[]=array(number_format($ipk, 2, '.', ''),array('align'=>'right'));                
                   $sks_blh=$this->Krs_model->sks_blh($ipk);
             	  $tmp[]=array($sks_blh,array('align'=>'right'));                                
             	  $tmp[]=array(empty($jml_sks) ? 0 : $jml_sks,array('align'=>'right'));
             	  $button='<button type="button" class="btn btn-default btn-sm" onclick="edit('."'".$row['nimstat_mhs']."'".')" >
                     <i class="fa fa-edit"></i>
                    </button>'; 
             	  $tmp[]=array($button,array('align'=>'center'));
             	  $dataisi[]=$tmp;
             	}  
             }
          }

       	  $header = array(array("Angkatan","NIM","Nama","Kelas","Status","IPK","Batas SKS","Ambil SKS","Aksi"));
       	  $tbstat = array("id" => "tb_krs",'width'=>'100%');
		  $tbl = new mytable($tbstat,$header,$dataisi,""); 
		  echo $tbl->display();

       }
	}

	public function atdkkrs()
	{
	   if($this->input->is_ajax_request()){ 
	   	    $sem = $this->input->post('sem');

          $shift = array('R'=>'Reguler','N'=>'Non Reguler');
         
       	  $vmythnsem = new mythnsem;
          $lst_sem=$vmythnsem->getlstthnsem(20072,$vmythnsem->substhnsem($sem,1));
          $txt_filter = implode(",",array_keys($lst_sem));

          $data = $this->Stat_mhs_model->getdata("thnsmsstat_mhs='$sem' and statstat_mhs=1");

          $dataisi=array();
          if($this->Stat_mhs_model->numrows>0)
          {
             foreach ($data as $row) {
             	$jml_sks=$this->Trnlm_model->getriwayatsks($sem,$row['nimstat_mhs']);
                if($jml_sks==0){ 
             	  $tmp=array();
             	  $dt_mhs = $this->Msmhs_model->getdata('nimhsmsmhs="'.$row['nimstat_mhs'].'"');
             	  $tmp[]=array('Angkatan '.$dt_mhs[0]['tahunmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nimhsmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nmmhsmsmhs'],array());
             	  $tmp[]=array($shift[$dt_mhs[0]['shiftmsmhs']],array());
             	  $tmp_stat = $this->Stat_mhs_model->getstatmhs($sem,$row['nimstat_mhs']);
             	  $tmp[]=array($tmp_stat,array());
                  $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($row['nimstat_mhs'],$txt_filter);						
				          $ipk = ($data1['jml_sks']>0) ? round($data1['jml_sksnm']/$data1['jml_sks'],2) : 0;  
             	  $tmp[]=array(number_format($ipk, 2, '.', ''),array('align'=>'right'));                
                  $sks_blh=$this->Krs_model->sks_blh($ipk);
             	  $tmp[]=array($sks_blh,array('align'=>'right'));                                
             	  $tmp[]=array(empty($jml_sks) ? 0 : $jml_sks,array('align'=>'right'));
             	  $button='<button type="button" class="btn btn-default btn-sm" onclick="edit('."'".$row['nimstat_mhs']."'".')" >
                     <i class="fa fa-edit"></i>
                    </button>'; 
             	  $tmp[]=array($button,array('align'=>'center'));
             	  $dataisi[]=$tmp;
             	}  
             }
          }

       	  $header = array(array("Angkatan","NIM","Nama","Kelas","Status","IPK","Batas SKS","Ambil SKS","Aksi"));
       	  $tbstat = array("id" => "tb_krs1",'width'=>'100%');
		  $tbl = new mytable($tbstat,$header,$dataisi,""); 
		  echo $tbl->display();

       }	
	}

	public function lkrs()
	{
       if($this->input->is_ajax_request()){ 
       	  $sem = $this->input->post('sem');

          $shift = array('R'=>'Reguler','N'=>'Non Reguler');

       	  $vmythnsem = new mythnsem;
          $lst_sem=$vmythnsem->getlstthnsem(20072,$vmythnsem->substhnsem($sem,1));
          $txt_filter = implode(",",array_keys($lst_sem));

          $data = $this->Stat_mhs_model->getdata("thnsmsstat_mhs='$sem' and statstat_mhs<>1");


          $dataisi=array();
          if($this->Stat_mhs_model->numrows>0)
          {
             foreach ($data as $row) {
             	$jml_sks=$this->Trnlm_model->getriwayatsks($sem,$row['nimstat_mhs']);
                if($jml_sks>0){ 
             	  $tmp=array();
             	  $dt_mhs = $this->Msmhs_model->getdata('nimhsmsmhs="'.$row['nimstat_mhs'].'"');
             	  $tmp[]=array('Angkatan '.$dt_mhs[0]['tahunmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nimhsmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nmmhsmsmhs'],array());
             	  $tmp[]=array($shift[$dt_mhs[0]['shiftmsmhs']],array());
             	  $tmp_stat = $this->Stat_mhs_model->getstatmhs($sem,$row['nimstat_mhs']);
             	  $tmp[]=array($tmp_stat,array());
                  $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($row['nimstat_mhs'],$txt_filter);						
				  $ipk = ($data1['jml_sks']>0) ? round($data1['jml_sksnm']/$data1['jml_sks'],2) : 0;  
             	  $tmp[]=array(number_format($ipk, 2, '.', ''),array('align'=>'right'));                
                  $sks_blh=$this->Krs_model->sks_blh($ipk);
             	  $tmp[]=array($sks_blh,array('align'=>'right'));                                
             	  $tmp[]=array(empty($jml_sks) ? 0 : $jml_sks,array('align'=>'right'));
             	  $button='<button type="button" class="btn btn-default btn-sm" onclick="edit('."'".$row['nimstat_mhs']."'".')" >
                     <i class="fa fa-edit"></i>
                    </button>'; 
             	  $tmp[]=array($button,array('align'=>'center'));
             	  $dataisi[]=$tmp;
             	}  
             }
          }

       	  $header = array(array("Angkatan","NIM","Nama","Kelas","Status","IPK","Batas SKS","Ambil SKS","Aksi"));
       	  $tbstat = array("id" => "tb_krs2",'width'=>'100%');
		  $tbl = new mytable($tbstat,$header,$dataisi,""); 
		  echo $tbl->display();

       }
	}

	public function ltdkkrs()
	{
	   if($this->input->is_ajax_request()){ 
	   	   $sem = $this->input->post('sem');

          $shift = array('R'=>'Reguler','N'=>'Non Reguler');

          $vmythnsem = new mythnsem;
          $lst_sem=$vmythnsem->getlstthnsem(20072,$vmythnsem->substhnsem($sem,1));
          $txt_filter = implode(",",array_keys($lst_sem));

          $data = $this->Stat_mhs_model->getdata("thnsmsstat_mhs='$sem' and statstat_mhs<>1");


          $dataisi=array();
          if($this->Stat_mhs_model->numrows>0)
          {
             foreach ($data as $row) {
             	$jml_sks=$this->Trnlm_model->getriwayatsks($sem,$row['nimstat_mhs']);
                if($jml_sks==0){ 
             	  $tmp=array();
             	  $dt_mhs = $this->Msmhs_model->getdata('nimhsmsmhs="'.$row['nimstat_mhs'].'"');
             	  $tmp[]=array('Angkatan '.$dt_mhs[0]['tahunmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nimhsmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nmmhsmsmhs'],array());
             	  $tmp[]=array($shift[$dt_mhs[0]['shiftmsmhs']],array());
             	  $tmp_stat = $this->Stat_mhs_model->getstatmhs($sem,$row['nimstat_mhs']);
             	  $tmp[]=array($tmp_stat,array());
                  $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($row['nimstat_mhs'],$txt_filter);						
				  $ipk = ($data1['jml_sks']>0) ? round($data1['jml_sksnm']/$data1['jml_sks'],2) : 0;  
             	  $tmp[]=array(number_format($ipk, 2, '.', ''),array('align'=>'right'));                
                  $sks_blh=$this->Krs_model->sks_blh($ipk);
             	  $tmp[]=array($sks_blh,array('align'=>'right'));                                
             	  $tmp[]=array(empty($jml_sks) ? 0 : $jml_sks,array('align'=>'right'));
             	  $button='<button type="button" class="btn btn-default btn-sm" onclick="edit('."'".$row['nimstat_mhs']."'".')" >
                     <i class="fa fa-edit"></i>
                    </button>'; 
             	  $tmp[]=array($button,array('align'=>'center'));
             	  $dataisi[]=$tmp;
             	}  
             }
          }

       	  $header = array(array("Angkatan","NIM","Nama","Kelas","Status","IPK","Batas SKS","Ambil SKS","Aksi"));
       	  $tbstat = array("id" => "tb_krs3",'width'=>'100%');
		  $tbl = new mytable($tbstat,$header,$dataisi,""); 
		  echo $tbl->display();

       }	
	}

   private function ismrhitl($iswp,$data)
  {
     if($iswp=='p'){
        return "<font color='red'><i>".$data."</i></font>";
      }
    else{
         return "$data";
      
     }
  }

  public function edt_dt_krs()
  {
    if($this->input->is_ajax_request()){       
       $hak = $this->session->userdata('hak');
       $nim = $this->input->post('nim');
       $sem = $this->input->post('sem');       

       $data=array();
       $data['hak']=$hak;
       $data['nim']=$nim;
       $data['nm']=$this->Msmhs_model->getnm($nim);
       $shift = array('R'=>'Reguler','N'=>'Non Reguler');

        $tbstat = array("id" => "lst_krs","width"=>"100%");
        $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Kelas","Tanggal Input"));
        $dataisi = array();

        $dt_mtk = $this->Trnlm_model->getmtk1($sem,$nim);
        $jmlsks=0;
        if(!empty($dt_mtk)){ 
                
                foreach($dt_mtk as $row){
                
                if($row['sksprtbkmk']>0){
                   $sks=number_format($row['sksmktbkmk']-1, 2, '.', '');
                   $jmlsks+=$row['sksmktbkmk']-1;
                }else{
                   $sks=$row['sksmktbkmk'];
                   $jmlsks+=$row['sksmktbkmk'];          
                }
                      
                 
                 $tmp1=$shift[$row['shifttrnlm']];
                 
                 $tmpdt = array();
                 $tmpdt[]=array('Semester '.$row['semestbkmk'],array());
                 $tmpdt[]=array($row['kdkmktrnlm'],array());
                 $tmpdt[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']),array());
                 $tmpdt[]=array($this->ismrhitl($row['wp'],$sks),array());
                 $tmpdt[]=array($tmp1,array());
                 $tmpdt[]=array($row['tgl_input'],array());
                 $dataisi[]=$tmpdt;
                 
                }       
              }

        $footer ="<tr><th></th><th colspan='2' align='center'>Jumlah SKS</th><th>$jmlsks</th><th colspan='2'></th></tr>" ;

        $tbl = new mytable($tbstat,$header,$dataisi,$footer);
        $data['lst_krs']= $tbl->display();    
       

       echo $this->load->view('Admin/Mahasiswa/frm_dt_rkrs_mhs',$data,true);

     }  
  }

  public function ambil_mtk_krs()
  {
    if($this->input->is_ajax_request()){       
       
       $nim = $this->input->post('nim');
       $sem = $this->input->post('sem');

       $tbstat = array("id" => "lst_mtk","width"=>"100%");
       $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Ambil","Kelas"));
       $isi_data = array();
       $frm = new html_form();

       $kls = $this->Msmhs_model->getshiftmhs($nim);
       $data = $this->Trnlm_model->buildkrs($nim,$sem,1);

       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks');
       
       $smtk=array();
       if(!empty($data)){
       $i=0;
      foreach($data as $row){
         $tmpdt = array();
         $tmpdt[]=array('Semester '.$row['semestbkmk'], array());
         $tmpdt[]=array($row['kdkmktbkmk'], array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']), array());
         $tmpdt[]=array($this->ismrhitl($row['wp'], $row['sksmktbkmk']), array()); 
         $smtk[$row['kdkmktbkmk']]=array('sks'=>$row['sksmktbkmk'],'kdprtk'=>$row['kdprtk'],'kls'=>$kls,'pilih'=>0);
         
         $tmp_kd=$row['kdkmktbkmk'];
         $tmp_input = $frm->addInput('checkbox','mk[]',$tmp_kd,array('id'=>'mk_'.$row['kdkmktbkmk'],'onclick'=>'pilih_mtk("'.$row['kdkmktbkmk'].'")'));
         $tmpdt[]=array($tmp_input,array('align'=>'center')); 
         $tmp_input = $frm->addSelectList("kls[".$tmp_kd."]",array('R'=>'Reguler','N'=>'Non Reguler'),true,$kls,null,array('id'=>'kls_'.$tmp_kd,'disabled'=>'disabled','onchange'=>'input_kls("'.$row['kdkmktbkmk'].'")'));       
         $tmpdt[]=array($tmp_input, array('align'=>'center')); 
         $i++;
         $isi_data[]=$tmpdt;
      }
    }
       $footer ="<tr><th></th><th colspan='2' align='center'>Jumlah SKS</th><th><div id='jmlsks'>0</div></th><th colspan='2'></th></tr>" ;      

       $this->session->set_userdata('smtk',$smtk); 
       $this->session->set_userdata('jmlsks',0); 
       $tbl = new mytable($tbstat,$header,$isi_data,$footer); 
       $data['lst_mtk']=$frm->startForm(null,'post','entrykrs').$frm->addInput('hidden',"nim",$nim).$tbl->display().$frm->endForm();
       $data['btn']=$frm->addInput('submit',"Save","Save",array('class'=>'btn btn-info pull-left','id'=>'save_ambil')).
                    $frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));  
       echo json_encode($data);
    }
  }

  public function ulang_mtk_krs()
  {
    if($this->input->is_ajax_request()){       
       
       $nim = $this->input->post('nim');
       $sem = $this->input->post('sem');

       $tbstat = array("id" => "lst_mtk","width"=>"100%");
       $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Ambil","Kelas"));
       $isi_data = array();
       $frm = new html_form();

       $kls = $this->Msmhs_model->getshiftmhs($nim);
       $data = $this->Trnlm_model->buildkrs($nim,$sem,0);
       
       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks');

       $smtk=array(); 
       if(!empty($data)){
       $i=0;
      foreach($data as $row){
         $tmpdt = array();
         $tmpdt[]=array('Semester '.$row['semestbkmk'], array());
         $tmpdt[]=array($row['kdkmktbkmk'], array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']), array());
         $tmpdt[]=array($this->ismrhitl($row['wp'], $row['sksmktbkmk']), array()); 
         $smtk[$row['kdkmktbkmk']]=array('sks'=>$row['sksmktbkmk'],'kdprtk'=>$row['kdprtk'],'kls'=>$kls,'pilih'=>0);
         $tmp_kd=$row['kdkmktbkmk'];
         $tmp_input = $frm->addInput('checkbox','mk[]',$tmp_kd,array('id'=>'mk_'.$row['kdkmktbkmk'],'onclick'=>'pilih_mtk("'.$row['kdkmktbkmk'].'")'));
         $tmpdt[]=array($tmp_input,array('align'=>'center')); 
         $tmp_input = $frm->addSelectList("kls[".$tmp_kd."]",array('R'=>'Reguler','N'=>'Non Reguler'),true,$kls,null,array('id'=>'kls_'.$tmp_kd,'disabled'=>'disabled','onchange'=>'input_kls("'.$row['kdkmktbkmk'].'")'));       
         $tmpdt[]=array($tmp_input, array('align'=>'center')); 
         $i++;
         $isi_data[]=$tmpdt;
      }
    }
       $footer ="<tr><th></th><th colspan='2' align='center'>Jumlah SKS</th><th><div id='jmlsks'>0</div></th><th colspan='2'></th></tr>" ;

       $this->session->set_userdata('smtk',$smtk); 
       $this->session->set_userdata('jmlsks',0); 
       $tbl = new mytable($tbstat,$header,$isi_data,$footer); 
       $data['lst_mtk']=$frm->startForm(null,'post','entrykrs').$frm->addInput('hidden',"nim",$nim).$tbl->display().$frm->endForm();
       $data['btn']=$frm->addInput('submit',"Save","Save",array('class'=>'btn btn-info pull-left','id'=>'save_ulang')).
                    $frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));  
       echo json_encode($data);
    }
  }

  public function kelas_mtk_krs()
  {
    if($this->input->is_ajax_request()){
       $nim = $this->input->post('nim');
       $sem = $this->input->post('sem');

       $frm = new html_form();


       $tbstat = array("id" => "lst_mtk","width"=>"100%");
       $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Kelas"));
       $isi_data = array();

       
       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks');
     
        $data = $this->Trnlm_model->getmtk2($sem,$nim,0);
        $jmlsks=0;
        $smtk=array();
      if(!empty($data)){ 
        foreach($data as $row){
        
        if($row['sksprtbkmk']>0){
                   $sks=number_format($row['sksmktbkmk']-1, 2, '.', '');
                   $jmlsks+=$row['sksmktbkmk']-1;
        }else{
           $sks=$row['sksmktbkmk'];
                   $jmlsks+=$row['sksmktbkmk'];          
        }
              
         $smtk[$row['kdkmktrnlm']]=array('sks'=>$row['sksmktbkmk'],'kdprtk'=>$row['kdprtk'],'kls'=>$row['shifttrnlm'],'pilih'=>0);
         $tmpdt = array();
         $tmpdt[]=array('Semester '.$row['semestbkmk'], array());
         $tmpdt[]=array($row['kdkmktrnlm'], array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']), array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$sks), array()); 
            
           $tmp_kd=$row['kdkmktrnlm'];
             $tmp_input = $frm->addSelectList("kls[".$tmp_kd."]",array('R'=>'Reguler','N'=>'Non Reguler'),true,$row['shifttrnlm'],null,array('id'=>'kls_'.$tmp_kd,'onchange'=>'input_kls("'.$tmp_kd.'")')); 
         
        
          $tmpdt[]=array($tmp_input, array());
          $isi_data[]=$tmpdt;  
                }       
            }

       $this->session->set_userdata('smtk',$smtk); 
       $this->session->set_userdata('jmlsks',0);      

       $tbl = new mytable($tbstat,$header,$isi_data,''); 
       $data['lst_mtk']=$frm->startForm(null,'post','entrykrs').$frm->addInput('hidden',"nim",$nim).$tbl->display().$frm->endForm();
       $data['btn']=$frm->addInput('submit',"Save","Save",array('class'=>'btn btn-info pull-left','id'=>'save_kelas')).
                    $frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));  
       echo json_encode($data);
    }
  }


  public function hapus_mtk_krs()
  {
    if($this->input->is_ajax_request()){
       $nim = $this->input->post('nim');
       $sem = $this->input->post('sem');

       $frm = new html_form();


       $tbstat = array("id" => "lst_mtk","width"=>"100%");
       $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Hapus"));
       $isi_data = array();

       

       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks');
     
      $data = $this->Trnlm_model->getmtk2($sem,$nim,0);
        $jmlsks=0;
        $smtk=array();
      if(!empty($data)){ 
        foreach($data as $row){
        
        if($row['sksprtbkmk']>0){
                   $sks=number_format($row['sksmktbkmk']-1, 2, '.', '');
                   $jmlsks+=$row['sksmktbkmk']-1;
        }else{
           $sks=$row['sksmktbkmk'];
                   $jmlsks+=$row['sksmktbkmk'];          
        }
              
         $smtk[$row['kdkmktrnlm']]=array('sks'=>$row['sksmktbkmk'],'kdprtk'=>$row['kdprtk'],'kls'=>$row['shifttrnlm'],'pilih'=>0);
         $tmpdt = array();
         $tmpdt[]=array('Semester '.$row['semestbkmk'], array());
         $tmpdt[]=array($row['kdkmktrnlm'], array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']), array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$sks), array()); 
            
          $tmp_kd=$row['kdkmktrnlm'];
          $tmp_input = $frm->addInput('checkbox','mk[]',$tmp_kd,array('id'=>'mk_'.$tmp_kd,'onclick'=>'pilih_mtk("'.$tmp_kd.'")'));        
        
          $tmpdt[]=array($tmp_input, array());
          $isi_data[]=$tmpdt;  
                }       
            }

        $this->session->set_userdata('smtk',$smtk); 
        $this->session->set_userdata('jmlsks',0);           

       $tbl = new mytable($tbstat,$header,$isi_data,''); 
       $data['lst_mtk']=$frm->startForm(null,'post','entrykrs').$frm->addInput('hidden',"nim",$nim).$tbl->display().$frm->endForm();
       $data['btn']=$frm->addInput('submit',"Del","Delete",array('class'=>'btn btn-info pull-left','id'=>'del_krs')).
                    $frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));  
       echo json_encode($data);
    }
  }

  public function pilih_mtk_krs()
  {
    if($this->input->is_ajax_request()){
        $kode = $this->input->post('kode');
        $cek = $this->input->post('cek');      
        $smtk = $this->session->userdata('smtk');
        $jmlsks = $this->session->userdata('jmlsks');
        $smtk[$kode]['pilih']=$cek;
         if($cek==1){ 
           $jmlsks+=$smtk[$kode]['sks'];
         }else{
           $jmlsks-=$smtk[$kode]['sks'];           
         }
        $this->session->set_userdata('smtk',$smtk); 
        $this->session->set_userdata('jmlsks',$jmlsks); 
        echo json_encode(array('jmlsks'=>$jmlsks));  
    }
  }

  public function input_kls()
  {
    if($this->input->is_ajax_request()){
        $kode = $this->input->post('kode');
        $kls = $this->input->post('kls');      
        $smtk = $this->session->userdata('smtk');
        $smtk[$kode]['pilih']=1;
        $smtk[$kode]['kls']=$kls;
        $this->session->set_userdata('smtk',$smtk);
    }
  }

  public function save_ambil(){
     if($this->input->is_ajax_request()){
       $nim = $this->input->post('nim');
       $sem = $this->input->post('sem');

       $vmythnsem = new mythnsem;
       $lst_sem=$vmythnsem->getlstthnsem(20072,$vmythnsem->substhnsem($sem,1));
       $txt_filter = implode(",",array_keys($lst_sem));


       $dt = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($nim,$txt_filter);
       $ipk=($dt['jml_sks']>0) ? round($dt['jml_sksnm']/$dt['jml_sks'],2) : 0;  
    
       $sks_blh=$this->Krs_model->sks_blh($ipk);

       $jmlsks = $this->session->userdata('jmlsks');
       $jml_sks =  $this->Trnlm_model->getriwayatsks($sem,$nim)+$jmlsks;


       if($jml_sks<=$sks_blh){
          
          $smtk = $this->session->userdata('smtk');
          if(!empty($smtk)){ 
            foreach ($smtk as $key=>$val) {
               if($val['pilih']==1 ){

                  $mythnsem=new mythnsem;
                  

                  $data = $this->Msmhs_model->getdata("nimhsmsmhs='$nim'");
                  $Angkatan=$data[0]['smawlmsmhs'];
                  $thnmsmhs = $data[0]['tahunmsmhs'];
                  
                  $jmlsem = count($mythnsem->getlstthnsem($Angkatan,$sem));
                   
                  $kls_mhs_txt = str_pad($jmlsem,2,'00',STR_PAD_LEFT);

                  $today = date("Y-m-d H:i:s");
                  $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$key,'shifttrnlm'=>$val['kls'],'tgl_input'=>$today,'semestrnlm'=>$kls_mhs_txt,'nlakhtrnlm'=>'T','bobottrnlm'=>0);

                  $this->Trnlm_model->insertdata($data1);

                  $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$key,'nlakhtrnlm'=>'T','bobottrnlm'=>0);
                  $this->Trnlm_trnlp_model->insertdata($data1);
                  

                  if(!empty($val['kdprtk'])){                      
                      
                        $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$val['kdprtk'],'shifttrnlm'=>$val['kls'],'tgl_input'=>$today,'semestrnlm'=>$kls_mhs_txt,'nlakhtrnlm'=>'T','bobottrnlm'=>0);   
                        $this->Trnlm_model->insertdata($data1);                        

                  }
                  
               }
            }
          }
         $data['msg']="";
       }else{
         $data['msg']=$data['msg']='<div class="callout callout-danger"><h4>Pemberitahuan</h4><p>IPK = '.number_format($ipk, 2, '.', '').' Hanya diperkenankan mengambil '.$sks_blh.' sks !!!</p> </div>';
       }
       

       
       echo json_encode($data);
     }  
  }

  public function save_ulang(){
     if($this->input->is_ajax_request()){
       $nim = $this->input->post('nim');
       $sem = $this->input->post('sem');

       
       $dt = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($nim);
       $ipk=($dt['jml_sks']>0) ? round($dt['jml_sksnm']/$dt['jml_sks'],2) : 0;  
    
       $sks_blh=$this->Krs_model->sks_blh($ipk);

       $jmlsks = $this->session->userdata('jmlsks');
       $jml_sks =  $this->Krs_model->hitsks($nim)+$jmlsks;


       if($jml_sks<=$sks_blh){
          
          $smtk = $this->session->userdata('smtk');
          if(!empty($smtk)){ 
            foreach ($smtk as $key=>$val) {
               if($val['pilih']==1 ){
                  
                  $mythnsem=new mythnsem;
                  

                  $data = $this->Msmhs_model->getdata("nimhsmsmhs='$nim'");
                  $Angkatan=$data[0]['smawlmsmhs'];
                  $thnmsmhs = $data[0]['tahunmsmhs'];
                  
                  $jmlsem = count($mythnsem->getlstthnsem($Angkatan,$sem));
                   
                  $kls_mhs_txt = str_pad($jmlsem,2,'00',STR_PAD_LEFT);

                   $today = date("Y-m-d H:i:s");
                  $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$key,'shifttrnlm'=>$val['kls'],'tgl_input'=>$today,'semestrnlm'=>$kls_mhs_txt,'nlakhtrnlm'=>'T','bobottrnlm'=>0);

                  $this->Trnlm_model->insertdata($data1);

                  $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$key,'nlakhtrnlm'=>'T','bobottrnlm'=>0);
                  $this->Trnlm_trnlp_model->insertdata($data1);
                  

                  if(!empty($val['kdprtk'])){                      
                      
                        $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$val['kdprtk'],'shifttrnlm'=>$val['kls'],'tgl_input'=>$today,'semestrnlm'=>$kls_mhs_txt,'nlakhtrnlm'=>'T','bobottrnlm'=>0);   
                        $this->Trnlm_model->insertdata($data1);                        

                  }
                  
               }
            }
          }
         $data['msg']="";
       }else{
         $data['msg']=$data['msg']='<div class="callout callout-danger"><h4>Pemberitahuan</h4><p>IPK = '.number_format($ipk, 2, '.', '').' Hanya diperkenankan mengambil '.$sks_blh.' sks !!!</p> </div>';
       }

       echo json_encode($data);
     }  
  }

  public function save_kelas(){
     if($this->input->is_ajax_request()){
       $nim = $this->input->post('nim');
       $sem = $this->input->post('sem');
       
        $smtk = $this->session->userdata('smtk');
          if(!empty($smtk)){ 
            foreach ($smtk as $key=>$val) {
               if($val['pilih']==1 ){                    
                    

                    $today = date("Y-m-d H:i:s");
                    $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$key,'shifttrnlm'=>$val['kls'],'tgl_input'=>$today);
                    $this->Trnlm_model->updatedata($data1);        
                    
                    if(!empty($val['kdprtk'])){
                       
                        $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$val['kdprtk'],'shifttrnlm'=>$val['kls'],'tgl_input'=>$today);
                        $this->Trnlm_model->updatedata($data1);                        
                        
                  }
                
               }

             }
           }

       $data['msg']='';
       echo json_encode($data);

     }  
  }

  public function hapus_krs(){
     if($this->input->is_ajax_request()){
       $nim = $this->input->post('nim');
       $sem = $this->input->post('sem');

       $smtk = $this->session->userdata('smtk');
          if(!empty($smtk)){ 
            foreach ($smtk as $key=>$val) {
               if($val['pilih']==1 ){               

                $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$key);
                $this->Trnlm_model->deletedatamtk($nim,$sem,$key);
                $this->Trnlm_trnlp_model->deletedatamtk($nim,$sem,$key);               

                if(!empty($val['kdprtk'])){
                    $data1=array('thsmstrnlm'=> $sem,'nimhstrnlm'=>$nim,'kdkmktrnlm'=>$val['kdprtk']);
                    $this->Trnlm_model->deletedatamtk($nim,$sem,$val['kdprtk']);
                   
                }

               }
             }
           }    

       $data['msg']='';
       echo json_encode($data);
     }  
  }

  public function ctk_excel($nim,$TA)
  {
      
      $datamhs = $this->Msmhs_model->getdata("nimhsmsmhs='$nim'");     
      $datamtk = $this->Trnlm_model->getmtk2($TA,$nim,0);  
      $dataprtk = $this->Trnlm_model->getmtk2($TA,$nim,1);

      $this->load->library('ctkrkrs');
      $this->ctkrkrs->ctk_KRS($datamhs,$datamtk,$dataprtk);

                $filename="KRS - ".$nim." - ".$TA.".xls"; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $this->ctkrkrs->download();
  }

  public function ctk_pdf($nim,$TA)
  {
    $mythnsem=new mythnsem;
    
     
     
     $tbl4 = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_jdl",'cellpadding'=>'2'));
     
     $tbl4->addRow();     
      $tbl4->addCell('<img src="'.dirname(dirname(dirname((dirname(dirname(__FILE__)))))).'/assets/img/logo_fak.jpg" alt="logo" width="55" height="55">','data');
          $tbl4->addCell('<font face="Times New Roman" size="10pt">'.
                       '<b>PROGRAM STUDI MATEMATIKA<br>'.
                     'FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM<br>'.
                   'UNIVERSITAS BALE BANDUNG'.
                 '</b>'.
                   '</font>',null,'data');
     
     $jdl = $tbl4->display().       
        '<br><br>'.
            '<center>'.
                  '<font face="Times New Roman" size="10pt">'.
                   '<b>KARTU RENCANA STUDI (KRS)</b>'.
              '</font>'.
        '</center><br><br>';
  
       
     $data = $this->Msmhs_model->getdata("nimhsmsmhs='$nim'");
  
    $txt_sem = array(1=>'Ganjil',2=>'Genap');
    foreach($data as $row)
      {  
     $tbl2 = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_mhs","width"=>"100%"));       
     $tbl2->addRow();     
      $tbl2->addCell('NIM','data');
          $tbl2->addCell(':',null,'data');
      $tbl2->addCell($nim,null,'data');
      $tbl2->addCell('Sem. Awal','data');
          $tbl2->addCell(':',null,'data');
      $thn = str_split($row['smawlmsmhs'], 4);
      $tbl2->addCell($txt_sem[$thn[1]]." ".$thn[0],null,'data');
     $tbl2->addRow();     
      $tbl2->addCell('Nama','data');
          $tbl2->addCell(':',null,'data');
      $tbl2->addCell($row['nmmhsmsmhs'],null,'data');
      $tbl2->addCell('Tahun Ajaran','data');
          $tbl2->addCell(':',null,'data');
      $thn = str_split($TA, 4);
      $tbl2->addCell( $thn[0].'/'.($thn[0]+1),null,'data');   
     $tbl2->addRow();     
      $tbl2->addCell('Dosen Wali','data');
          $tbl2->addCell(':',null,'data');
      $tbl2->addCell('',null,'data');
      $tbl2->addCell('Semester','data');
          $tbl2->addCell(':',null,'data');
      $tbl2->addCell( $txt_sem[$thn[1]]." ".$thn[0],null,'data');
    }
    
   
    
       $tbl = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_mtk","width"=>"100%",'border'=>'1','cellpadding'=>'2'));
     
     $tbl->addRow(); 
     $tbl->addCell('NO',null,'header',array('width'=>'5%'));
     $tbl->addCell('KODE',null,'header',array('width'=>'15%'));   
     $tbl->addCell('NAMA',null,'header',array('width'=>'70%'));  
     $tbl->addCell('SKS',null,'header',array('width'=>'10%'));
     
    $data = $this->Trnlm_model->getmtk2($TA,$nim,0);
    
    $jml_mtk = 1;
    $jml_sks = 0.00;
    if(!empty($data)){
       
       foreach($data as $row){
      $tbl->addRow();
      
      $tbl->addCell($jml_mtk,null,'data',array('align'=>'right'));
          $tbl->addCell($row['kdkmktrnlm'],null,'data',array('align'=>'center'));
      $tbl->addCell($row['nakmktbkmk'],null,'data',array('align'=>'left'));
      $tbl->addCell($row['sksmktbkmk'],null,'data',array('align'=>'center'));
       
      $jml_sks+=$row['sksmktbkmk'];  
      $jml_mtk++;     
     }  
    } 
        $tbl->addRow();     
      $tbl->addCell('',null,'data',array('align'=>'right','height'=>'18px'));
          $tbl->addCell('',null,'data',array('align'=>'center','height'=>'18px'));
      $tbl->addCell('',null,'data',array('align'=>'left','height'=>'18px'));
      $tbl->addCell('',null,'data',array('align'=>'center','height'=>'18px'));
      
      $tbl->addRow();
      $tbl->addCell('Jumlah',null,'data',array('colspan'=>'3','align'=>'center'));
      $tbl->addCell($jml_sks,null,'data',array('align'=>'center'));
      
     $tbl1 = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_prak",'border'=>'1','width'=>'90%','cellpadding'=>'2'));
     
     $tbl1->addRow(); 
     $tbl1->addCell('NO',null,'header',array('width'=>'5%'));
     $tbl1->addCell('KODE',null,'header',array('width'=>'15%'));    
     $tbl1->addCell('NAMA',null,'header',array('width'=>'70%'));   
     

    $data = $this->Trnlm_model->getmtk2($TA,$nim,1);
      
    $jml_mtk = 1;
    
    if(!empty($data)){
       
       foreach($data as $row){
       $kd = str_split($row['kdkmktrnlm'],4); 
        if($kd[0]=='MATP'){  
           $tbl1->addRow();
           $tbl1->addCell($jml_mtk,null,'data',array('align'=>'right'));
               $tbl1->addCell($row['kdkmktrnlm'],null,'data',array('align'=>'center'));
           $tbl1->addCell($row['nakmktbkmk'],null,'data',array('align'=>'left'));
          $jml_mtk++;
            }       
     }  
    }      
     
      $tbl1->addRow();
    $tbl1->addCell('',null,'data',array('align'=>'right','height'=>'18px'));
        $tbl1->addCell('',null,'data',array('align'=>'center','height'=>'18px'));
    $tbl1->addCell('',null,'data',array('align'=>'left','height'=>'18px'));
     
     $tbl3 = new HTML_Table(null, 'display', 0, 0, 0,array("id" => "tb_ttd",'border'=>'1','width'=>'60%','cellpadding'=>'2'));
     
     $tbl3->addRow(); 
     $tbl3->addCell('MAHASISWA',null,'header',array('width'=>'50%'));
     $tbl3->addCell('DOSEN WALI',null,'header',array('width'=>'50%'));    
     $tbl3->addRow(); 
     $tbl3->addCell(' ',null,'data',array('height'=>'50px'));
     $tbl3->addCell(' ',null,'data',array('height'=>'50px'));
     
     
     $html =
            '<html>'.
      '<style type="text/css">'.
      'table{font-family: Calibri; font-size: 9pt;}'.
      '</style>'.
      '<body>'.
       $jdl.$tbl2->display().             
      '<br>Matakuliah : <br>'.$tbl->display().
      '<br>Praktikum : <br>'.$tbl1->display().
      '<br><br>'.$tbl3->display().
      '<br><br>'.'<font face="Calibri" size="9pt">Dicetak dari Sistem Informasi Akademik FMIPA UNIBBA pada tanggal '.date("d-m-Y H:i:s").'</font>'.
            '</body>'.
      '</html>';          
      //echo $html;
     
        
      
      
      $this->load->library('pdf');
      $filename="KRS - ".$nim." - ".$TA.".pdf";
      $this->pdf->load_html($html);
      $this->pdf->set_paper('a4', 'portrait');
      $this->pdf->render();
      $this->pdf->stream($filename);
     
     
  } 

  

  public function filter_rkrs()
  {
       if($this->input->is_ajax_request()){ 
          $sem = $this->input->post('sem');
          $mythnsem=new mythnsem;
          $sem = $mythnsem->gettxtthnsem($sem);
            
          
          $data['sem']=$sem;
          echo json_encode($data);

       }
  }

}