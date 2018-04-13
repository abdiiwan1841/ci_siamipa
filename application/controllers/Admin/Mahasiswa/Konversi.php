<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konversi extends CI_Controller {
 public function get_dt_konversi()
  {
     if($this->input->is_ajax_request()){       
       
       $hak = $this->session->userdata('hak');
       
       $tbstat = array("id" => "lst_mhs",'width'=>'100%');  
       $header = array(array('Angkatan','NIM','Nama','SKS Konversi','Aksi'));
       $isi_data = array();

        $data = $this->Vw_trnlp_jn_msmhs_jn_tbkmk_model->getdata('');
               
       if($this->Vw_trnlp_jn_msmhs_jn_tbkmk_model->numrows>0){           
         
         foreach($data as $row){ 
            $tmp=array();         
            $tmp[]=array('Angkatan '.$row['tahunmsmhs'],array());
            $tmp[]=array($row['nimhsmsmhs'],array());
            $tmp[]=array($row['nmmhsmsmhs'], array());
            $tmp[]=array($row['jml_sks']==null ? 0 : $row['jml_sks'],array('align'=>'right'));            
            
            $button='<button type="button" class="btn btn-default btn-sm" onclick="edit('."'".$row['nimhsmsmhs']."'".')" >
                     <i class="fa fa-edit"></i>
                    </button>';          
            $tmp[]=array($button,array('align'=>'center'));
                        
            $isi_data[]=$tmp;  
         }     
       
       }
       
       $tbl = new mytable($tbstat,$header,$isi_data,''); 
       echo $tbl->display();
       
     } 
  }

  public function edt_dt_pindahan()
  {
    if($this->input->is_ajax_request()){       
       $hak = $this->session->userdata('hak');
       $nim = $this->input->post('nim');
       
       $data=array();
       $data['hak']=$hak;
       $data['nim']=$nim;
       $data['nm']=$this->Msmhs_model->getnm($nim);

       $tbstat = array("id" => "lst_konversi",'width'=>'100%');  
       $header = array(array('Sem','Kode Mata Kuliah','Nama Mata Kuliah','SKS','HM','NM','Kelas'));
       $isi_data = array();

      $mtk = $this->Vw_trnlp_jn_tbkmk_model->getData("nimhstrnlp='$nim'");
        
      if($this->Vw_trnlp_jn_tbkmk_model->numrows>0){ 
        foreach($mtk as $row){   
                  
         $tmp=array();         
         $tmp[]=array('Semester '.$row['semestbkmk'], array());
         $tmp[]=array($row['kdkmktrnlp'], array());
         $tmp[]=array($row['nakmktbkmk'], array());
         $tmp[]=array($row['sksmktbkmk'], array());
         $tmp[]=array($row['nlakhtrnlp'], array());
         $tmp[]=array($row['bobottrnlp'], array());
         $tmp[]=array($row['kelastrnlp'], array());     
         $isi_data[]=$tmp;
        }       
       }
       
        $tbl = new mytable($tbstat,$header,$isi_data,''); 
        $data['lst_pindahan']= $tbl->display();

       
       echo $this->load->view('Admin/Mahasiswa/frm_dt_konversi',$data,true);

     }
  }

   public function add_mtk_konversi()
  {
    if($this->input->is_ajax_request()){       
       $hak = $this->session->userdata('hak');
       $nim = $this->input->post('nim');
       
       $data=array();
       $frm = new html_form();

       $tbstat = array("id" => "lst_mtk",'width'=>'100%');  
       $header = array(array('Sem','Kode','Nama','SKS','Pilih','A','B','C','D','E'));
       $isi_data = array();

       $mtk = $this->Mtk_model->getdata("kdkmktbkmk NOT LIKE 'MATP%' and (kdkmktbkmk not in (select kdkmktrnlp from trnlp where nimhstrnlp='$nim') )");
       $smtk=array();
       $this->session->unset_userdata('smtk');
       if($this->Mtk_model->numrows>0)
       {
         //$i=1;
         foreach ($mtk as $row) {
              $tmp=array();         
              $tmp[]=array('Semester '.$row['semestbkmk'], array());
              $tmp[]=array($row['kdkmktbkmk'], array());
              $tmp[]=array($row['nakmktbkmk'], array());
              $tmp[]=array($row['sksmktbkmk'], array('align'=>'right'));
              $smtk[$row['kdkmktbkmk']]=array('sks'=>$row['sksmktbkmk'],'nilai'=>'','pilih'=>0);
              $tmp[]=array($frm->addInput('checkbox',"mk[]",$row['kdkmktbkmk'],array('id'=>'mk_'.$row['kdkmktbkmk'],'onclick'=>'pilih_mtk("'.$row['kdkmktbkmk'].'")')), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktbkmk']."]","A",array('id'=>'nilaiA_'.$row['kdkmktbkmk'],'disabled'=>'disabled','onclick'=>'input_nilai("'.$row['kdkmktbkmk'].'","A")')), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktbkmk']."]","B",array('id'=>'nilaiB_'.$row['kdkmktbkmk'],'disabled'=>'disabled','onclick'=>'input_nilai("'.$row['kdkmktbkmk'].'","B")')), array('align'=>'center'));     
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktbkmk']."]","C",array('id'=>'nilaiC_'.$row['kdkmktbkmk'],'disabled'=>'disabled','onclick'=>'input_nilai("'.$row['kdkmktbkmk'].'","C")')), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktbkmk']."]","D",array('id'=>'nilaiD_'.$row['kdkmktbkmk'],'disabled'=>'disabled','onclick'=>'input_nilai("'.$row['kdkmktbkmk'].'","D")')), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktbkmk']."]","E",array('id'=>'nilaiE_'.$row['kdkmktbkmk'],'disabled'=>'disabled','onclick'=>'input_nilai("'.$row['kdkmktbkmk'].'","E")')), array('align'=>'center'));     
              $isi_data[]=$tmp;
              //$i++;
            }   
       }
         
       $this->session->set_userdata('smtk',$smtk); 
       $this->session->set_userdata('jmlsks',0); 
       $tbl = new mytable($tbstat,$header,$isi_data,''); 
       $data['lst_mtk']=$frm->startForm(null,'post','entrytrnlp').$frm->addInput('hidden',"nim",$nim).$tbl->display().'<br>Jumlah SKS :<div id="jmlsks">0</div>'.$frm->endForm();
       $data['btn']=$frm->addInput('submit',"Save","Save",array('class'=>'btn btn-info pull-left','id'=>'save_add')).
                    $frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));  
       echo json_encode($data);

     }
   }

  public function edit_mtk_konversi()
  {
    if($this->input->is_ajax_request()){       
       $hak = $this->session->userdata('hak');
       $nim = $this->input->post('nim');
       
       $data=array();
       $frm = new html_form();

       $tbstat = array("id" => "lst_mtk",'width'=>'100%');  
       $header = array(array('Sem','Kode','Nama','SKS','A','B','C','D','E'));
       $isi_data = array();

       $mtk = $this->Vw_trnlp_jn_tbkmk_model->getdata("nimhstrnlp='$nim'");

       if($this->Vw_trnlp_jn_tbkmk_model->numrows>0)
       {
         $i=1;
         foreach ($mtk as $row) {
              $tmp=array();         
              $tmp[]=array('Semester '.$row['semestbkmk'], array());
              $tmp[]=array($row['kdkmktrnlp'], array());
              $tmp[]=array($row['nakmktbkmk'], array());
              $tmp[]=array($row['sksmktbkmk'], array('align'=>'right'));

              $statA = array('id'=>'nilaiA'.$i);
              $statB = array('id'=>'nilaiB'.$i);
              $statC = array('id'=>'nilaiC'.$i);
              $statD = array('id'=>'nilaiD'.$i);
              $statE = array('id'=>'nilaiE'.$i);

              switch (trim($row['nlakhtrnlp'])) {
                  case 'A':
                    $statA['checked']='checked';
                    break;
                  case 'B':
                    $statB['checked']='checked';
                    break;
                  case 'C':
                    $statC['checked']='checked';
                    break;
                  case 'D':
                    $statD['checked']='checked';
                    break;
                  case 'E':
                    $statE['checked']='checked';
                    break;        
                  
                  default:
                    # code...
                    break;
                }              
                 
              
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","A",$statA), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","B",$statB), array('align'=>'center'));     
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","C",$statC), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","D",$statD), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","E",$statE), array('align'=>'center'));     
              $isi_data[]=$tmp;
              $i++;
            }   
       }
         

       $tbl = new mytable($tbstat,$header,$isi_data,''); 
       $data['lst_mtk']=$frm->startForm(null,'post','entrytrnlp').$frm->addInput('hidden',"nim",$nim).$tbl->display().$frm->endForm();
       $data['btn']=$frm->addInput('submit',"Save","Save",array('class'=>'btn btn-info pull-left','id'=>'save_edit')).
                    $frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));  
       echo json_encode($data);

     }
   }

   public function del_mtk_konversi()
  {
    if($this->input->is_ajax_request()){       
       $hak = $this->session->userdata('hak');
       $nim = $this->input->post('nim');
       
       $data=array();
       $frm = new html_form();

       $tbstat = array("id" => "lst_mtk",'width'=>'100%');  
       $header = array(array('Sem','Kode','Nama','SKS','Pilih'));
       $isi_data = array();

       $mtk = $this->Vw_trnlp_jn_tbkmk_model->getdata("nimhstrnlp='$nim'");

       if($this->Vw_trnlp_jn_tbkmk_model->numrows>0)
       {
         foreach ($mtk as $row) {
              $tmp=array();         
              $tmp[]=array('Semester '.$row['semestbkmk'], array());
              $tmp[]=array($row['kdkmktrnlp'], array());
              $tmp[]=array($row['nakmktbkmk'], array());
              $tmp[]=array($row['sksmktbkmk'], array('align'=>'right'));
              $tmp[]=array($frm->addInput('checkbox',"mk[]",$row['kdkmktrnlp'],array('id'=>'mk')), array('align'=>'center'));          
              $isi_data[]=$tmp;              
            }   
       }
         

       $tbl = new mytable($tbstat,$header,$isi_data,''); 
       $data['lst_mtk']=$frm->startForm(null,'post','entrytrnlp').$frm->addInput('hidden',"nim",$nim).$tbl->display().$frm->endForm();
       $data['btn']=$frm->addInput('submit',"Delete","Delete",array('class'=>'btn btn-info pull-left','id'=>'del')).
                    $frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));  
       echo json_encode($data);

     }
   }

   public function pilih_mtk_konversi()
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

   public function nilai_mtk_konversi()
   {
      if($this->input->is_ajax_request()){   
        $kode = $this->input->post('kode');
        $nm = $this->input->post('nm');      
        $smtk = $this->session->userdata('smtk');
        
        $smtk[$kode]['nilai']=$nm;
        $this->session->set_userdata('smtk',$smtk);         
        
      }
   }

}