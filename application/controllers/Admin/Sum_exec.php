<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sum_exec extends CI_Controller {
    
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

}