<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_menu_dashboard extends CI_Controller {

  public function gambarchart()
  {
    if($this->input->is_ajax_request()){
           $idx = $this->input->post('idx');
           switch ($idx) {
            case 1:
                  $data = $this->vw_rekapstatmhs_model->getdtchart(new mythnsem);
                  echo json_encode($data);
                  break;
            case 2:
                  $data = $this->vw_rekapstatmhs_model->getdtchart1(new mythnsem);
                  echo json_encode($data);
                  break;      
            case 3:
                  $data = $this->vw_rekapstatmhs_model->getdtchart2(new mythnsem);
                  echo json_encode($data);
                  break;      
            case 4:
                  $data = $this->vw_rekapkeu_model->getdtchart();
                  echo json_encode($data);
                  break;                  
            case 5:
                  $data = $this->vw_rekapkeu_model->getdtchart1();
                  echo json_encode($data);
                  break;      
            case 6:
                  $data = $this->vw_rekapkeu_model->getdtchart2();
                  echo json_encode($data);
                  break;      
            default:
                  # code...
                  break;
           }
    }
  }

  public function get_lst_file()
  {
     if($this->input->is_ajax_request()){
       
       $dirs=directory_map('./assets/cetak/Admin');
       
       $tbstat = array("id" => "lstfile",'width'=>'100%');  
       $header = array(array('No','Check','Nama File','Folder','Aksi'));
       $isi_data = array();
       
       $frm = new HTML_Form();
        $i=1;
        $this->session->unset_userdata('nmfile');
        $arr_nm_file=array();
        foreach($dirs as $dir=>$files)
        {
          foreach ($files as $file) {
           $tmp=array();
            $tmp[]=array($i++,array());
            $tmp[]=array($frm->addInput('checkbox',"lst[]",($i-2),array('id'=>($i-2),'onclick'=>'pilih_file('.($i-2).')')),array());
            $tmp[]=array($file,array());            
            $tmp[]=array($dir,array());
            $arr_nm_file[] = array('nmfile'=>$dir.$file,'tandai'=>0);  
            $link='';
            $tmp[]=array('<div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" onclick="deletefile('.($i-2).')" ><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm" onclick="downloadfile('.($i-2).')" ><i class="fa fa-download"></i></button>                  
                </div>',array());       
            $isi_data[]=$tmp;         
          } 
        } 
       $this->session->set_userdata('nmfile',$arr_nm_file);
       $tbl = new mytable($tbstat,$header,$isi_data,''); 
       echo $tbl->display();
     } 
  }

  public function delete_selected_file()
  {
     if($this->input->is_ajax_request()){
        $files = $this->session->userdata('nmfile');
        if(!empty($files))
        {          
          foreach ($files as $file) {
           if($file['tandai']==1){  
             if(file_exists('./assets/cetak/Admin/'.$file['nmfile']))
              { 
                unlink('./assets/cetak/Admin/'.$file['nmfile']);
              }
            }  
          }  

        } 
     } 
  }

  public function delete_file()
  {
     if($this->input->is_ajax_request()){
        $idx = $this->input->post('idx');      
        $nmfile = $this->session->userdata('nmfile');
        if(!empty($nmfile))
        {          
          if(file_exists('./assets/cetak/Admin/'.$nmfile[$idx]['nmfile']))
          { 
            unlink('./assets/cetak/Admin/'.$nmfile[$idx]['nmfile']);
          }
        }
     } 
  }

  public function select_file()
  {
     if($this->input->is_ajax_request()){
        $idx = $this->input->post('idx');
        $cek = $this->input->post('cek');      
        $nmfile = $this->session->userdata('nmfile');
        $nmfile[$idx]['tandai']=$cek;
        $this->session->set_userdata('nmfile',$nmfile);       
     } 
  }

}