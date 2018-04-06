<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vw_trnlp_jn_msmhs_jn_tbkmk_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('vw_trnlp_jn_msmhs_jn_tbkmk');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      //$this->db->order_by('tahunmsmhs asc','thnsmsstat_mhs desc');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();        
      }
      return $hsl; 
   }    

}