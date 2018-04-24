<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class trnlm_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('trnlm');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }
      return $hsl; 
   }

   public function getnm($sem,$nim,$kd)
   {
     $data = $this->getdata("nimhstrnlm='$nim' and thsmstrnlm='$sem' and kdkmktrnlm='$kd'");
     $txt='';
     if($this->numrows>0){
       $txt=$data[0]['nlakhtrnlm'];
     }
     return $txt;
   }
}