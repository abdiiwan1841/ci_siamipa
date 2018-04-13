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

  public function filter_stat_mhs()
  {
    if($this->input->is_ajax_request()){
      $thnsms = $this->input->post('sem');
      $mythnsem = new mythnsem();
      $thnsms1=$mythnsem->substhnsem($thnsms,1);
    
      $tbstat = array("id" => "lst_stat");
      $header = array(array('Angkatan','NIM','Nama','Kelas',$mythnsem->gettxtthnsem($thnsms1),$mythnsem->gettxtthnsem($thnsms)));
      $data_table = array();
            
      $tmp=$mythnsem->getlstthnsem('',$thnsms);
      $tmp=implode(',', array_keys($tmp));
      $txt_filter =rtrim($tmp, ',');
      
      $data = $this->Msmhs_model->getdata("smawlmsmhs in ($txt_filter)");
    
      if($this->Msmhs_model->numrows>0)
      {
        foreach($data as $row)
        {
         $temp_data=array();
         $temp_data[]=array('Angkatan '.$row["tahunmsmhs"],array());
         $temp_data[]=array($row["nimhsmsmhs"],array());
         $temp_data[]=array($row["nmmhsmsmhs"],array());     
         $temp_data[]=array($row["shiftmsmhs"]=="R" ? "Reguler" : "Non Reguler",array());   
         $temp_data[]=array($this->Stat_mhs_model->getstatmhs($thnsms1,$row["nimhsmsmhs"]),array());
         $temp_data[]=array($this->Stat_mhs_model->getstatmhs($thnsms,$row["nimhsmsmhs"]),array());
         $data_table[]=$temp_data;
        }   
      }

      $tbl = new mytable($tbstat,$header,$data_table,"");
      $json_data['stat']=$tbl->display(); 

         $tbstat1 = array("id" => "lst_summary");
         $header1 = array(array(
                              array('Angkatan',array('rowspan'=>2)), 
                              array('Kelas',array('rowspan'=>2)), 
                              array('Aktif',array('colspan'=>2)),
                              array('Cuti',array('colspan'=>2)),
                              array('DO',array('colspan'=>2)),
                              array('Keluar',array('colspan'=>2)),
                              array('Lulus',array('colspan'=>2)),
                              array('Non Aktif',array('colspan'=>2)), 
                              array('Total',array('rowspan'=>2))
                              ),
                        array('L','P','L','P','L','P','L','P','L','P','L','P'));
         $data_table1 = array();   
         
         $data = $this->Stat_mhs_model->getAngkatan($txt_filter);
          
          if($this->Stat_mhs_model->numrows>0)
          {
              $jmltot = array('1'=>array('L'=>0,'P'=>0,'jml'=>0),
                            '2'=>array('L'=>0,'P'=>0,'jml'=>0),
                            '3'=>array('L'=>0,'P'=>0,'jml'=>0),
                            '4'=>array('L'=>0,'P'=>0,'jml'=>0),
                            '5'=>array('L'=>0,'P'=>0,'jml'=>0),
                            '6'=>array('L'=>0,'P'=>0,'jml'=>0),
                            'T'=>array('L'=>0,'P'=>0,'jml'=>0)
                            );
          $kls = array('R','N');
          foreach($data as $row)
          {
             
             foreach($kls as $kls1)
             {
              $temp_data=array();
              $temp_data[]=array($row['tahunmsmhs'],array());
              $temp_data[]=array($kls1=='R' ? "Reguler" : "Non Reguler",array());
              $jml=$this->Stat_mhs_model->getjmlmhs_jmlstat($thnsms,$row['tahunmsmhs'],$kls1);      
                      
              array_walk($jmltot,function(&$value,$key) use (&$temp_data,$jml){
                if($key!='T'){
                          $temp_data[]=array($tmp=$jml[$key]['L'],array());
                          $value['L']+=$tmp;  
                          $temp_data[]=array($tmp=$jml[$key]['P'],array());
                          $value['P']+=$tmp;
                          $tmp=$jml[$key]['jml'];
                }else{
                      $temp_data[]=array($tmp=$jml[$key]['jml'],array());
                    }
                
                $value['jml']+=$tmp;
              });
              
              $data_table1[]=$temp_data;
            }
          }
                $temp_data=array();   
                $temp_data[]=array('Jumlah',array());
            $temp_data[]=array('',array());
            
                array_walk($jmltot,function($value,$key) use (&$temp_data){
               if($key!='T'){
                          $temp_data[]=array($value['L'],array());
                          $temp_data[]=array($value['P'],array());                    
                }else{ 
                 $temp_data[]=array($value['jml'],array());
                  }
              });
              
                $data_table1[]=$temp_data;      
          } 

          $tbl1 = new mytable($tbstat1,$header1,$data_table1,"");
          $json_data['sum']=$tbl1->display();
          $json_data['txt']=$mythnsem->gettxtthnsem($thnsms); 
          echo json_encode($json_data);
    }
  } 

  public function frm_add()
  {
   if($this->input->is_ajax_request()){
     
     $frm = new HTML_Form(); 
   
     $tbstat = array("id" => "lst_stat");
     $header = array(array('Angkatan','NIM','Nama','Status'));
     $data_table  = array();
     
      $thnsms = $this->input->post('sem');
      $mythnsem = new mythnsem;
      $tmp=$mythnsem->getlstthnsem('',$thnsms);
      $tmp=implode(',', array_keys($tmp));
      $txt_filter =rtrim($tmp, ',');    
    
      $data = $this->Msmhs_model->getdata("smawlmsmhs in ($txt_filter) and nimhsmsmhs not in (select nimstat_mhs from stat_mhs where thnsmsstat_mhs=$thnsms)");
      
      if($this->Msmhs_model->numrows>0)
      {
          foreach($data as $row)
      {
       $temp_data=array();
       $temp_data[]=array('Angkatan '.$row["tahunmsmhs"], null, 'data');     
       $temp_data[]=array($row["nimhsmsmhs"], null, 'data');
         $temp_data[]=array($row["nmmhsmsmhs"], null, 'data');
       $idx=$row["nimhsmsmhs"];
       $temp_data[]=array($frm->addSelectList("stat[$idx]",array(1=>"Aktif",2=>"Cuti",3=>"DO",4=>"Keluar",5=>"Lulus",6=>"Non Aktif"),true,null,null,array('id'=>'stat')),array('align'=>'center'));
       $data_table[]=$temp_data;
      }   
      }
      
     $tbl = new mytable($tbstat,$header,$data_table,"");
     $json_data['form']=$frm->startForm(null,'post','entrystatmhs').$tbl->display().$frm->endForm();
     $json_data['btn']=$frm->addInput('submit',"save","Save",array('class'=>'btn btn-info pull-left','id'=>'add_save'));
     echo json_encode($json_data);
   }  
  }

  public function frm_edit()
  {
   if($this->input->is_ajax_request()){
        
     $frm = new HTML_Form(); 
      
   $tbstat = array("id" => "lst_stat");
   $header = array(array('Angkatan','NIM','Nama','Status'));
   $data_table  = array();        
     
    $thnsms = $this->input->post('sem'); 
    $mythnsem = new mythnsem;
    $tmp=$mythnsem->getlstthnsem('',$thnsms);
    $tmp=implode(',', array_keys($tmp));
    $txt_filter =rtrim($tmp, ',');
      
    $data = $this->Msmhs_model->getdata("smawlmsmhs in ($txt_filter) and nimhsmsmhs in (select nimstat_mhs from stat_mhs where thnsmsstat_mhs=$thnsms)");
    
    if($this->Msmhs_model->numrows>0)
    {
        foreach($data as $row)
        {
         $temp_data=array();
         $temp_data[]=array($row["tahunmsmhs"], array());
         $temp_data[]=array($row["nimhsmsmhs"], array());
         $temp_data[]=array($row["nmmhsmsmhs"], array());
         $tmp=$this->Stat_mhs_model->getstatmhs($thnsms,$row["nimhsmsmhs"],-1);
         $idx=$row["nimhsmsmhs"];
         $temp_data[]=array($frm->addSelectList("stat[$idx]",array(1=>"Aktif",2=>"Cuti",3=>"DO",4=>"Keluar",5=>"Lulus",6=>"Non Aktif"),true,intval($tmp),null,array('id'=>'stat')),array('align'=>'center'));
         $data_table[]=$temp_data;
        }   
    }    
   
     $tbl = new mytable($tbstat,$header,$data_table,"");
     $json_data['form']=$frm->startForm(null,'post','entrystatmhs').$tbl->display().$frm->endForm();
     $json_data['btn']=$frm->addInput('submit',"save","Save",array('class'=>'btn btn-info pull-left','id'=>'edit_save'));
     echo json_encode($json_data);
   }
 }

  public function frm_del()
  {
   if($this->input->is_ajax_request()){
    
   $frm = new HTML_Form();   
   
   $tbstat = array("id" => "lst_stat");
   $header = array(array('Angkatan','NIM','Nama','Status','Hapus'));
   $data_table  = array();          
    
    $thnsms = $this->input->post('sem'); 
    $mythnsem = new mythnsem;
    $tmp=$mythnsem->getlstthnsem('',$thnsms);
    $tmp=implode(',', array_keys($tmp));
    $txt_filter =rtrim($tmp, ',');
      
    $data = $this->Msmhs_model->getdata("smawlmsmhs in ($txt_filter) and nimhsmsmhs in (select nimstat_mhs from stat_mhs where thnsmsstat_mhs=$thnsms)");
    
    if($this->Msmhs_model->numrows>0)
    {
        foreach($data as $row)
    {
     $temp_data=array();
     $temp_data[]=array($row["tahunmsmhs"],array());
     $temp_data[]=array($row["nimhsmsmhs"],array());
       $temp_data[]=array($row["nmmhsmsmhs"],array());
     $tmp=$this->Stat_mhs_model->getstatmhs($thnsms,$row["nimhsmsmhs"]);
     $temp_data[]=array($tmp,array());
     $temp_data[]=array($frm->addInput('checkbox',"plh[]",$row["nimhsmsmhs"]), array('align'=>'center'));
     $data_table[]=$temp_data;
    }   
    }
       
   $tbl = new mytable($tbstat,$header,$data_table,"");
     $json_data['form']=$frm->startForm(null,'post','entrystatmhs').$tbl->display().$frm->endForm();
     $json_data['btn']=$frm->addInput('submit',"del","Delete",array('class'=>'btn btn-info pull-left','id'=>'del_save'));
     echo json_encode($json_data);
   }
  } 

  public function import()
  {
   if($this->input->is_ajax_request()){
     $thnsms = $this->input->post('sem');
     $this->Stat_mhs_model->deletealldata($thnsms);
     $mythnsem = new mythnsem;
     $thnsms_1=$mythnsem->substhnsem($thnsms,1);
     $this->Stat_mhs_model->importdata("stat_mhs","thnsmsstat_mhs,nimstat_mhs,statstat_mhs", $thnsms.",nimstat_mhs,statstat_mhs","thnsmsstat_mhs=".$thnsms_1);
   }
 }

  public function delete_stat_mhs()
  {
    if($this->input->is_ajax_request()){
       $thnsms = $this->input->post('sem');
       $plh = $this->input->post('plh');

       if(!empty($plh))
       {
         echo 'hapus';
         foreach ($plh as $nim) {
           $data = array('thnsmsstat_mhs'=>$thnsms,
                         'nimstat_mhs'=>$nim
                        );
            $this->Stat_mhs_model->deletedata($data);
          } 
       }

    }
  }

  public function insert_stat_mhs()
  {
    if($this->input->is_ajax_request()){
       $thnsms = $this->input->post('sem');
       $stat = $this->input->post('stat');

       if(!empty($stat))
       {
         foreach ($stat as $nim => $v) {
           $data = array('thnsmsstat_mhs'=>$thnsms,
                         'nimstat_mhs'=>$nim,
                         'statstat_mhs'=>$v
                        );
            $this->Stat_mhs_model->insertdata($data);
          } 
       }

    }
  }

  public function save_stat_mhs()
  {
    if($this->input->is_ajax_request()){
       $thnsms = $this->input->post('sem');
       $stat = $this->input->post('stat');

       if(!empty($stat))
       {
         foreach ($stat as $nim => $v) {
           $data = array('thnsmsstat_mhs'=>$thnsms,
                         'nimstat_mhs'=>$nim,
                         'statstat_mhs'=>$v
                        );
            $this->Stat_mhs_model->updatedata($data);
          } 
       }

    }
  } 

  public function ctk_excel($thnsms)
  {   
        $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){

              $mythnsem = new mythnsem;
             
              //$thnsms = $this->input->post('sem');
              $tmp=$mythnsem->getlstthnsem('',$thnsms);
              $tmp=implode(',', array_keys($tmp));
              $txt_filter =rtrim($tmp, ',');
              
              $datalstmhs = $this->Msmhs_model->getdata("smawlmsmhs in ($txt_filter)");   
              $datasumstat = $this->Stat_mhs_model->getAngkatan($txt_filter);
                   
                $tmp= dirname((dirname(dirname(__FILE__))))."/assets/cetak/Admin/stat_mhs/status mahasiswa ".$thnsms.".xls";
                $this->load->library('ctkstat');
                $this->ctkstat->ctk_stat($datalstmhs,$datasumstat,$thnsms);
                //$this->ctkstat->save($tmp);
                
                $filename="status mahasiswa ".$thnsms.".xls"; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                $this->ctkstat->download();


                //$tmp= base_url()."/assets/cetak/Admin/stat_mhs/status mahasiswa ".$thnsms.".xls";     
                //echo $tmp;  

           }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }     
  }

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

       
       echo $this->load->view('Admin/frm_dt_konversi',$data,true);

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