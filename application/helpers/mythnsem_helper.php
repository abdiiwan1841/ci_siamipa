<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class mythnsem 
{  var $thnsem_;
   var $thn_;
   var $sem_;
   var $isganjil_;
   var $txtsem_;
   var $txtthnsem_;    
 
   function __construct()
   {
       /* Start = menentukan tahun ajaran sekarang */
		$tahun_ini = date('Y');
		$tahun_kemarin = $tahun_ini - 1;
		/* Start = menentukan tahun ajaran sekarang */
		
		/* Start = menentukan semester ganjil/genap */
		$nama_bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		$bulan = date('n')-1;
		$bulan_ini = $nama_bulan[$bulan];
						
		$data_arr = array(0 => array("semester" => 1, "month" => "Agustus September Oktober November Desember Januari"),1 => array("semester" => 2, "month" => "Februari Maret April Mei Juni Juli"));
		$angka_sem = 0;
		for ($i=0; $i<2; $i++) {
		   
		   if (strpos($data_arr[$i]['month'],$bulan_ini)!==false){
		      
		       $angka_sem = $data_arr[$i]['semester'];
		     }		   
		}
		
		/* End = menentukan semester ganjil/genap */
        		
		if($angka_sem==1){
		  if((date('n')== 1) or(date('n')== 2)){
		    $this->thnsem_ = ($tahun_ini-1).$angka_sem; 
			$this->thn_ = ($tahun_ini-1);
		  }else{  
			$this->thnsem_ = $tahun_ini.$angka_sem;
            $this->thn_ = $tahun_ini;			
          }
		  
		  $this->sem_ =$angka_sem;
		  $this->isganjil_ = true; 
          $this->txtsem_ = 'Ganjil';
          $this->txtthnsem_ = 'Semester Ganjil '.$this->thn_;		  
		}
		else{
		  $this->thnsem_ = $tahun_kemarin.$angka_sem;
		  $this->thn_ = $tahun_kemarin;
		  $this->sem_ =$angka_sem;
		  $this->isganjil_ = false;
		  $this->txtsem_ = 'Genap';
		  $this->txtthnsem_ = 'Semester Genap '.$this->thn_;
		}		
   }
   
   function getthnsem()
   {
     return $this->thnsem_; 	  
   }
   
   function getthn($thnsem='')
   {
    if(empty($thnsem))
	 {
      return $this->thn_;
     }else{
       $tmp = str_split($thnsem, 4);
	   return $tmp[0];
     } 	  	  
   }
   
   function getsem($thnsem='')
   {
     if(empty($thnsem))
	 {
      return $this->sem_;
     }else{
       $tmp = str_split($thnsem, 4);
	   return $tmp[1];
     } 	  	  
   }
   
   function gettxtsem($thnsem='')
   {
     if(empty($thnsem))
	 {
      return $this->txtsem_;
     }else{
       $tmp = str_split($thnsem, 4);
	   return $tmp[1]=='1' ? 'Ganjil' : 'Genap';
     } 	  	  
   }
   
   function gettxtthnsem($thnsem='',$txt='Semester ')
   {
     if(empty($thnsem))
	 {
      return $this->txtthnsem_;
     }else{
       return $txt.$this->gettxtsem($thnsem).' '.$this->getthn($thnsem);
     } 	 
   }
   
   function substhnsem($thnsem='',$addsem)
   {
        if(empty($thnsem))
		{
		   $isganjil=$this->isganjil_;  
		   $thn=$this->thn_; 
		
		}else{
		  $isganjil=$this->getsem($thnsem)=='1';  
		  $thn=$this->getthn($thnsem);
		
		}

		if($isganjil)
		 {
		   if(($addsem % 2)==0)
		   {
			 return  (string)((int) $thn-(int)($addsem / 2)).'1';
		   
		   }else{
		   
			 return  (string)((int) $thn-(int)(($addsem / 2)+1)).'2';
		   }
		 
		 }else{
		 
		   if(($addsem % 2)==0)
		   {
			 return (string)((int) $thn-(int)($addsem / 2)) .'2';
		   
		   }else{
		   
			 return  (string)((int) $thn-(int)($addsem / 2)).'1';
		   }
		 
		 }

   
   }   
   
   function addthnsem($thnsem='',$addsem)
   {
      if(empty($thnsem))
		{
		   $isganjil=$this->isganjil_;  
		   $thn=$this->thn_; 
		
		}else{
		  $isganjil=$this->getsem($thnsem)=='1';  
		  $thn=$this->getthn($thnsem);
		
		}

		if($isganjil)
		 {
		   if(($addsem % 2)==0)
		   {
			 return  (string)((int) $thn+(int)($addsem / 2)).'1';
		   
		   }else{
		   
			 return  (string)((int) $thn+(int)($addsem / 2)).'2';
		   }
		 
		 }else{
		 
		   if(($addsem % 2)==0)
		   {
			 return (string)((int) $thn+(int)($addsem / 2)).'2';
		   
		   }else{
		   
			 return   (string)((int) $thn+(int)(($addsem / 2)+1)).'1';
		   }
		 
		 }
   }
   
   function getlstthnsem($awl='',$akh='')
   {
      $awl = empty($awl) ? '20081' : $awl;
	  $akh = empty($akh) ? $this->getthnsem() : $akh;
      
	  $data = array();	  
	  $next = $awl;	  
	  while($next<=$akh)
	  {
	    $data[$next]=$this->gettxtthnsem($next);
		$next = $this->addthnsem($next,1);
	    
	  }
          
	  return $data;
   
   }
   
}