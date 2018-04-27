<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function login()
	{
		$this->load->view('Admin/login');
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
            
               $islogin=$this->Log_model->islogin($user,$idx);
               $login = !$islogin; 
               if($islogin){  
                  $id=$this->Log_model->log_id;
                  $login=!$this->Log_model->logintime($id); 
                  
                  $today = date("Y-m-d H:i:s");
                  $fieldarray = array('season_id' => $id,'out_time'=> $today,'user' => $user);
                  $this->Log_model->updatedata($fieldarray);
                  
                }
                          
              
                if($login){
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
                        case 71 :
                          $this->dt_sum_mhs();
                        break;
                        case 72 :
                          $this->dt_mhs();
                        break;
                        case 73 :
                          $this->dt_konversi();
                        break;
                        case 74 :
                          $this->dt_stat_mhs();
                        break;
                        case 75 :
                          $this->dt_khs_mhs();
                        break;
                        case 76 :
                          $this->dt_trans_mhs();
                        break;
                      
                      default:
                        # code...
                        break;
                    }              
            break;

             case 8:
                    switch ($idx_c) {
                        case 81 :
                          $this->dt_dosen();
                        break;
                      
                      
                      default:
                        # code...
                        break;
                    }
             break;
             case 9:
                    switch ($idx_c) {
                        case 91 :
                          $this->dt_mtk();
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

  private function dt_sum_mhs()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('7','71');
             $data['lst_ang']=$this->Msmhs_model->getCmbAngkatan('');
             $data['lst_kls']=$this->Msmhs_model->getCmbKelas($this->Msmhs_model->getAng1());
             $data['lst_mhs']=$this->Msmhs_model->getCmbMhs($this->Msmhs_model->getAng1(),$this->Msmhs_model->getKls1($this->Msmhs_model->getAng1()));
             $this->load->view('Admin/Mahasiswa/summary',$data);
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
             $this->load->view('Admin/Mahasiswa/dt_mhs',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }  

   private function dt_konversi()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('7','73');
             $this->load->view('Admin/Mahasiswa/dt_konversi',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }

 private function dt_stat_mhs()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('7','74');
             $mythnsem = new mythnsem(); 
             $data['lst_sem']=$mythnsem->getlstthnsem();
             $this->load->view('Admin/Mahasiswa/dt_stat_mhs',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }

  private function dt_khs_mhs()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('7','75');
             $data['lst_ang']=$this->Msmhs_model->getCmbAngkatan('');
             $data['lst_kls']=$this->Msmhs_model->getCmbKelas($this->Msmhs_model->getAng1());
             $data['lst_mhs']=$this->Msmhs_model->getCmbMhs($this->Msmhs_model->getAng1(),$this->Msmhs_model->getKls1($this->Msmhs_model->getAng1()));
             $this->load->view('Admin/Mahasiswa/dt_khs_mhs',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }

  private function dt_trans_mhs()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('7','76');
             $mythnsem = new mythnsem(); 
             $data['lst_ang']=$this->Msmhs_model->getCmbAngkatan('');
             $data['lst_kls']=$this->Msmhs_model->getCmbKelas($this->Msmhs_model->getAng1());
             $data['lst_mhs']=$this->Msmhs_model->getCmbMhs($this->Msmhs_model->getAng1(),$this->Msmhs_model->getKls1($this->Msmhs_model->getAng1()));
             $this->load->view('Admin/Mahasiswa/dt_trans_mhs',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }

  private function dt_dosen()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('8','81');
             $this->load->view('Admin/Dosen/dt_dosen',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }  

  private function dt_mtk()
  {
     $id = $this->session->userdata('id');
        $user = $this->session->userdata('user');
        if($this->Log_model->islogin($user,1)){
          if($this->Log_model->logintime($id)){
             $data['nm_user']=$this->session->userdata('nm_user');
             $data['hak']=$this->session->userdata('hak');
             $data['menu_active']=array('9','91');
             $this->load->view('Admin/Kurikulum/dt_mtk',$data);
      }else{
             redirect('Admin/logout');
      }
    }else{
      redirect('Admin/login');
    }
  }

  


}