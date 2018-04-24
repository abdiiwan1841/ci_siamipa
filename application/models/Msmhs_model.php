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

   public function getAngkatan($where)
   {      
      $this->db->distinct();
      $this->db->select('tahunmsmhs');
      $this->db->from('msmhs');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('tahunmsmhs');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }
      return $hsl; 
   }

   public function getKelas($thn)
   {      
      $this->db->distinct();
      $this->db->select('shiftmsmhs');
      $this->db->from('msmhs');
      if(!empty($thn)){
        $this->db->where("tahunmsmhs=$thn");      
      }
        
      $this->db->order_by('shiftmsmhs desc');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }
      return $hsl; 
   }

   public function getMhs($thn,$kls)
   {        
      $this->db->select('*');
      $this->db->from('msmhs');
      if(!empty($thn) and !empty($kls)){
        $this->db->where("tahunmsmhs='$thn' and shiftmsmhs='$kls'");      
      }
        
      $this->db->order_by('nimhsmsmhs');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }
      return $hsl; 
   }


   
   public function getAng1()
   {
    $data = $this->getAngkatan('');
    return $data[0]['tahunmsmhs'];
   }

   public function getKls1($thn)
   {
    $data = $this->getKelas($thn);
    return $data[0]['shiftmsmhs'];
   }   

   public function getCmbAngkatan($where)
   {
      $data = $this->getAngkatan($where);
      $ang = array_combine(array_column($data,'tahunmsmhs'), array_column($data,'tahunmsmhs'));
      return $ang;
   }

   public function getCmbKelas($thn)
   {
      $data = $this->getKelas($thn);
      $stat_arr = array_column($data,'shiftmsmhs');
      $txtstat_arr = array_map(function ($stat){ $tmp=($stat=='R') ? "Reguler" : "Non Reguler"; return $stat." - ".$tmp;},$stat_arr);
      $kelas = array_combine($stat_arr, $txtstat_arr);
      return $kelas;
   }

   public function getCmbMhs($thn,$kls)
   {
      $data = $this->getMhs($thn,$kls);
      $vnim=$data[0]['nimhsmsmhs'];
      $vtemp=$data[0]['nimhsmsmhs']."-".$data[0]['nmmhsmsmhs'];
  
      $nim_arr = array_column($data,'nimhsmsmhs');
      $nm_arr = array_map(function ($arr){ return $arr['nimhsmsmhs']." - ".$arr['nmmhsmsmhs'];},$data);
      $Mhs = array_combine($nim_arr, $nm_arr);        
      return $Mhs;
   }
 

}