<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khs_mhs extends CI_Controller {

	public function hsl_studi()
	{
		if($this->input->is_ajax_request()){ 
          
          $hak=$this->session->userdata('hak');          
          $nim = $this->input->post('nim');
          $nm = $this->Msmhs_model->getnm($nim)."($nim)";
          $table = $this->Vw_tbtrnlptrnlmjnmtk_model->tb_hsl_studi($nim,1,$this->Trnlm_model);

          echo json_encode(array('nm'=>$nm,'table'=>$table));
		}
	}


	public function ambilkelas()
	{
       if($this->input->is_ajax_request()){ 
          $thn = $this->input->post('thnmsmshs');
          $data=$this->Msmhs_model->getKelas($thn);

          foreach($data as $row)
          {

           if($row['shiftmsmhs']=='R'){
               echo"<option value='$row[shiftmsmhs]'>$row[shiftmsmhs] - Reguler</option>";
             }else{ 
               echo"<option value='$row[shiftmsmhs]'>$row[shiftmsmhs] - Non Reguler </option>";
            }
  
          }

       }
	}

	public function ambilnm()
	{
	  if($this->input->is_ajax_request()){ 	
		$thn = $this->input->post('thnmsmshs');
		$kls = $this->input->post('kelas');
        $data=$this->Msmhs_model->getMhs($thn,$kls);

		foreach($data as $row)
        {
          echo "<option value='$row[nimhsmsmhs]'>$row[nimhsmsmhs] - $row[nmmhsmsmhs]</option>";
        }
    }
	}

}