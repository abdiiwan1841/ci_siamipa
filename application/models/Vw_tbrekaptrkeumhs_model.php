<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vw_tbrekaptrkeumhs_model extends CI_Model {

   public $numrows;
   
   public function getdata($where)
   {      
      $this->db->select('tahunmsmhs,shiftmsmhs,nimhsmsmhs,nmmhsmsmhs,kewajiban,tran');
      $this->db->from('vw_tbrekaptrkeumhs');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('tahunmsmhs,nimhsmsmhs');  
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