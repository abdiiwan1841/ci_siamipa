<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msmhs_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('msmhs');
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

  public function getnm($nim)
   {
      $data = $this->getdata("nimhsmsmhs ='$nim'");      
      $txt = 'Nim Tidak Terdaftar';
       if($this->numrows>0)
       {
         $txt = $data[0]['nmmhsmsmhs'];
       }

      return $txt;
   }
   
   public function nim_ada($nim)
   {
      $this->getdata("nimhsmsmhs ='$nim'");      
      return ($this->numrows>0);
   }

    public function insertdata($data)
   {
      $this->db->insert('msmhs',$data);
   }

   public function updatedata($data)
   {
     
     foreach ($data as $key => $value) {
       if($key!='old_nim'){
        $this->db->set($key, $value);
       } 
     }
       

     $this->db->where('nimhsmsmhs',$data['old_nim']);
     $this->db->update('msmhs');

   }

   public function deletedata($nim)
   {
     $this->db->where('nimhsmsmhs', $nim);
     $this->db->delete('msmhs');
     
   }
 

}