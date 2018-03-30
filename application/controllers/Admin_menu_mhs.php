<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_menu_mhs extends CI_Controller {
   
  public function get_dt_mhs()
  {
     if($this->input->is_ajax_request()){       
       
       $hak = $this->session->userdata('hak');
       
       $tbstat = array("id" => "lst_mhs",'width'=>'100%');  
       $header = array(array('tahunmsmhs','NIM','Nama','Jenis Kelamin','Kelas','Baru/Pindahan','Aksi'));
       $isi_data = array();
       
       $data = $this->Msmhs_model->getdata('');        
       if($this->Msmhs_model->numrows>0){        
        foreach($data as $row)
        {          
            $tmp=array();            
            $tmp[]=array('Angkatan '.$row['tahunmsmhs'],array());
            $tmp[]=array($row['nimhsmsmhs'],array());
            $tmp[]=array($row['nmmhsmsmhs'],array());
            $tmp[]=array($row['kdjekmsmhs']=='P' ? 'Perempuan' : 'Laki-Laki',array());
            $tmp[]=array($row['shiftmsmhs']=='R' ? 'Reguler' : 'Non Reguler',array());
            $tmp[]=array($row['bpmsmhs']==0 ? 'Baru' : 'Pindahan' ,array()); 
            
            $button ='<div class="btn-group">
                   <button type="button" class="btn btn-default btn-sm" onclick="view('."'".$row['nimhsmsmhs']."'".')" >
                     <i class="fa fa-search"></i>
                  </button>';
            if($hak==1){    
                $button.='<button type="button" class="btn btn-default btn-sm" onclick="edit('."'".$row['nimhsmsmhs']."'".')" >
                     <i class="fa fa-edit"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" onclick="del('."'".$row['nimhsmsmhs']."'".')" >
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
          $txt = $txt."<th><input type='hidden' name='search_angkatan' value='Search angkatan' class='search_init' /><input type='text' name='search_nim' value='NIM' class='search_init' style='width:45px' /></th>";
          $txt = $txt."<th><input type='text' name='search_nm' value='Nama' class='search_init' style='width:140px'/></th>";
          $txt = $txt."<th></th>";
          $txt = $txt."<th></th>";
          $txt = $txt."<th></th>";                  
          $txt = $txt."</tr>";
       
       $tbl = new mytable($tbstat,$header,$isi_data,$txt); 
       echo $tbl->display();
     } 
  }

  public function frm_dt_mhs()
  {
     if($this->input->is_ajax_request()){
        $idx = $this->input->post('idx');
        $mythnsem = new mythnsem;
              $data['nimhsmsmhs'] = '';      
              $data['nmmhsmsmhs'] = '';
              $data['tahunmsmhs'] = '';
              $data['tplhrmsmhs'] = '';
              $data['smawlmsmhs'] = '';
              $data['shiftmsmhs'] = 'R';
              $data['kdjekmsmhs'] = 'L';
              $data['tglhrmsmhs'] = '';
              $data['agamamsmhs'] = '0'; 
              $data['almmsmhs'] = '';
              $data['emailmsmhs'] = '';
              $data['smamsmhs'] = '';
              $data['statmsmhs']= '0';
              $data['tlpmsmhs'] ='';
              $data['bpmsmhs']  = '0';
              $data['link_forlap'] = '';

        switch ($idx) {
            case 1:              
              $data['judul']='Input Data Mahasiswa';
              break;

            case 2:
              $nim = $this->input->post('nim');
              $tmp = $this->Msmhs_model->getdata("nimhsmsmhs='$nim'");
              if(!empty($tmp)){
                 $data=$tmp[0];
                 $data['tglhrmsmhs'] = date("d-m-Y", strtotime($data['tglhrmsmhs']));
                 $data['smawlmsmhs'] = $mythnsem->getsem($data['smawlmsmhs']);
              }              
              $data['judul']='Edit Data Mahasiswa';
              break;  

            
            default:
              # code...
              break;
          }  
            
        
        echo $this->load->view('Admin/frm_dt_mhs',$data,true);
     } 
  }

   public function insert_dt_mhs()
  {
    if($this->input->is_ajax_request()){
      
      $data['nimhsmsmhs'] = $this->input->post('nim');      
      if(!$this->Msmhs_model->nim_ada($data['nimhsmsmhs']))
      {
          $data['kdpstmsmhs']='44201';
          $data['nmmhsmsmhs'] = $this->input->post('nama');
          $data['tahunmsmhs'] = $this->input->post('thnmsk');
          $data['tplhrmsmhs'] = $this->input->post('tempat');
          $data['smawlmsmhs'] = $this->input->post('thnmsk').$this->input->post('sem');
          $data['shiftmsmhs'] = $this->input->post('kelas');
          $data['kdjekmsmhs'] = $this->input->post('kelamin');
          
          if(!empty($this->input->post('datepicker'))){
             $data['tglhrmsmhs'] =date('Y-m-d', strtotime($this->input->post('datepicker'))); ;
          }

          $data['agamamsmhs'] = $this->input->post('agama'); 
          $data['almmsmhs'] = $this->input->post('alamat');
          $data['emailmsmhs'] = $this->input->post('email');
          $data['smamsmhs'] = $this->input->post('penddk');
          $data['statmsmhs'] = $this->input->post('status');
          $data['tlpmsmhs'] = $this->input->post('tlp');
          $data['bpmsmhs'] = $this->input->post('bp');
          $data['pass'] = $this->input->post('nim');
          $data['link_forlap'] = $this->input->post('link_forlap');

          $this->Msmhs_model->insertdata($data);  
        echo json_encode(array('msg'=>''));  
      }else{
        echo json_encode(array('msg'=>'<div class="callout callout-danger"><h4>Pemberitahuan</h4><p>Mahasiswa dengan NIM='.$data['nimhsmsmhs'].' sudah ada !!!</p> </div>'));
      }  
    }
  }

  public function save_dt_mhs()
  {
    if($this->input->is_ajax_request()){
      
      $data['old_nim'] = $this->input->post('old_nim');
      $data['nimhsmsmhs'] = $this->input->post('nim');      
      $issave = true;
      if($data['old_nim']!=$data['nimhsmsmhs'])
      {
       $issave=!$this->Msmhs_model->nim_ada($data['nimhsmsmhs']);      
      }

      if($issave){
          $data['kdpstmsmhs']='44201';
          $data['nmmhsmsmhs'] = $this->input->post('nama');
          $data['tahunmsmhs'] = $this->input->post('thnmsk');
          $data['tplhrmsmhs'] = $this->input->post('tempat');
          $data['smawlmsmhs'] = $this->input->post('thnmsk').$this->input->post('sem');
          $data['shiftmsmhs'] = $this->input->post('kelas');
          $data['kdjekmsmhs'] = $this->input->post('kelamin');
          
          if(!empty($this->input->post('datepicker'))){
             $data['tglhrmsmhs'] =date('Y-m-d', strtotime($this->input->post('datepicker'))); ;
          }

          $data['agamamsmhs'] = $this->input->post('agama'); 
          $data['almmsmhs'] = $this->input->post('alamat');
          $data['emailmsmhs'] = $this->input->post('email');
          $data['smamsmhs'] = $this->input->post('penddk');
          $data['statmsmhs'] = $this->input->post('status');
          $data['tlpmsmhs'] = $this->input->post('tlp');
          $data['bpmsmhs'] = $this->input->post('bp');
          $data['pass'] = $this->input->post('nim');
          $data['link_forlap'] = $this->input->post('link_forlap');

          $this->Msmhs_model->updatedata($data);  
        echo json_encode(array('msg'=>''));  
        }else{
            echo json_encode(array('msg'=>'<div class="callout callout-danger"><h4>Pemberitahuan</h4><p>Mahasiswa dengan NIM='.$data['nimhsmsmhs'].' sudah ada !!!</p> </div>'));
        }  
      
    }
  }

  public function view_dt_mhs()
  {
     if($this->input->is_ajax_request()){
        $idx = $this->input->post('idx');
        $nim = $this->input->post('nim');

        $hak = $this->session->userdata('hak');

        $agama=array(0=>'Islam',1=>'Kristen Protestan',2=>'Kristen Katolik',3=>'Hindu',4=>'Budha');
        $status=array(0=>'Lajang',1=>'Menikah');
        $jk=array('L'=>'Laki-Laki','P'=>'Perempuan');
        $bp=array(0=>'Baru',1=>'Pindahan');
        $kelas=array('R'=>'Reguler','N'=>'Non Reguler');

              $mythnsem = new mythnsem;
              $default=array(array('NIM','nimhsmsmhs',''),      
              array('Nama','nmmhsmsmhs', ''),
              array('Alamat','almmsmhs', ''),
              array('Nomor Telpon','tlpmsmhs',''),
              array('e-mail','emailmsmhs', ''),
              array('Agama','agamamsmhs', $agama[0]),
              array('Status Pernikahan','statmsmhs',$status[0]),
              array('Pendidikan Terakhir','smamsmhs',''),
              array('Jenis Kelamin','kdjekmsmhs',$jk['L']),
              array('Tempat Lahir','tplhrmsmhs', ''),
              array('Tanggal Lahir','tglhrmsmhs', ''),
              array('Baru/Pindahan','bpmsmhs', $bp[0]),
              array('Kelas','shiftmsmhs', $kelas['R']),
              array('Tahun Masuk','tahunmsmhs', ''),              
              array('Masuk di Semester','smawlmsmhs', ''),
              array('Link Forlap','link_forlap',''));
             
             $tmp = $this->Msmhs_model->getdata("nimhsmsmhs='$nim'");
              if(!empty($tmp)){
                 $tmp=$tmp[0];
                 $tmp['tglhrmsmhs'] = date("d-m-Y", strtotime($tmp['tglhrmsmhs']));
                 $tmp['smawlmsmhs'] = $mythnsem->gettxtsem($tmp['smawlmsmhs']);

                 foreach ($default as $key=>$row) {
                   
                    switch ($key) {
                        case 5:
                         $view[$row[0]]=$agama[$tmp[$row[1]]];
                        break;
                        case 6:
                         $view[$row[0]]=$status[$tmp[$row[1]]];
                        break;
                        case 8:
                         $view[$row[0]]=$jk[$tmp[$row[1]]];
                        break;
                        case 11:
                         $view[$row[0]]=$bp[$tmp[$row[1]]];
                        break;
                        case 12:
                         $view[$row[0]]=$kelas[$tmp[$row[1]]];
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
              $data['nimhsmsmhs']=$nim;

        switch ($idx) {
            case 1:              
              $data['judul']='View Data Mahasiswa';
              break;
            case 2:                           
              $data['judul']='Delete Data Mahasiswa';
              break;           
            default:
              # code...
              break;
          }  
            
        
        echo $this->load->view('Admin/view_dt_mhs',$data,true);
     } 
  }

  public function delete_dt_mhs()
  {
    if($this->input->is_ajax_request()){
      $nim = $this->input->post('nim');
      $this->Msmhs_model->deletedata($nim);
      echo "hapus";
    }
  }

}