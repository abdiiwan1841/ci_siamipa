<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Krs_model extends CI_Model {

   public $numrows;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('krs');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('nimhskrs,shiftkrs,kdkmkrs');  
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
      $this->db->insert('krs',$data);
   }

   public function updatedata($data)
   {
     
     foreach ($data as $key => $value) {
      if(!in_array($key, array('thsmskrs','nimhskrs','kdkmkrs'))){ 
        $this->db->set($key, $value);
       } 
     }
       

     $this->db->where('thsmskrs',$data['thsmskrs']);
     $this->db->where('nimhskrs',$data['nimhskrs']);
     $this->db->where('kdkmkkrs',$data['kdkmkkrs']);
     $this->db->update('krs');

   }

   public function deletedata($data)
   {
     $this->db->where('thsmskrs',$data['thsmskrs']);
     $this->db->where('nimhskrs',$data['nimhskrs']);
     $this->db->where('kdkmkkrs',$data['kdkmkkrs']);
     $this->db->delete('krs');
     
   }

  public function sks_blh($ipk)
  {
      $sks_blh=20;
      if($ipk>2.99){
      $sks_blh=24;
    } else{
      if(($ipk>=2.50) and($ipk<=2.99)){
        $sks_blh=21;
      } else{
        if(($ipk>=2.00) and ($ipk<=2.49)){
          $sks_blh=18;
        } else{
          if(($ipk>=1.50) and ($ipk<=1.99)){
            $sks_blh=16;
          } else{
            if(($ipk>0.00) and ($ipk<=1.49)){
              $sks_blh=14;
            } 
          }

        }

      }

    }

    return $sks_blh;    
  }

  public function hitsks($user)
  {
      $sql_from = 'vw_krs_jn_mtk';
      $sql_select= 'sum(sksmktbkmk) as jml_sks';
      $sql_where= 'kdkmkkrs not like "%MATP%"';
      $sql_where.=" and nimhskrs = '$user'";     

      $query = $this->db->query("select $sql_select from $sql_from where $sql_where");
      $data=$query->result_array();
      
    if(!empty($data)){
      foreach($data as $row){
        return $row['jml_sks'];
      }
    } else {
      return 0;
    }
    
  }

  public function getMtk($thsmskrs,$nim,$noprtk=1)
  {
    $sql_form = 'vw_krs_jn_mtk';
    $sql_select  = 'thsmskrs,nimhskrs,kdkmkkrs,nakmktbkmk,sksmktbkmk,sksprtbkmk,shiftkrs,semkrs,kelaskrs,semestbkmk,kdprtk,wp,tgl_input';
    $sql_orderby = 'semestbkmk,kdkmkkrs'; 

      if($noprtk==0){ 
         $sql_where = "thsmskrs='$thsmskrs' and nimhskrs='$nim' and kdkmkkrs NOT LIKE 'MATP%'";
      }else{
         $sql_where = "thsmskrs='$thsmskrs' and nimhskrs='$nim'";
      }  
      
      $query = $this->db->query("select $sql_select from $sql_form where $sql_where order by $sql_orderby");
      $data=$query->result_array();

    return $data; 
  }


  function buildkrs($user,$baru=1)
  {
    $jml_sks=0;
    $mythnsem=new mythnsem;
    $thnsms = $mythnsem->getthnsem();
      
    if($baru==1){  
      $where = "kdkmktbkmk NOT LIKE 'MATP%' and (kdkmktbkmk not in (select kdkmkkrs from krs where nimhskrs='$user') ) and (kdkmktbkmk not in (select distinct kdkmktrnlm from trnlm_trnlp where nimhstrnlm='$user')) AND ( kdkmktbkmk NOT IN 
                 (SELECT DISTINCT kdkmksyarat FROM syarat LEFT JOIN (SELECT DISTINCT kdkmktrnlm FROM trnlm_trnlp WHERE nimhstrnlm='$user') a ON
                  syaratkmk = kdkmktrnlm WHERE kdkmktrnlm IS NULL ORDER BY kdkmksyarat))";
      
    }else
    {
      $where = "kdkmktbkmk NOT LIKE 'MATP%' and (kdkmktbkmk not in (select kdkmkkrs from krs where nimhskrs='$user') ) and (kdkmktbkmk in (select distinct kdkmktrnlm from trnlm_trnlp where nimhstrnlm='$user'))";
      
    }

    $data3 = array();
    $data = $this->Mtk_model->getdata($where);
    $dt = $this->Vw_tbtrnlptrnlmjnmtk_model->hitipk($user);
    $sks = $dt['jml_sks'];
    
    if(!empty($data)){ 
      foreach ($data as $row) {
        $ctk=0;
        $tmp = $row['kdkmktbkmk'];
               
        if($tmp=="UBB106" or $tmp=="MAT352" or $tmp=="MAT353" or $tmp=="MAT370"){
          
          if($sks>=110){          
            $ctk=1;           
          }else{
            $ctk=0;
          }
          
        }    
        else{
              $ctk=1;                      
        }
        
        if($ctk==1){
          
          $sql_form ='vw_krs_jn_mhs';
          $sql_select  = 'distinct thsmskrs,nimhsmsmhs,nmmhsmsmhs,shiftmsmhs,tahunmsmhs,semkrs,kelaskrs';
          $sql_groupby = 'thsmskrs,nimhsmsmhs,nmmhsmsmhs,shiftmsmhs,tahunmsmhs';
          $sql_orderby = 'tahunmsmhs,nimhskrs';

          $where="nimhskrs='$user' and thsmskrs='$thnsms' and kdkmkkrs='$tmp'";
          
          $query = $this->db->query("select $sql_select from $sql_form where $where order by $sql_orderby");
          $num_rows2=$query->num_rows();;      
          
          if($num_rows2>0){
            $tmp2= "1";
            $jml_sks+=$row['sksmktbkmk'];
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




 }