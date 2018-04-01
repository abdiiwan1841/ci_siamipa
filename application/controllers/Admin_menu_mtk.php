<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_menu_mtk extends CI_Controller {

  private function ismrhitl($iswp,$data)
  {
     if($iswp=='p'){
        return "<font color='red'><i>".$data."</i></font>";
     }else{
        return "$data";
     }
  }

  public function get_dt_mtk()
  {
     if($this->input->is_ajax_request()){       
       
       $hak = $this->session->userdata('hak');
             
       $tbstat = array("id" => "lst_mtk",'width'=>'100%');  
       $header = array(array('Semester','Kode','Nama','sks','Pengampu','Prasyarat','Aksi'));
       $isi_data = array();
       
       $data = $this->Mtk_model->getdata('');        
       if($this->Mtk_model->numrows>0){        
        foreach($data as $row)
        {          
            $tmp=array();            
            $tmp[]=array('Semester '.$row['semestbkmk'],array());
            $tmp[]=array($this->ismrhitl($row['wp'],$row['kdkmktbkmk']),array());
            $tmp[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']),array());
            $tmp[]=array($this->ismrhitl($row['wp'],floor($row['sksmktbkmk']).'  ('.$row['skstmtbkmk'].'-'.$row['sksprtbkmk'].')'),array());

            $tmp_nm='';
            if($row['nodostbkmk']!=""){
              $tmp_nm=$this->Dosen_model->getnmdsn($row['nodostbkmk']); 
            }

            $tmp[]=array($tmp_nm,array());

            $kd=$row['kdkmktbkmk'];
            $dt_syarat=$this->Syarat_model->getdata("kdkmksyarat='$kd'");
      
            $txt='';
            if(!empty($dt_syarat))
            {
               foreach($dt_syarat as $dt)
               {
                 $txt.=$dt['syaratkmk'].',';         
               }      
            }
            $txt  = rtrim($txt, ',');
            $tmp[]=array($txt,array());            
            
            $button ='<div class="btn-group">
                   <button type="button" class="btn btn-default btn-sm" onclick="view('."'".$row['kdkmktbkmk']."'".')" >
                     <i class="fa fa-search"></i>
                  </button>';
            if($hak==1){    
                $button.='<button type="button" class="btn btn-default btn-sm" onclick="edit('."'".$row['kdkmktbkmk']."'".')" >
                     <i class="fa fa-edit"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" onclick="del('."'".$row['kdkmktbkmk']."'".')" >
                     <i class="fa fa-trash"></i>
                  </button>';                  
            }
           $button.='</div>';

            $tmp[]=array($button,array());            
            $isi_data[]=$tmp;          
        } 
       } 

       $txt = "<tr>";
       $txt = $txt."<th></th>";
       $txt = $txt."<th><input type='hidden' name='search_sem' value='Search sem' class='search_init' /><input type='text' name='search_kode' value='Kode' class='search_init' style='width:30px' /></th>";
       $txt = $txt."<th><input type='text' name='search_nm' value='Nama' class='search_init' style='width:150px'/></th>";
       $txt = $txt."<th></th>";
       $txt = $txt."<th></th>";
       $txt = $txt."<th></th>";
       $txt = $txt."</tr>";
       
       $tbl = new mytable($tbstat,$header,$isi_data,$txt); 
       echo $tbl->display();
     } 
  }

 

  public function insert_dt_mtk()
  {
    if($this->input->is_ajax_request()){
      
      $data['kdkmktbkmk'] = $this->input->post('kdkmk');      
      if(!$this->Mtk_model->kode_ada($data['kdkmktbkmk']))
      {     
              
              $data['nakmktbkmk'] = $this->input->post('nama');
              $data['skstmtbkmk'] = $this->input->post('skstmtbkmk');
              $data['sksprtbkmk'] = $this->input->post('sksprtbkmk');
              $data['skslptbkmk'] = $this->input->post('skslptbkmk');
              $data['semestbkmk'] = $this->input->post('sem');
              $data['sksmktbkmk'] = $data['skstmtbkmk']+$data['sksprtbkmk']+$data['skslptbkmk'];
              $data['wp'] = $this->input->post('wp');            
              $data['kdprtk'] = $this->input->post('kdprtk'); 
              $data['nodostbkmk'] = $this->input->post('kddsn');
              $plh = $this->input->post('plh');                  

              $this->Mtk_model->insertdata($data);
              $this->Syarat_model->deletedata($data['kdkmktbkmk']);  
              
              if(!empty($plh))
              {
                foreach ($plh as $row) {
                  $tmp = array('kdkmksyarat'=>$data['kdkmktbkmk'],'syaratkmk'=>$row);
                  $this->Syarat_model->insertdata($tmp);     
                }
              } 

              


        echo json_encode(array('msg'=>''));  
      }else{
        echo json_encode(array('msg'=>'<div class="callout callout-danger"><h4>Pemberitahuan</h4><p>Matakuliah dengan Kode='.$data['kdkmktbkmk'].' sudah ada !!!</p> </div>'));
      }  
    }
  }

  

  public function save_dt_mtk()
  {
    if($this->input->is_ajax_request()){
      
      $data['old_kode'] = $this->input->post('old_kode');
      $data['kdkmktbkmk'] = $this->input->post('kdkmk');      
      $issave = true;
      if($data['old_kode']!=$data['kdkmktbkmk'])
      {
       $issave=!$this->Mtk_model->kode_ada($data['kdkmktbkmk']);      
      }

      if($issave){
              $data['nakmktbkmk'] = $this->input->post('nama');
              $data['skstmtbkmk'] = $this->input->post('skstmtbkmk');
              $data['sksprtbkmk'] = $this->input->post('sksprtbkmk');
              $data['skslptbkmk'] = $this->input->post('skslptbkmk');
              $data['semestbkmk'] = $this->input->post('sem');
              $data['sksmktbkmk'] = $data['skstmtbkmk']+$data['sksprtbkmk']+$data['skslptbkmk'];
              $data['wp'] = $this->input->post('wp');            
              $data['kdprtk'] = $this->input->post('kdprtk'); 
              $data['nodostbkmk'] = $this->input->post('kddsn');  
              $plh = $this->input->post('plh'); 

              $this->Mtk_model->updatedata($data);
              $this->Syarat_model->deletedata($data['old_kode']);  
              
              if(!empty($plh))
              {
                foreach ($plh as $row) {
                  $tmp = array('kdkmksyarat'=>$data['kdkmktbkmk'],'syaratkmk'=>$row);
                  $this->Syarat_model->insertdata($tmp);     
                }
              }
              

        echo json_encode(array('msg'=>''));  
        }else{
            echo json_encode(array('msg'=>'<div class="callout callout-danger"><h4>Pemberitahuan</h4><p>Dosen dengan Kode='.$data['kdkmktbkmk'].' sudah ada !!!</p> </div>'));
        }  
      
    }
  }

  

  public function delete_dt_mtk()
  {
    if($this->input->is_ajax_request()){
        $kode = $this->input->post('kode');
        $this->Mtk_model->deletedata($kode);
        $this->Syarat_model->deletedata($kode);
      echo "hapus";
    }
  }  

  public function view_dt_mtk()
  {
     if($this->input->is_ajax_request()){
        $idx = $this->input->post('idx');
        $kode = $this->input->post('kode');

        $hak = $this->session->userdata('hak');

              $wp=array('w'=>'Wajib','p'=>'Pilihan');
                     
              $mythnsem = new mythnsem;
              $default=array(array('Kode','kdkmktbkmk',''),      
              array('Nama','nakmktbkmk', ''),
              array('SKS Tatap Muka','skstmtbkmk', 0),
              array('SKS Praktikum','sksprtbkmk',0),
              array('SKS Lapangan','skslptbkmk', 0),
              array('Semester','semestbkmk', ''),
              array('Wajib/Pilihan','wp',$wp['w']),             
              array('Kode Praktikum','kdprtk',''),
              array('Dosen Pengampu','nodostbkmk',''));
             
             $tmp = $this->Mtk_model->getdata("kdkmktbkmk='$kode'");
              if(!empty($tmp)){
                 $tmp=$tmp[0];                

                 foreach ($default as $key=>$row) {
                   
                    switch ($key) {
                        case 6:
                         $view[$row[0]]=$wp[$tmp[$row[1]]];
                        break;
                        case 7:
                        $view[$row[0]]= empty($tmp[$row[1]]) ? 'Tidak ada praktikum' : $tmp[$row[1]].' - '.$this->Mtk_model->nmmk($tmp[$row[1]]);
                        break;
                        case 8:
                         $view[$row[0]]= empty($tmp[$row[1]]) ? 'Tidak Ditentukan' : $this->Dosen_model->getnmdsn($tmp[$row[1]]);
                        break;                        
                      default:
                        $view[$row[0]]=$tmp[$row[1]];
                        break;
                    }
                 }
              }else{
                 foreach ($default as $key=>$row) {
                   $view[$row[0]]=$row[2];
                 }
              }

              $data['view']=$view;
              $data['hak']=$hak;
              $data['idx']=$idx;            
              $data['Kode']=$kode;

        switch ($idx) {
            case 1:              
              $data['judul']='View Matakuliah';
              break;
            case 2:                           
              $data['judul']='Delete Matakuliah';
              break;           
            default:
              # code...
              break;
          }  

          $tbstat = array("id" => "lst_prasyarat",'width'=>'100%');  
          $header = array(array('Semester','Kode','Nama'));
          $isi_data = array();
          
          $dtsyarat = $this->Syarat_model->getdata("kdkmksyarat='$kode'");
          $frm = new html_form(); 
          if($this->Syarat_model->numrows>0)
          {
            foreach ($dtsyarat as $row) {
                $tmp=array();                
                $dtmtk=$this->Mtk_model->getdata('kdkmktbkmk="'.$row['syaratkmk'].'"'); 
                if($this->Mtk_model->numrows>0){
                  $tmp[]=array('Semester '.$dtmtk[0]['semestbkmk'],array());                
                  $tmp[]=array($this->ismrhitl($dtmtk[0]['wp'],$row['syaratkmk']),array());                
                  $nama = str_replace(' ', '&nbsp;',$dtmtk[0]['nakmktbkmk']);
                  $tmp[]=array($this->ismrhitl($dtmtk[0]['wp'],$nama),array());                  
                }else{
                  $tmp[]=array('Seemster 00',array());                
                  $tmp[]=array($row['syaratkmk'],array());
                  $tmp[]=array('',array());
                }
                $isi_data[] = $tmp; 
              }  
          }
          $tbl = new mytable($tbstat,$header,$isi_data,''); 
          $data['lstsyarat']=$tbl->display();
            
        
        echo $this->load->view('Admin/view_dt_mtk',$data,true);
     } 
  }

  public function frm_dt_mtk()
  {
     if($this->input->is_ajax_request()){
        $idx = $this->input->post('idx');
        $mythnsem = new mythnsem;
              $data['kdkmktbkmk'] = '';      
              $data['nakmktbkmk'] = '';
              $data['skstmtbkmk'] = 0;
              $data['sksprtbkmk'] = 0;
              $data['skslptbkmk'] = 0;
              $data['semestbkmk'] = '01';
              $data['wp'] = 'w';              
              $data['kdprtk'] = '';
              $data['nodostbkmk'] = '';
              
        switch ($idx) {
            case 1:              
              $data['judul']='Input Matakuliah';
              break;

            case 2:
              $kode = $this->input->post('kode');
              $tmp = $this->Mtk_model->getdata("kdkmktbkmk='$kode'");
              if(!empty($tmp)){
                 $data=$tmp[0];
              }              
              $data['judul']='Edit Matakuliah';
              break;  

            
            default:
              # code...
              break;
          } 

          $tbstat = array("id" => "lst_prasyarat",'width'=>'100%');  
          $header = array(array('Semester','Kode','Nama','Plih'));
          $isi_data = array();
          
          $dtmtk = $this->Mtk_model->getdata("kdkmktbkmk not like 'MATP%' and kdkmktbkmk not in ('UBB106','MAT370','MAT352','MAT353')");
          $frm = new html_form(); 
          if($this->Mtk_model->numrows>0)
          {
            foreach ($dtmtk as $row) {
                $tmp=array();            
                $tmp[]=array('Semester '.$row['semestbkmk'],array());
                $tmp[]=array($this->ismrhitl($row['wp'],$row['kdkmktbkmk']),array());
                $nama = str_replace(' ', '&nbsp;',$row['nakmktbkmk']);
                $tmp[]=array($this->ismrhitl($row['wp'],$nama),array());

                $stat = array();
                if($idx==2){
                  if($this->Syarat_model->kode_ada($data['kdkmktbkmk'],$row['kdkmktbkmk'])){
                    $stat['checked']='checked';
                  }    
                }

                $tmp[]=array($frm->addInput('checkbox',"plh[]",$row['kdkmktbkmk'],$stat),array());   
                $isi_data[] = $tmp; 
              }  
          }
          $tbl = new mytable($tbstat,$header,$isi_data,''); 
          $data['lstsyarat']=$tbl->display();     

          
          $data['lstprtk'] = $this->Mtk_model->cmbprkt();
          $data['lstkddsn'] = $this->Dosen_model->cmbdsn();             
           
        echo $this->load->view('Admin/frm_dt_mtk',$data,true);
     } 
  }
}