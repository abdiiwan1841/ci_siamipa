<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trnlp_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('trnlp');
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

   public function insertdata($data)
   {
      $this->db->insert('trnlp',$data);
   }

   public function updatedata($data)
   {
     
     foreach ($data as $key => $value) {
       if(!in_array($key,array('nimhstrnlp','kdkmktrnlp'))){
        $this->db->set($key, $value);
       } 
     }       

     $this->db->where('nimhstrnlp',$data['nimhstrnlp']);
     $this->db->where('kdkmktrnlp',$data['kdkmktrnlp']);
     $this->db->update('trnlp');

   }

   public function deletedata($nim,$kdmk)
   {
     $this->db->where('nimhstrnlp', $nim);
     $this->db->where('kdkmktrnlp', $kdmk);
     $this->db->delete('trnlp');
     
   }

 }