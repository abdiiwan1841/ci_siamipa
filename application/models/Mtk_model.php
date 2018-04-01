<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mtk_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('tbkmk');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('semestbkmk,wp,kdkmktbkmk');  
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
      $this->getdata("kdkmktbkmk ='$kode'");      
      return ($this->numrows>0);
   }

   public function nmmk($kode)
   {
      $data=$this->getdata("kdkmktbkmk ='$kode'");      
      return $data[0]['nakmktbkmk'];             
   }

    public function insertdata($data)
   {
      $this->db->insert('tbkmk',$data);
   }

   public function updatedata($data)
   {
     
     foreach ($data as $key => $value) {
       if($key!='old_kode'){
        $this->db->set($key, $value);
       } 
     }
       

     $this->db->where('kdkmktbkmk',$data['old_kode']);
     $this->db->update('tbkmk');

   }

   public function deletedata($kode)
   {
     $this->db->where('kdkmktbkmk', $kode);
     $this->db->delete('tbkmk');
     
   }

   public function cmbprkt()
   {
    $data = $this->getdata("kdkmktbkmk like 'MATP%'");
     
    $kdprtk['']='Tidak ada praktikum'; 
    if($this->numrows>0)
    {
      foreach ($data as $row) {
        $kd=$row['kdkmktbkmk'];
        $nama = str_replace(' ', '&nbsp;',$row['nakmktbkmk']);   
        $kdprtk[$kd]=$nama;
      }
    }
    return $kdprtk;
   }
 

}