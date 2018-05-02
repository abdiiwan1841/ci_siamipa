<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stat_mhs extends CI_Controller {

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
     $json_data['btn']=$frm->addInput('submit',"save","Save",array('class'=>'btn btn-info pull-left','id'=>'add_save')).$frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));
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
         $temp_data[]=array('Angkatan '.$row["tahunmsmhs"], array());
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
     $json_data['btn']=$frm->addInput('submit',"save","Save",array('class'=>'btn btn-info pull-left','id'=>'edit_save')).$frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));
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
     $temp_data[]=array('Angkatan '.$row["tahunmsmhs"],array());
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
     $json_data['btn']=$frm->addInput('submit',"del","Delete",array('class'=>'btn btn-info pull-left','id'=>'del_save')).$frm->addInput('submit',"Cancel","Cancel",array('class'=>'btn btn-info pull-left','id'=>'cancel'));
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

}