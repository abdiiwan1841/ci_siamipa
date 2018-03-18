<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function login()
	{
		$this->load->view('Admin\login');
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
				  
				  $fieldarray = array('lg_time' => $today,'user' => $user,'tg' => $tg,'net_id'=>$_SERVER['REMOTE_ADDR'],'season_id'=>$_SESSION['id'],'longitude'=>$longi,'altitude'=>$lati,'alamat'=>$alamat);		  
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

	public function dashboard()
	{
		$user = $this->session->userdata('user');        	
        if($this->Log_model->islogin($user,1)){
          $data['nm_user']=$this->session->userdata('nm_user');
          $data['hak']=$this->session->userdata('hak');
		  $this->load->view('Admin\dashboard',$data);
		}else{
           redirect('Admin\login');
		}  
	}

	public function logout()
	{
		$user = $this->session->userdata('user');        	
        if($this->Log_model->islogin($user,1)){
            
		   $id = $this->session->userdata('id');		 
		   echo $id;
		   $today = date("Y-m-d H:i:s");
		   $fieldarray = array('season_id' => $id,'out_time'=> $today,'user' => $user);
		   $this->Log_model->updatedata($fieldarray);

		   $array_items = array('id','nm_user','user','hak','islog');
           $this->session->unset_userdata($array_items);
   
           redirect('Admin\login');
		}else{
           redirect('Admin\login');
		}  
	}
}
