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

  function getriwayatsks($thn,$nim)
  {
    
    $select = 'thsmstrnlm,nimhstrnlm,kdkmktrnlm,nakmktbkmk,sksmktbkmk,sksprtbkmk,shifttrnlm,semestbkmk,wp';
    $from  = 'trnlm INNER JOIN tbkmk ON kdkmktrnlm=kdkmktbkmk';

    $sql ="select sum(sksmktbkmk) as jml from (select $select from $from) a where thsmstrnlm='$thn' and nimhstrnlm='$nim' and kdkmktrnlm not like 'MATP%'";    
    $query = $this->db->query($sql);
    $data = $query->result_array();
    
    $jml_sks=0;
    if(!empty($data))
    {      
        $jml_sks=$data[0]['jml']; 
    }
    
    return $jml_sks;
  }

  function getmtk1($thnsms,$nim)
  { 
    $select = 'thsmstrnlm,nimhstrnlm,kdkmktrnlm,nakmktbkmk,sksmktbkmk,sksprtbkmk,shifttrnlm,semestbkmk,wp,semestrnlm,kelastrnlm,tgl_input';
    $from  = 'trnlm INNER JOIN tbkmk ON kdkmktrnlm=kdkmktbkmk';    

    $sql  = "select thsmstrnlm,nimhstrnlm,kdkmktrnlm,nakmktbkmk,sksmktbkmk,sksprtbkmk,shifttrnlm,semestrnlm,kelastrnlm,semestbkmk,wp,tgl_input from (select $select from $from) a where thsmstrnlm='$thnsms' and nimhstrnlm='$nim' order by semestbkmk,kdkmktrnlm";
    
    $query = $this->db->query($sql);
    $data = $query->result_array();
    return $data;     
  } 


  function getmtk2($thnsms,$nim,$noprtk=1){
    
   $select = 'thsmstrnlm,nimhstrnlm,kdkmktrnlm,nakmktbkmk,sksmktbkmk,sksprtbkmk,kdprtk,shifttrnlm,semestbkmk,wp,semestrnlm,kelastrnlm,tgl_input';
    $from  = 'trnlm INNER JOIN tbkmk ON kdkmktrnlm=kdkmktbkmk';    

    $sql  = "select thsmstrnlm,nimhstrnlm,kdkmktrnlm,nakmktbkmk,sksmktbkmk,sksprtbkmk,kdprtk,shifttrnlm,semestrnlm,kelastrnlm,semestbkmk,wp,tgl_input from (select $select from $from) a where thsmstrnlm='$thnsms' and nimhstrnlm='$nim' ";

    $orderby="order by semestbkmk,kdkmktrnlm ";
    $where='';
    if($noprtk==0){ 
      $where = " and kdkmktrnlm NOT LIKE 'MATP%' ";
    }else{
      //$where = "where thsmstrnlm='$thnsms' and nimhstrnlm='$nim' ";
    }  
    
    $query = $this->db->query($sql.$where.$orderby);
    $data = $query->result_array();
    return $data;
  } 


  function buildkrs($user,$thnsms,$baru=1)
  {
    $jml_sks=0;
    $vmythnsem = new mythnsem;
    $lst_sem=$vmythnsem->getlstthnsem(20072,$vmythnsem->substhnsem($thnsms,1));
    $txt_filter = implode(",",array_keys($lst_sem));
      
    if($baru==1){  
      $where = "kdkmktbkmk NOT LIKE 'MATP%' and (kdkmktbkmk not in (select kdkmktrnlm from trnlm where nimhstrnlm='$user' and thsmstrnlm=$thnsms ) ) and (kdkmktbkmk not in (select distinct kdkmktrnlm from trnlm_trnlp where nimhstrnlm='$user' and thsmstrnlm in ($txt_filter)) )";
      
    }else
    {
      $where = "kdkmktbkmk NOT LIKE 'MATP%' and (kdkmktbkmk not in (select kdkmktrnlm from trnlm where nimhstrnlm='$user' and thsmstrnlm=$thnsms) ) and (kdkmktbkmk in (select distinct kdkmktrnlm from trnlm_trnlp where nimhstrnlm='$user' and thsmstrnlm in ($txt_filter))) ";
      
    }
    
    
    $data3 = array();
    $data = $this->Mtk_model->getdata($where);
    $dt = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk($user,$txt_filter);
    $sks = $dt['jml_sks'];
    
    if(!empty($data)){ 
      foreach ($data as $row) {
        $ctk=0;
        $tmp = $row['kdkmktbkmk'];
        
        $where = "kdkmksyarat='$tmp'"; 
        $data1 = $this->Syarat_model->getdata($where);
        $num_rows=$this->Syarat_model->numrows;
        
        if(in_array($tmp,array("UBB106","MAT352","MAT353","MAT370"))){          
            $ctk=($sks>=110) ? 1 : 0;         
        }    
        else{
          
          if($num_rows==0){
            $ctk=1;
          }else{  
            
            $where = "kdkmksyarat='$tmp' and (syaratkmk in (select distinct kdkmktrnlm from trnlm_trnlp where nimhstrnlm='$user' and thsmstrnlm in ($txt_filter)))"; 
            $data2 = $this->Syarat_model->getdata($where);
            $num_rows1=$this->Syarat_model->numrows;
            
            $ctk=($num_rows1==0) ? 0:1;           
            $ctk=($baru==0)? 1:$ctk;
          }
          
        }
        
        if($ctk==1){
          
          $where="nimhstrnlm='$user' and thsmstrnlm='$thnsms' and kdkmktrnlm='$tmp'";
          
          $data4=$this->getdata($where);
          $num_rows2=$this->numrows;      
          
          if($num_rows2>0){
            $tmp2= "1";
            $this->jml_sks+=$row['sksmktbkmk'];
          }else
          {
            $tmp2= "0";
          }
          
          $data3[]= array('kdkmktbkmk' => $row['kdkmktbkmk'],
          'nakmktbkmk' => $row['nakmktbkmk'],
          'sksmktbkmk' => $row['sksmktbkmk'],
          'semestbkmk' => $row['semestbkmk'],
          'kdprtk'=>$row['kdprtk'],
          'wp' => $row['wp'],
          'cek' => $tmp2);  
        }
        
      }
    }
    
    
    return $data3;
  }

  function insertdata($data)
  {
    $this->db->insert('trnlm',$data);
  }

  public function updatedata($data)
   {
     
     foreach ($data as $key => $value) {
      if(!in_array($key, array('thsmstrnlm','nimhstrnlm','kdkmtrnlm'))){ 
        $this->db->set($key, $value);
       } 
     }
       

     $this->db->where('thsmstrnlm',$data['thsmstrnlm']);
     $this->db->where('nimhstrnlm',$data['nimhstrnlm']);
     $this->db->where('kdkmktrnlm',$data['kdkmktrnlm']);
     $this->db->update('trnlm');

   }

   public function deletedatamtk($nim,$ta,$kd)
   {
     $this->db->where('nimhstrnlm', $nim);
     $this->db->where('thsmstrnlm', $ta);
     $this->db->where('kdkmktrnlm', $kd);
     $this->db->delete('trnlm');
     
   }


}