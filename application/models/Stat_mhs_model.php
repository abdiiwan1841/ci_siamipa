<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stat_mhs_model extends CI_Model {

   public $numrows;
   private $rows_per_page=0;
   private $pageno=0;

   public function getdata($where)
   {      
      $this->db->select('*');
      $this->db->from('stat_mhs');
      if(!empty($where)){
        $this->db->where($where);      
      }
        
      $this->db->order_by('thnsmsstat_mhs,nimstat_mhs');  
      $this->query = $this->db->get();
      $this->numrows = $this->query->num_rows();

      if($this->numrows>0 and $this->rows_per_page>0){
        $this->db->select('*');
        $this->db->from('stat_mhs');
        if(!empty($where)){
          $this->db->where($where);      
        }
          
        $this->db->order_by('thnsmsstat_mhs,nimstat_mhs');   

        if ($this->numrows <= 0) {
            $this->pageno = 0;
           return;
        } // if
      
        if ($this->rows_per_page > 0) {
           $this->lastpage = ceil($this->numrows/$this->rows_per_page);
        } else {
          $this->lastpage = 1;
        } // if
      
        if ($this->pageno == '' OR $this->pageno <= '1') {
           $this->pageno = 1;
        } elseif ($this->pageno > $this->lastpage) {
           $this->pageno = $this->lastpage;
        } // if
        $this->pageno = $this->pageno;
      
        if ($this->rows_per_page > 0) {
           //$limit_str = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
           $this->db->limit($this->rows_per_page, ($this->pageno - 1) * $this->rows_per_page);
        } else {
           
        } // if

        $this->query = $this->db->get();
        $this->numrows = $this->query->num_rows();
      }

      $hsl=array();      
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }

      return $hsl; 
   }

   function setpageno($pageno)
   {
     $this->pageno = $pageno;
   }
   
   function setrows_per_page($rows_per_page)
   {
     $this->rows_per_page = $rows_per_page;
   }

   private function stattostr($kd)
   {
     switch($kd)
      {
      case 0 : return "Non Status";break;
      case 1 : return "Aktif";break;
      case 2 : return "Cuti";break;
      case 3 : return "DO";break;
      case 4 : return "Keluar";break;
      case 5 : return "Lulus";break;
      case 6 : return "Non Aktif";break;
      }   
   }

   private function stattocd($kd)
   {   
        switch($kd)
        {
        case 0 : return -1;break;
        case 1 : return "A";break;
        case 2 : return "C";break;
        case 3 : return "D";break;
        case 4 : return "K";break;
        case 5 : return "L";break;
        case 6 : return "N";break;
        }
   
   }

   public function getstatmhs($thnsms,$nim,$idx=0)
   {
     $data = $this->getdata("thnsmsstat_mhs='$thnsms' and nimstat_mhs='$nim'");
     
     $stat = $this->numrows==0 ? 0 : $data[0]['statstat_mhs']; 
     switch ($idx) {
        case 0 :
          return $this->stattostr($stat);
          break;
        case 1 :
          return $this->stattocd($stat);
          break;  
        
        default:
           return $stat;
          break;
      } 

   }

   public function getAngkatan($thn)
   {    
      $this->db->select('tahunmsmhs');
      $this->db->from('stat_mhs');
      $this->db->join('msmhs','nimstat_mhs=nimhsmsmhs');
      $this->db->where("thnsmsstat_mhs in ($thn)");      
      $this->db->group_by("tahunmsmhs");      
      $this->query = $this->db->get();
      $hsl=array();
      $this->numrows = $this->query->num_rows();
      if($this->query->num_rows()>0)
      {
        $hsl=$this->query->result_array();
      }      
       
     return $hsl;
   }

  public function getjmlmhs_jmlstat($thnsms,$thn,$kls)
   {    
   
   $hitung=function ($stat) use ($thnsms,$thn,$kls)
       {
         $this->db->select("thnsmsstat_mhs,tahunmsmhs,shiftmsmhs,SUM(IF(kdjekmsmhs='L',1,0)) AS jmlL,SUM(IF(kdjekmsmhs='P',1,0)) AS jmlP,count(statstat_mhs) as jml");
         $this->db->from("stat_mhs");
         $this->db->join("msmhs","nimstat_mhs=nimhsmsmhs");
         $this->db->group_by("thnsmsstat_mhs,tahunmsmhs,shiftmsmhs");
         
         $txt_where = "thnsmsstat_mhs='$thnsms' and tahunmsmhs='$thn' and shiftmsmhs='$kls'";
         $txt_where .=($stat!='T') ? "and statstat_mhs=$stat":'';          
         $this->db->where($txt_where);
         $this->query = $this->db->get();
         
         $this->numrows = $this->query->num_rows();
         if($this->query->num_rows()>0)
         {
           $data=$this->query->result_array();
           return array('L'=>$data[0]['jmlL'],'P'=>$data[0]['jmlP'],'jml'=>$data[0]['jml']);
         }else{
           return array('L'=>0,'P'=>0,'jml'=>0);
         }
       }; 
   
   $jml = array();     
   $jml['T']=$hitung('T');     
   $jml['1']=$hitung(1);
   $jml['2']=$hitung(2);
   $jml['3']=$hitung(3);
   $jml['4']=$hitung(4);
   $jml['5']=$hitung(5);
   $jml['6']=$hitung(6);
     
   return $jml;
   }

   public function insertdata($data)
   {
      $this->db->insert('stat_mhs',$data);
   }

   public function updatedata($data)
   {
     $this->db->set('statstat_mhs', $data['statstat_mhs']);
     $this->db->where('thnsmsstat_mhs',$data['thnsmsstat_mhs']);
     $this->db->where('nimstat_mhs',$data['nimstat_mhs']);
     $this->db->update('stat_mhs');

   }

   public function deletedata($data)
   {
     $this->db->where('thnsmsstat_mhs',$data['thnsmsstat_mhs']);
     $this->db->where('nimstat_mhs',$data['nimstat_mhs']);
     $this->db->delete('stat_mhs');     
   }

   public function deletealldata($thn)
   {
     $this->db->where('thnsmsstat_mhs',$thn);     
     $this->db->delete('stat_mhs');     
   }

   public function importdata($tb,$field,$field1,$where)
   {
    if(!empty($where)){
      $query = "INSERT INTO $tb ($field) select $field1 from stat_mhs where $where";
    }else
    {
      $query = "INSERT INTO $tb ($field) select $field1 from stat_mhs";
    }
    $this->db->query($query);     
   }

   function getRStatMhs($nim,$thn=0)
   {
     $vmythnsem = new mythnsem;
   
       
   if($nim!=""){     
        $data = $this->getdata("nimstat_mhs='".$nim."'");     
   }else{
     
       $data = $this->getdata(""); 
   }
   
   
      $hsl = array(); 
        
    if(!empty($data))
    {   
      
             
          $obj = $this;
      array_walk($data,function ($row,$key) use (&$hsl,$obj) {
        $vmythnsem = new mythnsem;
        $hsl[$row['nimstat_mhs']]['rstat'][$row['thnsmsstat_mhs']]['txt']=$vmythnsem->gettxtthnsem($row['thnsmsstat_mhs']);
        $hsl[$row['nimstat_mhs']]['rstat'][$row['thnsmsstat_mhs']]['kdstat']=$obj->stattocd($row['statstat_mhs']);
        $hsl[$row['nimstat_mhs']]['rstat'][$row['thnsmsstat_mhs']]['txtstat']=$obj->stattostr($row['statstat_mhs']);
      });
      
          
      array_walk($hsl,function ($row,$f) use (&$hsl,$obj) {     
        
        $tmp=$obj->hmstd($row['rstat']);
        
        $hsl[$f]['sawal']=$tmp['sawal'];           
        $hsl[$f]['sakhir']=$tmp['sakhir'];  
          $hsl[$f]['bstd']=$tmp['bstd'];
          $hsl[$f]['tsakhir']=$tmp['tsakhir'];
          $hsl[$f]['tbstd']=$tmp['tbstd'];
      
      });
     
    
    }  
    
   
   return $hsl;
   }

   private function hmstd($data)
   {
        $vmythnsem = new mythnsem;
    $txtsemawal='';
    $semawal=0;
    $thnawal=2008;    
    $jmlcuti=0;
    $jmltolcuti=0;
    $jmlnoncuti=0;
    
    $hsl=array();
    
    if(!empty($data))
    {
      $i=1;
      foreach($data as $f=>$v)
      {
                
        if($i==1){
                  $txtsemawal=$vmythnsem->gettxtthnsem($f);
                $semawal=$f; 
                        $thnawal=$vmythnsem->getthn($f); 
               }  
             
        if($v['kdstat']=='C')
        {
           if($i<=8){  
           $jmlcuti=$jmlcuti+1;                    
         } 
        
        if(($i<=14) and ($thnawal<=2010)){  
           $jmltolcuti=$jmltolcuti+1;                              
         } else {
            if(($i<=10) and ($thnawal>2010) ){  
                $jmltolcuti=$jmltolcuti+1;               
          }
        }
         
        }else{
                 if(strpos("A N",$v['kdstat'])!==false)
           {
           $jmlnoncuti=$jmlnoncuti+1;
         }
              }   
        $i=$i+1;      
      }
    
    } 
    
        
    $semakhir = $vmythnsem->gettxtthnsem($vmythnsem->addthnsem($semawal,7+$jmlcuti));   
    $tolsemakhir =  $vmythnsem->gettxtthnsem($vmythnsem->addthnsem($semawal,($thnawal<=2010 ? 13 : 9)+$jmltolcuti));
    
    $sembts = $vmythnsem->getsem($vmythnsem->addthnsem($semawal,7+$jmlcuti));
    $thnbts = $vmythnsem->getthn($vmythnsem->addthnsem($semawal,7+$jmlcuti));
        $tolsembts = $vmythnsem->getsem($vmythnsem->addthnsem($semawal,($thnawal<=2010 ? 13 : 9)+$jmltolcuti));   
    $tolthnbts = $vmythnsem->getthn($vmythnsem->addthnsem($semawal,($thnawal<=2010 ? 13 : 9)+$jmltolcuti));
    
      $hsl['sawal']=$txtsemawal;
        $hsl['sakhir']=$semakhir; 
      $hsl['bstd']=(($sembts==2) ? 'Agustus '.($thnbts+1):'Februari '.($thnbts+1));
      $hsl['tsakhir']=$tolsemakhir;
      $hsl['tbstd']=(($tolsembts==2) ? 'Agustus '.($tolthnbts+1):'Februari '.($tolthnbts+1));
   
        return $hsl;
        
   }




}