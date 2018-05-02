<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs_mhs extends CI_Controller {

	public function akrs()
	{
       if($this->input->is_ajax_request()){ 
       	  
       	  $shift = array('R'=>'Reguler','N'=>'Non Reguler');

       	  $vmythnsem = new mythnsem;
          $TA = $vmythnsem->getthnsem();

          $data = $this->Stat_mhs_model->getdata("thnsmsstat_mhs=$TA and statstat_mhs=1");


          $dataisi=array();
          if($this->Stat_mhs_model->numrows>0)
          {
             foreach ($data as $row) {
             	$jml_sks=$this->Krs_model->hitsks($row['nimstat_mhs']);
                if($jml_sks>0){ 
             	  $tmp=array();
             	  $dt_mhs = $this->Msmhs_model->getdata('nimhsmsmhs="'.$row['nimstat_mhs'].'"');
             	  $tmp[]=array('Angkatan '.$dt_mhs[0]['tahunmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nimhsmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nmmhsmsmhs'],array());
             	  $tmp[]=array($shift[$dt_mhs[0]['shiftmsmhs']],array());
             	  $tmp_stat = $this->Stat_mhs_model->getstatmhs($TA,$row['nimstat_mhs']);
             	  $tmp[]=array($tmp_stat,array());
                  $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($row['nimstat_mhs']);						
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
	   	  $shift = array('R'=>'Reguler','N'=>'Non Reguler');

       	  $vmythnsem = new mythnsem;
          $TA = $vmythnsem->getthnsem();

          $data = $this->Stat_mhs_model->getdata("thnsmsstat_mhs=$TA and statstat_mhs=1");


          $dataisi=array();
          if($this->Stat_mhs_model->numrows>0)
          {
             foreach ($data as $row) {
             	$jml_sks=$this->Krs_model->hitsks($row['nimstat_mhs']);
                if($jml_sks==0){ 
             	  $tmp=array();
             	  $dt_mhs = $this->Msmhs_model->getdata('nimhsmsmhs="'.$row['nimstat_mhs'].'"');
             	  $tmp[]=array('Angkatan '.$dt_mhs[0]['tahunmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nimhsmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nmmhsmsmhs'],array());
             	  $tmp[]=array($shift[$dt_mhs[0]['shiftmsmhs']],array());
             	  $tmp_stat = $this->Stat_mhs_model->getstatmhs($TA,$row['nimstat_mhs']);
             	  $tmp[]=array($tmp_stat,array());
                  $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($row['nimstat_mhs']);						
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
       	  
          $shift = array('R'=>'Reguler','N'=>'Non Reguler');

       	  $vmythnsem = new mythnsem;
          $TA = $vmythnsem->getthnsem();

          $data = $this->Stat_mhs_model->getdata("thnsmsstat_mhs=$TA and statstat_mhs<>1");


          $dataisi=array();
          if($this->Stat_mhs_model->numrows>0)
          {
             foreach ($data as $row) {
             	$jml_sks=$this->Krs_model->hitsks($row['nimstat_mhs']);
                if($jml_sks>0){ 
             	  $tmp=array();
             	  $dt_mhs = $this->Msmhs_model->getdata('nimhsmsmhs="'.$row['nimstat_mhs'].'"');
             	  $tmp[]=array('Angkatan '.$dt_mhs[0]['tahunmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nimhsmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nmmhsmsmhs'],array());
             	  $tmp[]=array($shift[$dt_mhs[0]['shiftmsmhs']],array());
             	  $tmp_stat = $this->Stat_mhs_model->getstatmhs($TA,$row['nimstat_mhs']);
             	  $tmp[]=array($tmp_stat,array());
                  $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($row['nimstat_mhs']);						
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
	   	  $shift = array('R'=>'Reguler','N'=>'Non Reguler');

       	  $vmythnsem = new mythnsem;
          $TA = $vmythnsem->getthnsem();

          $data = $this->Stat_mhs_model->getdata("thnsmsstat_mhs=$TA and statstat_mhs<>1");


          $dataisi=array();
          if($this->Stat_mhs_model->numrows>0)
          {
             foreach ($data as $row) {
             	$jml_sks=$this->Krs_model->hitsks($row['nimstat_mhs']);
                if($jml_sks==0){ 
             	  $tmp=array();
             	  $dt_mhs = $this->Msmhs_model->getdata('nimhsmsmhs="'.$row['nimstat_mhs'].'"');
             	  $tmp[]=array('Angkatan '.$dt_mhs[0]['tahunmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nimhsmsmhs'],array());
             	  $tmp[]=array($dt_mhs[0]['nmmhsmsmhs'],array());
             	  $tmp[]=array($shift[$dt_mhs[0]['shiftmsmhs']],array());
             	  $tmp_stat = $this->Stat_mhs_model->getstatmhs($TA,$row['nimstat_mhs']);
             	  $tmp[]=array($tmp_stat,array());
                  $data1 = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk_krs($row['nimstat_mhs']);						
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

       $vmythnsem = new mythnsem;
       $thnsms = $vmythnsem->getthnsem();

       $data=array();
       $data['hak']=$hak;
       $data['nim']=$nim;
       $data['nm']=$this->Msmhs_model->getnm($nim);
       $shift = array('R'=>'Reguler','N'=>'Non Reguler');

        $tbstat = array("id" => "lst_krs","width"=>"100%");
        $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Kelas","Tanggal Input"));
        $dataisi = array();

        $dt_mtk = $this->Krs_model->getMtk($thnsms,$nim);
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
                      
                 
                 $tmp1=$shift[$row['shiftkrs']];
                 
                 $tmpdt = array();
                 $tmpdt[]=array('Semester '.$row['semestbkmk'],array());
                 $tmpdt[]=array($row['kdkmkkrs'],array());
                 $tmpdt[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']),array());
                 $tmpdt[]=array($this->ismrhitl($row['wp'],$sks),array());
                 $tmpdt[]=array($tmp1,array());
                 $tmpdt[]=array($row['tgl_input'],array());
                 $dataisi[]=$tmpdt;
                 
                }       
              }

        $tbl = new mytable($tbstat,$header,$dataisi,"");
        $data['lst_krs']= $tbl->display();    
       

       echo $this->load->view('Admin/Mahasiswa/frm_dt_krs_mhs',$data,true);

     }  
  }

  public function ambil_mtk_krs()
  {
    if($this->input->is_ajax_request()){       
       
       $nim = $this->input->post('nim');

       $tbstat = array("id" => "lst_mtk","width"=>"100%");
       $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Ambil","Kelas"));
       $isi_data = array();
       $frm = new html_form();

       $kls = $this->Msmhs_model->getshiftmhs($nim);
       $data = $this->Krs_model->buildkrs($nim,1);

       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks');

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
       $this->session->set_userdata('smtk',$smtk); 
       $this->session->set_userdata('jmlsks',0); 
       $tbl = new mytable($tbstat,$header,$isi_data,''); 
       $data['lst_mtk']=$frm->startForm(null,'post','entrykrs').$frm->addInput('hidden',"nim",$nim).$tbl->display().'<br>Jumlah SKS :<div id="jmlsks">0</div>'.$frm->endForm();
       $data['btn']=$frm->addInput('submit',"Save","Save",array('class'=>'btn btn-info pull-left','id'=>'save_ambil')).
                    $frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));  
       echo json_encode($data);
    }
  }

  public function ulang_mtk_krs()
  {
    if($this->input->is_ajax_request()){       
       
       $nim = $this->input->post('nim');

       $tbstat = array("id" => "lst_mtk","width"=>"100%");
       $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Ambil","Kelas"));
       $isi_data = array();
       $frm = new html_form();

       $kls = $this->Msmhs_model->getshiftmhs($nim);
       $data = $this->Krs_model->buildkrs($nim,0);

       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks');

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
       $this->session->set_userdata('smtk',$smtk); 
       $this->session->set_userdata('jmlsks',0); 
       $tbl = new mytable($tbstat,$header,$isi_data,''); 
       $data['lst_mtk']=$frm->startForm(null,'post','entrykrs').$frm->addInput('hidden',"nim",$nim).$tbl->display().'<br>Jumlah SKS :<div id="jmlsks">0</div>'.$frm->endForm();
       $data['btn']=$frm->addInput('submit',"Save","Save",array('class'=>'btn btn-info pull-left','id'=>'save_ulang')).
                    $frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));  
       echo json_encode($data);
    }
  }

  public function kelas_mtk_krs()
  {
    if($this->input->is_ajax_request()){
       $nim = $this->input->post('nim');

       $frm = new html_form();


       $tbstat = array("id" => "lst_mtk","width"=>"100%");
       $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Kelas"));
       $isi_data = array();

       $mythnsem=new mythnsem;
       $thnsms = $mythnsem->getthnsem();

       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks');
     
      $data = $this->Krs_model->getMtk($thnsms,$nim,0);
        $jmlsks=0;
      if(!empty($data)){ 
        foreach($data as $row){
        
        if($row['sksprtbkmk']>0){
                   $sks=number_format($row['sksmktbkmk']-1, 2, '.', '');
                   $jmlsks+=$row['sksmktbkmk']-1;
        }else{
           $sks=$row['sksmktbkmk'];
                   $jmlsks+=$row['sksmktbkmk'];          
        }
              
         $smtk[$row['kdkmkkrs']]=array('sks'=>$row['sksmktbkmk'],'kls'=>$row['shiftkrs'],'pilih'=>0);
         $tmpdt = array();
         $tmpdt[]=array('Semester '.$row['semestbkmk'], array());
         $tmpdt[]=array($row['kdkmkkrs'], array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']), array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$sks), array()); 
            
           $tmp_kd=$row['kdkmkkrs'];
             $tmp_input = $frm->addSelectList("kls[".$tmp_kd."]",array('R'=>'Reguler','N'=>'Non Reguler'),true,$row['shiftkrs'],null,array('id'=>'kls_'.$tmp_kd,'onchange'=>'input_kls("'.$tmp_kd.'")')); 
         
        
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

       $frm = new html_form();


       $tbstat = array("id" => "lst_mtk","width"=>"100%");
       $header = array(array("Sem","Kode Mata Kuliah","Nama Mata Kuliah","SKS","Hapus"));
       $isi_data = array();

       $mythnsem=new mythnsem;
       $thnsms = $mythnsem->getthnsem();

       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks');
     
      $data = $this->Krs_model->getMtk($thnsms,$nim,0);
        $jmlsks=0;
      if(!empty($data)){ 
        foreach($data as $row){
        
        if($row['sksprtbkmk']>0){
                   $sks=number_format($row['sksmktbkmk']-1, 2, '.', '');
                   $jmlsks+=$row['sksmktbkmk']-1;
        }else{
           $sks=$row['sksmktbkmk'];
                   $jmlsks+=$row['sksmktbkmk'];          
        }
              
         $smtk[$row['kdkmktbkmk']]=array('sks'=>$row['sksmktbkmk'],'kdprtk'=>$row['kdprtk'],'kls'=>$kls,'pilih'=>0);
         $tmpdt = array();
         $tmpdt[]=array('Semester '.$row['semestbkmk'], array());
         $tmpdt[]=array($row['kdkmkkrs'], array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']), array());
         $tmpdt[]=array($this->ismrhitl($row['wp'],$sks), array()); 
            
          $tmp_kd=$row['kdkmkkrs'];
          $tmp_input = $frm->addInput('checkbox','mk[]',$tmp_kd,array('id'=>'mk')); 
         
        
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
           $smtk[$kode]['nilai']='';
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
                  $thnsms = $mythnsem->getthnsem();

                  $data = $this->Msmhs_model->getdata("nimhsmsmhs='$nim'");
                  $Angkatan=$data[0]['smawlmsmhs'];
                  $thnmsmhs = $data[0]['tahunmsmhs'];
                  
                  $jmlsem = count($mythnsem->getlstthnsem($Angkatan,$thnsms));
                   
                  $kls_mhs_txt = str_pad($jmlsem,2,'00',STR_PAD_LEFT);

                  $today = date("Y-m-d H:i:s");
                  $data1=array('thsmskrs'=> $thnsms,'nimhskrs'=>$nim,'kdkmkkrs'=>$key,'shiftkrs'=>$val['kls'],'tgl_input'=>$today,'semkrs'=>$kls_mhs_txt);

                  $this->Krs_model->insertdata($data1);

                  if(!in_array($key,array('UBB106','MAT352','MAT353')))
                  {
                     $data=array('thsmsmpoll'=>$thnsms,'kdkmkmpoll'=>$key,'nimhsmpoll'=>$nim,'isimpoll'=>0,'semmpoll'=>$kls_mhs_txt,'kelasmpoll'=>'01','shiftmpoll'=>$val['kls'],'tgl_input'=>$today); 
                     $this->Mpoll_model->insertdata($data);
                  }

                  if(!empty($val['kdprtk'])){

                      $isinput=(($thnmsmhs<2016) or (($thnmsmhs>=2016) and ($val['kls']=='R')));
                      if($isinput){  
                        $data1=array('thsmskrs'=> $thnsms,'nimhskrs'=>$nim,'kdkmkkrs'=>$val['kdprtk'],'shiftkrs'=>$val['kls'],'tgl_input'=>$today,'semkrs'=>$kls_mhs_txt);   
                        $this->Krs_model->insertdata($data1);

                        $data=array('thsmsmpoll'=>$thnsms,'kdkmkmpoll'=>$val['kdprtk'],'nimhsmpoll'=>$nim,'isimpoll'=>0,'semmpoll'=>$kls_mhs_txt,'kelasmpoll'=>'01','shiftmpoll'=>$val['kls'],'tgl_input'=>$today); 
                        $this->Mpoll_model->insertdata($data);
                      }  
                  }
                  
               }
            }
          }
         $data['msg']="";
       }else{
         $data['msg']="IPK = ".number_format($ipk, 2, '.', '')." Hanya diperkenankan mengambil ".$sks_blh." sks !!!";
       }
       

       
       echo json_encode($data);
     }  
  }

  public function save_ulang(){
     if($this->input->is_ajax_request()){
       $nim = $this->input->post('nim');
       
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
                  $thnsms = $mythnsem->getthnsem();

                  $data = $this->Msmhs_model->getdata("nimhsmsmhs='$nim'");
                  $Angkatan=$data[0]['smawlmsmhs'];
                  $thnmsmhs = $data[0]['tahunmsmhs'];
                  
                  $jmlsem = count($mythnsem->getlstthnsem($Angkatan,$thnsms));
                   
                  $kls_mhs_txt = str_pad($jmlsem,2,'00',STR_PAD_LEFT);

                  $today = date("Y-m-d H:i:s");
                  $data1=array('thsmskrs'=> $thnsms,'nimhskrs'=>$nim,'kdkmkkrs'=>$key,'shiftkrs'=>$val['kls'],'tgl_input'=>$today,'semkrs'=>$kls_mhs_txt);

                  $this->Krs_model->insertdata($data1);

                  if(!in_array($key,array('UBB106','MAT352','MAT353')))
                  {
                     $data=array('thsmsmpoll'=>$thnsms,'kdkmkmpoll'=>$key,'nimhsmpoll'=>$nim,'isimpoll'=>0,'semmpoll'=>$kls_mhs_txt,'kelasmpoll'=>'01','shiftmpoll'=>$val['kls'],'tgl_input'=>$today); 
                     $this->Mpoll_model->insertdata($data);
                  }

                  if(!empty($val['kdprtk'])){

                      $isinput=(($thnmsmhs<2016) or (($thnmsmhs>=2016) and ($val['kls']=='R')));
                      if($isinput){  
                        $data1=array('thsmskrs'=> $thnsms,'nimhskrs'=>$nim,'kdkmkkrs'=>$val['kdprtk'],'shiftkrs'=>$val['kls'],'tgl_input'=>$today,'semkrs'=>$kls_mhs_txt);   
                        $this->Krs_model->insertdata($data1);

                        $data=array('thsmsmpoll'=>$thnsms,'kdkmkmpoll'=>$val['kdprtk'],'nimhsmpoll'=>$nim,'isimpoll'=>0,'semmpoll'=>$kls_mhs_txt,'kelasmpoll'=>'01','shiftmpoll'=>$val['kls'],'tgl_input'=>$today); 
                        $this->Mpoll_model->insertdata($data);
                      }  
                  }
                  
               }
            }
          }
         $data['msg']="";
       }else{
         $data['msg']="IPK = ".number_format($ipk, 2, '.', '')." Hanya diperkenankan mengambil ".$sks_blh." sks !!!";
       }

       echo json_encode($data);
     }  
  }

  public function save_kelas(){
     if($this->input->is_ajax_request()){
       $nim = $this->input->post('nim');
       
        $smtk = $this->session->userdata('smtk');
          if(!empty($smtk)){ 
            foreach ($smtk as $key=>$val) {
               if($val['pilih']==1 ){
                



                
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
       $data['msg']='hapus';
       echo json_encode($data);
     }  
  }



}