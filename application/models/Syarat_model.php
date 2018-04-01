<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Syarat_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('syarat');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      //$this->db->order_by('semestbkmk,wp,kdkmktbkmk');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }
      return $hsl; 
   } 

   public function kode_ada($kode1,$kode2)
   {
      $this->getdata("kdkmksyarat='$kode1' and syaratkmk='$kode2'");      
      return ($this->numrows>0);
   }

    public function insertdata($data)
   {
      $this->db->insert('syarat',$data);
   }

   public function updatedata($data)
   {
     
     foreach ($data as $key => $value) {       
        $this->db->set($key, $value);        
     }
     $this->db->where('kdkmksyarat',$data['kode']);
     $this->db->update('syarat');

   }

   public function deletedata($kode)
   {
     $this->db->where('kdkmksyarat', $kode);
     $this->db->delete('syarat');
     
   }
 

}