<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function login()
	{
		$this->load->view('Admin/login');
	}

	public function change_content($idx_p,$idx_c)
	{
        switch ($idx_p) {
        	case 1:
                    switch ($idx_c) {
                    	case 11 :
                          $this->lst_lgn();
                        break;
                      case 12 :
                    		  $this->dashboard();
                    		break;
                      case 13 :
                          $this->lst_file();
                        break;  
                    	
                    	default:
                    		# code...
                    		break;
                    }        		   
        		break;

            case 7:
                    switch ($idx_c) {
                        case 72 :
                          $this->dt_mhs();
                        break;
                      
                      
                      default:
                        # code...
                        break;
                    }              
            break;
        	
        	default:
        		# code...
        		break;
        }
	}

	function getaddress($lat,$lng)
    {
     $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
     $json = @file_get_contents($url);
     if(!empty($json)){    
		 $data=json_decode($json);     
	     if(!empty($data)){
			 $status = $data->status;     
			 if($status=="OK")
			 {
			   return $data->results[0]->formatted_address;
			 }
			 else
			 {
			   return 'Tidak Ditemukan';
			 }
		 }
	}else{
	  return 'Tidak Ditemukan';	
	}	 
   }

	public function cek_login(){
       if($this->input->is_ajax_request()){
          $user = $this->input->post('user');
          $pass = $this->input->post('pass');
          $idx  = 1;
       
          $longi = $this->input->post('longi');
          $lati  = $this->input->post('lati');
          
          
          if($this->Staff_model->isuserexist($user,$pass)){
          	if(!$this->Log_model->islogin($user,$idx)){
          		  				  
                  $alamat=$this->getaddress($lati,$longi);			  
				  $today = date("Y-m-d H:i:s");
				  $tg = $idx;
				  $hak = $this->Staff_model->gethak($user);
				  $nm_user = $this->Staff_model->getnm($user);
			  
                  $newdata = array(
                     'id'  => uniqid(),
                     'user' => $user,
                     'nm_user' => $nm_user,
                     'hak'  => $hak,
                     'islog' => 1
                  );
                  $this->session->set_userdata($newdata); 
				  
				  $fieldarray = array('lg_time' => $today,'user' => $user,'tg' => $tg,'net_id'=>$_SERVER['REMOTE_ADDR'],'season_id'=>$this->session->userdata('id'),'longitude'=>$longi,'altitude'=>$lati,'alamat'=>$alamat);		  
				  $this->Log_model->insertdata($fieldarray);                  
                  
                  echo '';
            }else{					
				 echo "<div class='callout callout-danger'><h4>Pemberitahuan</h4><p>Belum logout tidak bisa login !!!</p> </div>";				
		    }
          }else{
          	echo "<div class='callout callout-danger'><h4>Pemberitahuan</h4><p>Username atau Password Keliru !!!</p> </div>";
          }
       }else{
       	 show_error('Not an authorized access !!!');
       }             
            
	}

	private function dashboard()
	{
		
        $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
	        if($this->Log_model->logintime($id)){
	          $data['nm_user']=$this->session->userdata('nm_user');
	          $data['hak']=$this->session->userdata('hak');
	          $data['menu_active']=array('1','12');
			  $this->load->view('Admin/dashboard',$data);
			}else{
	           redirect('Admin/logout');
			}
		}else{
			redirect('Admin/login');
		}	  
	}

  private function lst_lgn()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('1','11');
             $this->load->view('Admin/lst_lgn',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }

  private function lst_file()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('1','13');
             $this->load->view('Admin/lst_file',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }

  private function dt_mhs()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('7','72');
             $this->load->view('Admin/dt_mhs',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }

	public function logout()
	{
		$user = $this->session->userdata('user');        	
    if($this->Log_model->islogin($user,1)){
            
		   $id = $this->session->userdata('id');		 
		   
		   $today = date("Y-m-d H:i:s");
		   $fieldarray = array('season_id' => $id,'out_time'=> $today,'user' => $user);
		   $this->Log_model->updatedata($fieldarray);

		   $this->session->sess_destroy();
   
           redirect('Admin/login');
		}else{
           redirect('Admin/login');
		}  
	}

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

  public function filter_log()
  {
     if($this->input->is_ajax_request()){
       $tg = $this->input->post('tg');
       $html_txt = $this->Log_model->getlstlgn($tg);
       echo $html_txt;
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

  public function get_dt_mhs()
  {
     if($this->input->is_ajax_request()){       
       
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
            $tmp[]=array('<div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" onclick="view('."'".$row['nimhsmsmhs']."'".')" ><i class="fa fa-search"></i></button>
                  <button type="button" class="btn btn-default btn-sm" onclick="edit('."'".$row['nimhsmsmhs']."'".')" ><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-default btn-sm" onclick="delete('."'".$row['nimhsmsmhs']."'".')" ><i class="fa fa-trash"></i></button>                  
                </div>',array());            
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

  public function frm_dt_mhs()
  {
     if($this->input->is_ajax_request()){
        $idx = $this->input->post('idx');
        switch ($idx) {
            case 1:
              $data['judul']='Input Data Mahasiswa';
              break;
            
            default:
              # code...
              break;
          }  
            
        
        echo $this->load->view('Admin/frm_dt_mhs',$data,true);
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
