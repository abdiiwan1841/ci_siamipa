<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trnlm_trnlp_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('trnlm_trnlp');
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

   public function deletedata($nim,$ta)
   {
     $this->db->where('nimhstrnlm', $nim);
     $this->db->where('thsmstrnlm', $ta);
     $this->db->delete('trnlm_trnlp');
     
   }

   public function deletedatamtk($nim,$ta,$kd)
   {
     $this->db->where('nimhstrnlm', $nim);
     $this->db->where('thsmstrnlm', $ta);
     $this->db->where('kdkmktrnlm', $kd);
     $this->db->delete('trnlm_trnlp');
     
   }

   public function insertdata($data)
   {
      $this->db->insert('trnlm_trnlp',$data);
   }
}