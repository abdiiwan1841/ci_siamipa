<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lst_lgn extends CI_Controller {

 public function filter_log()
  {
     if($this->input->is_ajax_request()){
       $tg = $this->input->post('tg');
       $html_txt = $this->Log_model->getlstlgn($tg);
       echo $html_txt;
     } 
  }

}