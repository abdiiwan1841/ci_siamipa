<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
require_once (dirname(dirname(__FILE__))."/third_party/PHPExcel.php");
require_once (dirname(dirname(__FILE__))."/libraries/Excel.php");


class Ctkrkrs extends Excel 
{  private $col_width_;
   private $jdl;
   private $jdlkrs;
   private $jdlmtk;
   private $jdlprtk;
   private $isidatamtk;
   private $isijml;
   private $isidataprtk;
   private $bdrmtk;
   private $bdrprtk;
   private $ttd;
   
   private $pagefooter;
   private $jdl2;
	
   function __construct()
   {
     parent::__construct();
	 
	 $this->col_width_=array("A"=>3.34,"C"=>0.92,"F"=>0.92,"H"=>11.14,"I"=>0.92);
	
	 $tmp_font  = $this->build_font(true,'Times New Roman',10);
	 
	 $tmp_font1 = $this->build_font(true,'Calibri',9);	 
	 $tmp_font2 = $tmp_font1;
	 $tmp_font2['bold']=false;	  
	
	 
     $tmp_borders = $this->build_borders(PHPExcel_Style_Border::BORDER_THIN,PHPExcel_Style_Border::BORDER_MEDIUM);	 
	 
	 $this->jdl=array(array('add'=>'C1','txt'=>'PROGRAM STUDI MATEMATIKA','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font),
	                   array('add'=>'C2','txt'=>'FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font),
					   array('add'=>'C3','txt'=>'UNIVERSITAS BALE BANDUNG','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font), 
                       
					   array('add'=>'A5','txt'=>'KARTU RENCANA STUDI (KRS)','madd'=>'A5:K5','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
					   
					   array('add'=>'A7','txt'=>'NIM','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					   array('add'=>'A8','txt'=>'NAMA','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					   array('add'=>'A9','txt'=>'Dosen Wali','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					  				   
					   array('add'=>'C7','txt'=>':','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
					   array('add'=>'C8','txt'=>':','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
					   array('add'=>'C9','txt'=>':','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
					   				   
					   array('add'=>'H7','txt'=>'Sem. Awal','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					   array('add'=>'H8','txt'=>'Tahun Ajaran','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					   array('add'=>'H9','txt'=>'Semester','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					  				   
					   array('add'=>'I7','txt'=>':','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
					   array('add'=>'I8','txt'=>':','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
					   array('add'=>'I9','txt'=>':','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1)
					   
					   );	
                       
	$this->jdlkrs = array( array('add'=>'D7','txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					       array('add'=>'D8','txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					       array('add'=>'D9','txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					       
						   array('add'=>'J7','txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
						   array('add'=>'J8','txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					       array('add'=>'J9','txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1)						   
						 );				   
					   
					   
	$this->jdlmtk = array(				   
					   array('add'=>'A11','txt'=>'Matakuliah :','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					   array('add'=>'A','row'=>12,'txt'=>'NO','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1,'wbrdawl'=>'A','wbrdakh'=>'K','wbrdjml'=>0,'wborders'=>$tmp_borders),
					   array('add'=>'B12','txt'=>'KODE','madd'=>'B12:D12','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
					   array('add'=>'E12','txt'=>'NAMA','madd'=>'E12:I12','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
					   array('add'=>'J12','txt'=>'SKS','madd'=>'J12:K12','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1)
	                );
	
	$this->isidatamtk = array(array('add'=>'A','row'=>'0','txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font2),
					          array('add'=>'B','row'=>'0','txt'=>'','mawl'=>'B','makh'=>'D','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font2),
					          array('add'=>'E','row'=>'0','txt'=>'','mawl'=>'E','makh'=>'I','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font2),
							  array('add'=>'J','row'=>'0','txt'=>'','mawl'=>'J','makh'=>'K','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font2)
							 );
	
	$this->isijml = array(array('add'=>'A','row'=>'0','txt'=>'Jumlah','mawl'=>'A','makh'=>'I','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'wbrdawl'=>'A','wbrdakh'=>'K','wbrdjml'=>0,'wborders'=>$tmp_borders),
					      array('add'=>'J','row'=>'0','txt'=>'','mawl'=>'J','makh'=>'K','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1)
							 );
	
	$this->bdrmtk = array(array('add'=>'A','row'=>13,'wbrdawl'=>'A','wbrdakh'=>'K','wbrdjml'=>0,'wborders'=>$tmp_borders));
	
	$this->jdlprtk = array(				   
					   array('add'=>'A','row'=>0,'txt'=>'Praktikum :','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					   array('add'=>'A','row'=>1,'txt'=>'NO','madd'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1,'wbrdawl'=>'A','wbrdakh'=>'I','wbrdjml'=>0,'wborders'=>$tmp_borders),
					   array('add'=>'B','row'=>1,'txt'=>'KODE','mawl'=>'B','makh'=>'D','mjml'=>0,'merge'=>true,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
					   array('add'=>'E','row'=>1,'txt'=>'NAMA','mawl'=>'E','makh'=>'I','mjml'=>0,'merge'=>true,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1)
					);
	
	$this->isidataprtk = array(array('add'=>'A','row'=>'0','txt'=>'','v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font2),
					          array('add'=>'B','row'=>'0','txt'=>'','mawl'=>'B','makh'=>'D','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font2),
					          array('add'=>'E','row'=>'0','txt'=>'','mawl'=>'E','makh'=>'I','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font2)
						 );
		
	$this->bdrprtk = array(array('add'=>'A','row'=>0,'wbrdawl'=>'A','wbrdakh'=>'I','wbrdjml'=>0,'wborders'=>$tmp_borders));
	
	
	$this->ttd = array( array('add'=>'B','row'=>0,'txt'=>'MAHASISWA','mawl'=>'B','makh'=>'D','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'wbrdawl'=>'B','wbrdakh'=>'G','wbrdjml'=>2,'wborders'=>$tmp_borders),
		                array('add'=>'E','row'=>0,'txt'=>'DOSEN WALI','mawl'=>'E','makh'=>'G','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
					    array('add'=>'B','row'=>1,'txt'=>'','mawl'=>'B','makh'=>'D','mjml'=>1,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1),
						array('add'=>'E','row'=>1,'txt'=>'','mawl'=>'E','makh'=>'G','mjml'=>1,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1)
					   );			   
    						
	$this->pagefooter='&L&5Dicetak dari Sistem Informasi Akademik FMIPA UNIBBA pada tanggal : '.date("d-m-Y H:i:s").' &R&5dicetak ulang : &D &T'; 
   }
   
   
   
   function ctk_KRS($datamhs,$datamtk,$dataprtk)
   {
      $this->setActiveSheetIndex(0);
	  $this->setColumnWidth($this->col_width_);
	  
	  
	   $objDrawing = new PHPExcel_Worksheet_Drawing();
       $objDrawing->setWorksheet($this->getActiveSheet());
       $objDrawing->setName("logo");
       $objDrawing->setDescription("logo fakultas");
       $objDrawing->setPath(dirname(dirname(dirname(__FILE__))).'/assets/img/logo_fak.jpg');
       $objDrawing->setCoordinates('B1');
	   //$objDrawing->setHeight(53);
       $objDrawing->setWidth(60);
	   $objDrawing->setOffsetX(-10);
       $objDrawing->setOffsetY(0);  
	  
	  $vmythnsem = new mythnsem;
	  $TA = $vmythnsem->getthnsem();
	  
	  $this->tulis_data($this->jdl);
	  
	  foreach($datamhs as $row)
      {
	     $this->jdlkrs[0]['txt'] = $row['nimhsmsmhs'];
	     $this->jdlkrs[1]['txt'] = $row['nmmhsmsmhs'];
	     $this->jdlkrs[2]['txt'] = '';   
		 		 
		 $this->jdlkrs[3]['txt'] = $vmythnsem->gettxtsem($row['smawlmsmhs'])." ".$vmythnsem->getthn($row['smawlmsmhs']);
         $this->jdlkrs[4]['txt'] = $vmythnsem->getthn($row['smawlmsmhs'])."/". ($vmythnsem->getthn($row['smawlmsmhs'])+1) ;
	     $this->jdlkrs[5]['txt'] = $vmythnsem->gettxtsem()." ".$vmythnsem->getthn();
	  }
	  
	  $this->tulis_data($this->jdlkrs);
	  
	  $start_row=12;
	  $i=1; 
	  $jml_sks = 0;
	  $this->tulis_data($this->jdlmtk);
	  
	  if(!empty($datamtk)){
	    foreach($datamtk as $row){    
			$this->isidatamtk[0]['txt']= $i;
			$this->isidatamtk[1]['txt']= $row['kdkmktrnlm'];
			$this->isidatamtk[2]['txt']= $row['nakmktbkmk'];
			$this->isidatamtk[3]['txt']= $row['sksmktbkmk'];
            $jml_sks+=$row['sksmktbkmk'];
			$this->tulis_data($this->isidatamtk,($start_row+$i));
		    $i++;
        }	
	  }	
	     	$this->isidatamtk[0]['txt']= '';
			$this->isidatamtk[1]['txt']= '';
			$this->isidatamtk[2]['txt']= '';
			$this->isidatamtk[3]['txt']= '';
		    $this->tulis_data($this->isidatamtk,($start_row+$i));
		
		    $this->bdrmtk[0]['wbrdjml']=$i;
		    $this->tulis_data($this->bdrmtk);
		    
			$i++;
			$this->isijml[1]['txt']= $jml_sks;
		    $this->tulis_data($this->isijml,($start_row+$i));
			
			$i=$i+2;
			$this->tulis_data($this->jdlprtk,($start_row+$i));
            $start_row=$start_row+($i+1);
			$i=1;
			
		 if(!empty($dataprtk)){
	         foreach($dataprtk as $row){
		             $kd = str_split($row['kdkmktrnlm'],4); 
		             if($kd[0]=='MATP'){  
						    $this->isidataprtk[0]['txt']= $i;
							$this->isidataprtk[1]['txt']= $row['kdkmktrnlm'];
							$this->isidataprtk[2]['txt']= $row['nakmktbkmk'];							
							$this->tulis_data($this->isidataprtk,($start_row+$i));							
							$i++;
		             }
			 }
         } 			 
		 
		                    $this->isidataprtk[0]['txt']= '';
							$this->isidataprtk[1]['txt']= '';
							$this->isidataprtk[2]['txt']= '';							
							$this->tulis_data($this->isidataprtk,($start_row+$i));
							
							$this->bdrprtk[0]['wbrdjml']=$i;
		                    $this->tulis_data($this->bdrprtk,($start_row));
							
							$i=$i+2;
							$this->tulis_data($this->ttd,($start_row+$i));
		 
		 
		 	$this->setPageSetup(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT,PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4,true,false);
			$margin = 0.5 / 2.54;
			$this->setMargin($margin,$margin,$margin,$margin);
			
			$this->setFooter($this->pagefooter);
   }
   
   
}