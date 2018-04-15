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
       $this->session->unset_userdata('jmlsks');
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
       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks');
       $jmlsks =0;
       if($this->Vw_trnlp_jn_tbkmk_model->numrows>0)
       {
         $i=1;         
         foreach ($mtk as $row) {
              $tmp=array();         
              $tmp[]=array('Semester '.$row['semestbkmk'], array());
              $tmp[]=array($row['kdkmktrnlp'], array());
              $tmp[]=array($row['nakmktbkmk'], array());
              $tmp[]=array($row['sksmktbkmk'], array('align'=>'right'));
              $smtk[$row['kdkmktrnlp']]=array('sks'=>$row['sksmktbkmk'],'nilai'=>trim($row['nlakhtrnlp']),'pilih'=>1);

              $jmlsks +=$row['sksmktbkmk']; 

              $stat['A'] = array('id'=>'nilaiA'.$i,'onclick'=>'input_nilai("'.$row['kdkmktrnlp'].'","A")');
              $stat['B'] = array('id'=>'nilaiB'.$i,'onclick'=>'input_nilai("'.$row['kdkmktrnlp'].'","B")');
              $stat['C'] = array('id'=>'nilaiC'.$i,'onclick'=>'input_nilai("'.$row['kdkmktrnlp'].'","C")');
              $stat['D'] = array('id'=>'nilaiD'.$i,'onclick'=>'input_nilai("'.$row['kdkmktrnlp'].'","D")');
              $stat['E'] = array('id'=>'nilaiE'.$i,'onclick'=>'input_nilai("'.$row['kdkmktrnlp'].'","E")');

              $stat[trim($row['nlakhtrnlp'])]['checked']='checked';                
              
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","A",$stat['A']), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","B",$stat['B']), array('align'=>'center'));     
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","C",$stat['C']), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","D",$stat['D']), array('align'=>'center'));
              $tmp[]=array($frm->addInput('radio',"nilai[".$row['kdkmktrnlp']."]","E",$stat['E']), array('align'=>'center'));     
              $isi_data[]=$tmp;
              $i++;
            }   
       }
         
       $this->session->set_userdata('smtk',$smtk);
       $this->session->set_userdata('jmlsks',$jmlsks);  

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
       $this->session->unset_userdata('smtk');
       $this->session->unset_userdata('jmlsks'); 
       $jmlsks =0;   
       if($this->Vw_trnlp_jn_tbkmk_model->numrows>0)
       {
         //$i=1;
         foreach ($mtk as $row) {
              $tmp=array();         
              $tmp[]=array('Semester '.$row['semestbkmk'], array());
              $tmp[]=array($row['kdkmktrnlp'], array());
              $tmp[]=array($row['nakmktbkmk'], array());
              $tmp[]=array($row['sksmktbkmk'], array('align'=>'right'));
              $tmp[]=array($frm->addInput('checkbox',"mk[]",$row['kdkmktrnlp'],array('id'=>'mk_'.$row['kdkmktrnlp'],'onclick'=>'pilih_mtk("'.$row['kdkmktrnlp'].'")')), array('align'=>'center'));          
              
              $smtk[$row['kdkmktrnlp']]=array('sks'=>$row['sksmktbkmk'],'nilai'=>'','pilih'=>0);
              $jmlsks +=$row['sksmktbkmk']; 

              $isi_data[]=$tmp;
              //$i++;              
            }   
       }
         
       $this->session->set_userdata('smtk',$smtk);
       $this->session->set_userdata('jmlsks',$jmlsks);

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

   public function insert_mtk_konversi()
   {
       if($this->input->is_ajax_request()){
          $bbt = array('A'=>4.00,'B'=>3.00,'C'=>2.00,'D'=>1.00,'E'=>0.00);
          $nim = $this->input->post('nim');
          $smtk = $this->session->userdata('smtk');
          $jmlsks = $this->session->userdata('jmlsks');

          if($jmlsks>0)
          {
            foreach ($smtk as $kdkmk => $v) {
             if($v['pilih']==1){ 
                 $tmp = array('thsmstrnlp'=>'00000','nimhstrnlp'=>$nim,'kdkmktrnlp'=>$kdkmk,'nlakhtrnlp'=>$v['nilai'],'bobottrnlp'=>$bbt[$v['nilai']],'kelastrnlp'=>'01');

                 $this->Trnlp_model->insertdata($tmp);
              }   
            }  
          }   
          echo ''; 

       }
   }

   public function update_mtk_konversi()
   {
       if($this->input->is_ajax_request()){
          $bbt = array('A'=>4.00,'B'=>3.00,'C'=>2.00,'D'=>1.00,'E'=>0.00);
          $nim = $this->input->post('nim');
          $smtk = $this->session->userdata('smtk');
          $jmlsks = $this->session->userdata('jmlsks');

          if($jmlsks>0)
          {
            foreach ($smtk as $kdkmk => $v) {
             if($v['pilih']==1){ 
                 $tmp = array('thsmstrnlp'=>'00000','nimhstrnlp'=>$nim,'kdkmktrnlp'=>$kdkmk,'nlakhtrnlp'=>$v['nilai'],'bobottrnlp'=>$bbt[$v['nilai']],'kelastrnlp'=>'01');
                 $this->Trnlp_model->updatedata($tmp);
              }   
            }  
          }   
          echo ''; 

       }
   }

   public function delete_mtk_konversi()
   {
       if($this->input->is_ajax_request()){
          
          $nim = $this->input->post('nim');
          $smtk = $this->session->userdata('smtk');
          $jmlsks = $this->session->userdata('jmlsks');

          if($jmlsks>0)
          {
            foreach ($smtk as $kdkmk => $v) {
             if($v['pilih']==1){                  
                 echo $kdkmk.'<br>';
                 $this->Trnlp_model->deletedata($nim,$kdkmk);
              }   
            }  
          }   
          echo ''; 

       }
   }

   public function export_mtk_konversi()
   {
       if($this->input->is_ajax_request()){
          
          $nim = $this->input->post('nim');
          $this->Trnlm_trnlp_model->deletedata($nim,'00000');

          $data = $this->Trnlp_model->getdata("thsmstrnlp='00000' and nimhstrnlp='$nim'");
          
          if($this->Trnlp_model->numrows>0)
          {
             foreach($data as $row)
             {
               $tmp = array('thsmstrnlm'=>'00000','nimhstrnlm'=>$nim,'kdkmktrnlm'=>$row['kdkmktrnlp'],'nlakhtrnlm'=>$row['nlakhtrnlp'],'bobottrnlm'=>$row['bobottrnlp'],'kelastrnlm'=>$row['kelastrnlp']); 
               $this->Trnlm_trnlp_model->insertdata($tmp);    
             }
          }

          echo '';

       }
   }

}