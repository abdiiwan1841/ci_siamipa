<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vw_tbtrnlptrnlmjnmtk_model extends CI_Model {

   public $numrows;
   
   public function getdata($where)
   {      
      $this->db->select('thsmstrnlm,nimhstrnlm,kdkmktrnlm,nakmktbkmk,sksmktbkmk,nlakhtrnlm,bobottrnlm,wp,semestbkmk');
      $this->db->from('vw_tbtrnlptrnlmjnmtk');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('thsmstrnlm,semestbkmk,kdkmktrnlm');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();        
      }
      return $hsl; 
   }

   private function ismrhitl($iswp,$data)
	{
		if($iswp=='p')
		{
				return "<font color='red'><i>".$data."</i></font>";
			}
			else{
				return "$data";			
			}
	}

   private function semke($thsms,$i)
   {
     $sem = str_split($thsms, 4);			
					 
	if($sem[1]=="1"){
		$tmp = "Semester Ganjil ".$sem[0]." (Semester ke-".$i.")";		
		
	}else{
			if($sem[1]=="2"){
			   $tmp = "Semester Genap ".$sem[0]." (Semester ke-".$i.")";
			   
			}else{
				 if($sem[1]=="0"){
				 $tmp = "Nilai Konversi";						    
				}
			}
		 }
	return $tmp;	 
   }

 
  

   public function tb_hsl_studi($vnim,$user=0,$vtrnlm=null)
   {
     $header = array(array('Jdl','Kode','Matakuliah','SKS'));
     $header[0][]=$user==0 ? 'HM' : 'Nilai Diumumkan';
     $header[0][]=$user==0 ? 'NM' : 'Nilai Dosen';
     $tbstat = array("id" => "tb_filter",'width'=>'100%');
 
     $isi_data=array(); 
     $data=$this->getdata("nimhstrnlm='$vnim'");

     if(!empty($data))
     {
        $i=0;
        $thn = '';
        foreach ($data as $row) {
        	        $tmp=array();

					if( $thn=='' or $thn!=$row['thsmstrnlm']){
                       if ($row['thsmstrnlm']!='00000') {
                           $i+=1; 	
                       }
                       $thn=$row['thsmstrnlm'];
					}					 

					$tmp[]=array($this->semke($row['thsmstrnlm'],$i),array());
					$tmp[]=array($row['kdkmktrnlm'],array());
					$tmp[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']),array());
					$tmp[]=array($this->ismrhitl($row['wp'],$row['sksmktbkmk']),array());					
					if ($user==0){ 	
						$tmp[]=array($row['nlakhtrnlm'],array());
						$tmp[]=array($row['bobottrnlm'],array());					
					}else{
						$tmp[]=array($row['nlakhtrnlm'],array());
						$nm = $vtrnlm->getnm($row['thsmstrnlm'],$vnim,$row['kdkmktrnlm']);
						$tmp[]=array($nm!=$row['nlakhtrnlm'] ? $nm:'', array());												
					}
			$isi_data[]=$tmp;		
        }
     } 
     


                        $tfoot = "<tr>";
						$tfoot .= "<th></th>";
						$tfoot .= "<th><input type='hidden' name='search_sem' value='Search sem' class='search_init' /><input type='text' name='search_kode' value='Kode' class='search_init' style='width:150px'/></th>";
						$tfoot .= "<th><input type='text' name='search_mtk' value='Matakuliah' class='search_init' style='width:250px' /></th>";
						$tfoot .= "<th><input type='hidden' name='search_sks' value='Search sks' class='search_init' /></th>";
						$tfoot .= "<th><input type='text' name='search_hm' value='HM' class='search_init' style='width:20px'/></th>";
						$tfoot .= "<th></th>";
						$tfoot .= "</tr>";

     $tbl = new mytable($tbstat,$header,$isi_data,$tfoot);
     return $tbl->display();
   }  


   public function getdatatrans($where)
   {      
      $this->db->distinct();
      $this->db->select('kdkmktrnlm,nakmktbkmk,sksmktbkmk,nlakhtrnlm,bobottrnlm,wp,semestbkmk');
      $this->db->from('vw_tbtrnlptrnlmjnmtk');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('semestbkmk,kdkmktrnlm,bobottrnlm desc');  
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();        
        $hsl = array_filter($hsl,function($row){
                  static $kode=array();     
                  $ada = false;
                  if(!in_array($row['kdkmktrnlm'],$kode)){
                       $kode[]=$row['kdkmktrnlm'];
                       $ada = true;        
                  }
                  return $ada;
                });
      }
      return $hsl; 
   }



   public function tb_transkrip($vnim)
   {
     $header = array(array('Jdl','Kode','Matakuliah','SKS','HM','NM'));
     $tbstat = array("id" => "tb_trans",'width'=>'100%');
 
     $isi_data=array(); 
     $data=$this->getdatatrans("nimhstrnlm='$vnim' and nlakhtrnlm !='K'");

     if(!empty($data))
     {
       
        foreach ($data as $row) {
                  $tmp=array(); 

          $tmp[]=array('Semester '.$row['semestbkmk'],array());
          $tmp[]=array($row['kdkmktrnlm'],array());
          $tmp[]=array($this->ismrhitl($row['wp'],$row['nakmktbkmk']),array());
          $tmp[]=array($this->ismrhitl($row['wp'],$row['sksmktbkmk']),array());         
          $tmp[]=array($row['nlakhtrnlm'],array());
          $tmp[]=array($row['bobottrnlm'],array());          
          $isi_data[]=$tmp;   
        }
     } 
     


                        $tfoot = "<tr>";
            $tfoot .= "<th></th>";
            $tfoot .= "<th><input type='hidden' name='search_sem' value='Search sem' class='search_init' /><input type='text' name='search_kode' value='Kode' class='search_init' style='width:150px'/></th>";
            $tfoot .= "<th><input type='text' name='search_mtk' value='Matakuliah' class='search_init' style='width:250px' /></th>";
            $tfoot .= "<th><input type='hidden' name='search_sks' value='Search sks' class='search_init' /></th>";
            $tfoot .= "<th><input type='text' name='search_hm' value='HM' class='search_init' style='width:20px'/></th>";
            $tfoot .= "<th></th>";
            $tfoot .= "</tr>";

     $tbl = new mytable($tbstat,$header,$isi_data,$tfoot);
     return $tbl->display();
   }

   function hitipk($user,$thn="")
   {
       $sql_select = "nimhstrnlm,SUM(sksmktbkmk) AS jml_sks, SUM(sksmktbkmk*bobottrnlm) AS jml_sksnm";    

       if($thn==""){
           $where = "nimhstrnlm='$user' and nlakhtrnlm not in ('K')"; 
       }else{
           $where = "nimhstrnlm='$user' and nlakhtrnlm not in ('K') and thsmstrnlm in ($thn)";
       }

  
       $sql_from = "(SELECT nimhstrnlm,kdkmktrnlm,sksmktbkmk,MAX(bobottrnlm) AS bobottrnlm FROM vw_tbtrnlptrnlmjnmtk WHERE $where GROUP BY nimhstrnlm,kdkmktrnlm) a";
       $sql_orderby = '';

       $query = $this->db->query("select $sql_select from $sql_from");
       $data=$query->result_array();

       $hsl=array('jml_sks'=>0,'jml_sksnm'=>0,'ipk'=>0);
       if(!empty($data)){            
        $hsl['jml_sks'] = $data[0]['jml_sks'];
        $hsl['jml_sksnm'] = $data[0]['jml_sksnm']; 
        $hsl['ipk'] = $hsl['jml_sks']!=0 ?   $hsl['jml_sksnm']/ $hsl['jml_sks'] :0;     
       }
      return $hsl;     
   }

   function hitipk_krs($user,$thn="")
   {
      $sql_select = "nimhstrnlm,SUM(sksmktbkmk) AS jml_sks, SUM(sksmktbkmk*bobottrnlm) AS jml_sksnm"; 
    
      if($thn==""){
          $where = "nimhstrnlm='$user' and nlakhtrnlm not in ('T','K')"; 
      }else{
         $where = "nimhstrnlm='$user' and nlakhtrnlm not in ('T','K') and thsmstrnlm in ($thn)";
      }
  

     $sql_from = "(SELECT nimhstrnlm,kdkmktrnlm,sksmktbkmk,MAX(bobottrnlm) AS bobottrnlm FROM vw_tbtrnlptrnlmjnmtk WHERE $where GROUP BY nimhstrnlm,kdkmktrnlm) a";
     $sql_orderby = '';
    
     $query = $this->db->query("select $sql_select from $sql_from");
     $data=$query->result_array();
  
     $hsl=array('jml_sks'=>0,'jml_sksnm'=>0,'ipk'=>0);
     if(!empty($data)){
      
        $hsl['jml_sks'] = $data[0]['jml_sks'];
        $hsl['jml_sksnm'] = $data[0]['jml_sksnm']; 
        $hsl['ipk'] = $hsl['jml_sks']!=0 ?   $hsl['jml_sksnm']/ $hsl['jml_sks'] :0;           
   
      }
      return $hsl;
     
   }


   function get_rekapkhs($user='')
   {
      $query = "select nimhstrnlm,thsmstrnlm,SUM(bobottrnlm*IF(nlakhtrnlm<>'K',sksmktbkmk,0)) as jml_sksam,SUM(IF(nlakhtrnlm<>'K',sksmktbkmk,0)) as jml_sks from vw_tbtrnlptrnlmjnmtk ";     
      $query.= !empty($user) ? "where nimhstrnlm='$user' " : '';       
      $query.='group by nimhstrnlm,thsmstrnlm ';
      $query.='order by nimhstrnlm,thsmstrnlm ';
      
      $hsl = $this->db->query($query);
      $data=$hsl->result_array();      
            
      $tmp=array();
      if(!empty($data))
      {
         foreach ($data as $row) {
          $tmp[strtoupper($row['nimhstrnlm'])][$row['thsmstrnlm']]['jml_sks']=$row['jml_sks'];
          $tmp[strtoupper($row['nimhstrnlm'])][$row['thsmstrnlm']]['jml_sksam']=$row['jml_sksam'];
         }
      }

      return $tmp;
   }

   function hitsks($user,$thsms)
    {
    
    $sql = "select sum(sksmktbkmk) as jml from vw_tbtrnlptrnlmjnmtk where nimhstrnlm='$user' and thsmstrnlm='$thsms' and nlakhtrnlm not in ('K')"; 
    $hsl = $this->db->query($sql);
    $data=$hsl->result_array();     
      
    $jml=0.00;
    if(!empty($data)){
       foreach($data as $row){
        if($row['jml']!=null){ 
       $jml = $row['jml'];
         }
     }
      }    
    
    return $jml;
  }

  function sks_mbl($nim){
    $sql = "SELECT SUM(sksmktbkmk) AS jmlsks FROM (SELECT kdkmktbkmk,sksmktbkmk FROM vw_tbtrnlptrnlmjnmtk WHERE nimhstrnlm='$nim' AND nlakhtrnlm!='K' GROUP BY kdkmktbkmk,sksmktbkmk ORDER BY kdkmktbkmk) a";
    $hsl = $this->db->query($sql);
    $data=$hsl->result_array();
    return (empty($data) ? '0' : $data[0]['jmlsks']);
  }

  
  
  function buildkhs_ulang($user,$nl)
    {   
    $where = "nimhstrnlm='$user' and kdkmktrnlm in (select kdkmktrnlm from trnlm_trnlp where nimhstrnlm='$user' and nlakhtrnlm='$nl') and bobottrnlm>1"; 
      $data = $this->getdata($where); 
    return $data;
  } 

}