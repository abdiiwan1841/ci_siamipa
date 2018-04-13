<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lst_file extends CI_Controller {

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

  public function download_file($idx)
  {
    $id = $this->session->userdata('id');
    $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
           $nmfile = $this->session->userdata('nmfile');
          if(!empty($nmfile))
          {          
            if(file_exists('./assets/cetak/Admin/'.$nmfile[$idx]['nmfile']))
            { 
              force_download('./assets/cetak/Admin/'.$nmfile[$idx]['nmfile'], NULL);  
            }
          }  
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }

}