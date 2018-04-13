<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {
  public function get_dt_dosen()
  {
     if($this->input->is_ajax_request()){       
       
       $hak = $this->session->userdata('hak');
       $mythnsem = new mythnsem();

       $stat_dsn =array('LB'=>"Dosen Luar Biasa",'DTT'=>"Dosen Tidak Tetap",'DTY'=>"Dosen Tetap Yayasan",'DTYLP'=>"Dosen Tetap Yayasan Luar Prodi");
       
       $tbstat = array("id" => "lst_dsn",'width'=>'100%');  
       $header = array(array('Kode','Nama','NIDN','NIDN EPSBED','Status Dosen','Honor Ngajar','Awal Ngajar','Aksi'));
       $isi_data = array();
       
       $data = $this->Dosen_model->getdata('');        
       if($this->Dosen_model->numrows>0){        
        foreach($data as $row)
        {          
            $tmp=array();            
            $tmp[]=array($row['Kode'],array());
            $tmp[]=array($row['Nama'],array());
            $tmp[]=array($row['nidn'],array());
            $tmp[]=array($row['nidn_epsbed'],array());
            $tmp[]=array($stat_dsn[$row['Tstat']],array());
            $tmp[]=array($stat_dsn[$row['Hstat']],array()); 
            $tmp[]=array($mythnsem->gettxtthnsem($row['smawl'],''),array()); 
            
            $button ='<div class="btn-group">
                   <button type="button" class="btn btn-default btn-sm" onclick="view('."'".$row['Kode']."'".')" >
                     <i class="fa fa-search"></i>
                  </button>';
            if($hak==1){    
                $button.='<button type="button" class="btn btn-default btn-sm" onclick="edit('."'".$row['Kode']."'".')" >
                     <i class="fa fa-edit"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" onclick="del('."'".$row['Kode']."'".')" >
                     <i class="fa fa-trash"></i>
                  </button>';                  
            }
           $button.='</div>';

            $tmp[]=array($button,array());            
            $isi_data[]=$tmp;          
        } 
       } 

       $txt = "<tr>";
          $txt = $txt."<th><input type='text' name='search_kode' value='Kode' class='search_init' style='width : 30px' /></th>";
          $txt = $txt."<th><input type='text' name='search_nm' value='Nama' class='search_init'/></th>";
          $txt = $txt."<th></th>";
          $txt = $txt."<th></th>";
          $txt = $txt."<th></th>";
          $txt = $txt."<th></th>";
          $txt = $txt."<th></th>";
          $txt = $txt."<th></th>";
          $txt = $txt."</tr>";
       
       $tbl = new mytable($tbstat,$header,$isi_data,$txt); 
       echo $tbl->display();
     } 
  }

 

  public function insert_dt_dosen()
  {
    if($this->input->is_ajax_request()){
      
      $data['Kode'] = $this->input->post('kode');      
      if(!$this->Dosen_model->kode_ada($data['Kode']))
      {
          
              $data['Kode'] = $this->input->post('kode');
              $data['pass'] = $this->input->post('kode');      
              $data['Nama'] = $this->input->post('nama');
              $data['Tstat'] = $this->input->post('tstat');
              $data['Hstat'] = $this->input->post('hstat');
              $data['smawl'] = $this->input->post('smawl');
              $data['nidn'] = $this->input->post('nidn1');
              $data['nidn_epsbed'] = $this->input->post('nidn2');              
              $data['link_forlap'] = $this->input->post('link_forlap');        

              $this->Dosen_model->insertdata($data);  
        echo json_encode(array('msg'=>''));  
      }else{
        echo json_encode(array('msg'=>'<div class="callout callout-danger"><h4>Pemberitahuan</h4><p>Dosen dengan Kode='.$data['Kode'].' sudah ada !!!</p> </div>'));
      }  
    }
  }

  

  public function save_dt_dosen()
  {
    if($this->input->is_ajax_request()){
      
      $data['old_kode'] = $this->input->post('old_kode');
      $data['Kode'] = $this->input->post('kode');      
      $issave = true;
      if($data['old_kode']!=$data['Kode'])
      {
       $issave=!$this->Dosen_model->kode_ada($data['Kode']);      
      }

      if($issave){
              $data['Kode'] = $this->input->post('kode');
              $data['Nama'] = $this->input->post('nama');
              $data['Tstat'] = $this->input->post('tstat');
              $data['Hstat'] = $this->input->post('hstat');
              $data['smawl'] = $this->input->post('smawl');
              $data['nidn'] = $this->input->post('nidn1');
              $data['nidn_epsbed'] = $this->input->post('nidn2');              
              $data['link_forlap'] = $this->input->post('link_forlap'); 

          $this->Dosen_model->updatedata($data);  
        echo json_encode(array('msg'=>''));  
        }else{
            echo json_encode(array('msg'=>'<div class="callout callout-danger"><h4>Pemberitahuan</h4><p>Dosen dengan Kode='.$data['Kode'].' sudah ada !!!</p> </div>'));
        }  
      
    }
  }

  

  public function delete_dt_dosen()
  {
    if($this->input->is_ajax_request()){
      $kode = $this->input->post('kode');
      $this->Dosen_model->deletedata($kode);
      echo "hapus";
    }
  }  

  public function view_dt_dosen()
  {
     if($this->input->is_ajax_request()){
        $idx = $this->input->post('idx');
        $kode = $this->input->post('kode');

        $hak = $this->session->userdata('hak');

        $tstat=array('DTT'=>'Dosen Tidak Tetap','DTY'=>'Dosen Tetap Yayasan','DTYLP'=>'Dosen Tetap Yayasan Luar Prodi','LB'=>'Dosen Luar Biasa');
                     
              $mythnsem = new mythnsem;
              $default=array(array('Kode','Kode',''),      
              array('Nama','Nama', ''),
              array('Status Dosen','Tstat', $tstat['LB']),
              array('Honor Ngajar','Hstat',$tstat['LB']),
              array('Awal Ngajar','smawl', $mythnsem->gettxtthnsem(20081)),
              array('NIDN','nidn', ''),
              array('NIDN EPSBED','nidn_epsbed',''),             
              array('Link Forlap','link_forlap',''));
             
             $tmp = $this->Dosen_model->getdata("Kode='$kode'");
              if(!empty($tmp)){
                 $tmp=$tmp[0];
                 

                 foreach ($default as $key=>$row) {
                   
                    switch ($key) {
                        case 2:
                         $view[$row[0]]=$tstat[$tmp[$row[1]]];
                        break;
                        case 3:
                         $view[$row[0]]=$tstat[$tmp[$row[1]]];
                        break;
                        case 4:
                         $view[$row[0]]=$mythnsem->gettxtthnsem($tmp[$row[1]]);
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
              $data['judul']='View Data Dosen';
              break;
            case 2:                           
              $data['judul']='Delete Data Dosen';
              break;           
            default:
              # code...
              break;
          }  
            
        
        echo $this->load->view('Admin/Dosen/view_dt_dosen',$data,true);
     } 
  }

  public function frm_dt_dosen()
  {
     if($this->input->is_ajax_request()){
        $idx = $this->input->post('idx');
        $mythnsem = new mythnsem;
              $data['Kode'] = '';      
              $data['Nama'] = '';
              $data['Tstat'] = 'LB';
              $data['Hstat'] = 'LB';
              $data['smawl'] = '20081';
              $data['nidn'] = '';
              $data['nidn_epsbed'] = '';              
              $data['link_forlap'] = '';
              
        switch ($idx) {
            case 1:              
              $data['judul']='Input Data Dosen';
              break;

            case 2:
              $kode = $this->input->post('kode');
              $tmp = $this->Dosen_model->getdata("Kode='$kode'");
              if(!empty($tmp)){
                 $data=$tmp[0];
              }              
              $data['judul']='Edit Data Dosen';
              break;  

            
            default:
              # code...
              break;
          }  
            
          $data['lst']=$mythnsem->getlstthnsem(); 
        echo $this->load->view('Admin/Dosen/frm_dt_dosen',$data,true);
     } 
  }
}