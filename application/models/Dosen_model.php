<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('tbdos');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('Kode');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }
      return $hsl; 
   } 

   public function kode_ada($kode)
   {
      $this->getdata("Kode ='$kode'");      
      return ($this->numrows>0);
   }

    public function insertdata($data)
   {
      $this->db->insert('tbdos',$data);
   }

   public function updatedata($data)
   {
     
     foreach ($data as $key => $value) {
       if($key!='old_kode'){
        $this->db->set($key, $value);
       } 
     }
       

     $this->db->where('Kode',$data['old_kode']);
     $this->db->update('tbdos');

   }

   public function deletedata($kode)
   {
     $this->db->where('Kode', $kode);
     $this->db->delete('tbdos');
     
   }
 

}