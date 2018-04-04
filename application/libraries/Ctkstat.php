<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
require_once (dirname(dirname(__FILE__))."/third_party/PHPExcel.php");
require_once (dirname(dirname(__FILE__))."/libraries/Excel.php");

class Ctkstat extends Excel
{  private $col_width_;
   private $col_width_1;
   
   private $jdl_lstmhs;
   private $isilstmhs;
   private $jdl_sumstat;
   private $isisumstat;
   private $jml;
   
   private $bdrlstmhs;
   private  $bdrsumstat;
   
   private  $pagefooter;
   
	
   function __construct()
   {
     parent::__construct();

     $this->ci =& get_instance();
     $this->ci->load->model('Stat_mhs_model');
	 
	 $this->col_width_=array("B"=>8.60,"C"=>9.60,"D"=>25.60,"E"=>11.30,"F"=>19.60,"G"=>19.60);
	 
	 $this->col_width_1=array("B"=>8.60,"C"=>11.30,"D"=>8.75,"E"=>8.75,"F"=>8.75,"G"=>8.75,"H"=>8.75,"I"=>8.75,"J"=>8.75);
	 	 
	 $tmp_font = $this->build_font(true,'Calibri',11);	 
	 
	 $tmp_font1	= $tmp_font;
     $tmp_font1['bold']=false;	 
	 
	 
     $tmp_borders = $this->build_borders(PHPExcel_Style_Border::BORDER_THIN,PHPExcel_Style_Border::BORDER_MEDIUM);	 
	 
	 $this->jdl_lstmhs=array(  array('add'=>'B','row'=>9,'txt'=>'Angkatan','madd'=>'B9:B10','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font,'wbrdawl'=>'B','wbrdakh'=>'G','wbrdjml'=>1,'wborders'=>$tmp_borders),
							   array('add'=>'C9','txt'=>'NIM','madd'=>'C9:C10','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'D9','txt'=>'Nama','madd'=>'D9:D10','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'E9','txt'=>'Kelas','madd'=>'E9:E10','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'F9','txt'=>'Semester','madd'=>'F9:G9','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'F10','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'G10','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font)
							);	
      
	$this->isilstmhs = array(array('add'=>'B','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
					          array('add'=>'C','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					          array('add'=>'D','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
							  array('add'=>'E','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
							  array('add'=>'F','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1), 
							  array('add'=>'G','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1)
							 );
	
	
	
	$this->bdrlstmhs = array(array('add'=>'B','row'=>11,'wbrdawl'=>'B','wbrdakh'=>'G','wbrdjml'=>0,'wborders'=>$tmp_borders));
	
	
	
	$this->jdl_sumstat=array(  array('add'=>'B','row'=>9,'txt'=>'Angkatan','madd'=>'B9:B10','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font,'wbrdawl'=>'B','wbrdakh'=>'J','wbrdjml'=>1,'wborders'=>$tmp_borders),
							   array('add'=>'C9','txt'=>'Kelas','madd'=>'C9:C10','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'D9','txt'=>'Status','madd'=>'D9:J9','merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'D10','txt'=>'Aktif','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'E10','txt'=>'Cuti','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'F10','txt'=>'DO','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'G10','txt'=>'Keluar','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'H10','txt'=>'Lulus','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'I10','txt'=>'Non Aktif','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font),
							   array('add'=>'J10','txt'=>'Total','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font)
							);	
      
	$this->isisumstat = array(array('add'=>'B','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
					          array('add'=>'C','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'font'=>$tmp_font1),
					          array('add'=>'D','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
							  array('add'=>'E','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
							  array('add'=>'F','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1), 
							  array('add'=>'G','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
							  array('add'=>'H','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
							  array('add'=>'I','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1), 
							  array('add'=>'J','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1)
							 );
						 
	$this->jml = array(array('add'=>'B','row'=>'0','txt'=>'Jumlah','mawl'=>'B','makh'=>'C','mjml'=>0,'merge'=>true,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'font'=>$tmp_font1,'wbrdawl'=>'B','wbrdakh'=>'J','wbrdjml'=>0,'wborders'=>$tmp_borders),
					   array('add'=>'D','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
					   array('add'=>'E','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
					   array('add'=>'F','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
					   array('add'=>'G','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
					   array('add'=>'H','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
					   array('add'=>'I','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1),
					   array('add'=>'J','row'=>'0','txt'=>'','merge'=>false,'v'=>PHPExcel_Style_Alignment::VERTICAL_CENTER,'h'=>PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,'font'=>$tmp_font1)
					  );	
	$this->bdrsumstat = array(array('add'=>'B','row'=>11,'wbrdawl'=>'B','wbrdakh'=>'J','wbrdjml'=>0,'wborders'=>$tmp_borders));
	
	
			   
    						
	$this->pagefooter='&L&5Dicetak dari Sistem Informasi Akademik FMIPA UNIBBA pada tanggal : '.date("d-m-Y H:i:s").' &R&5dicetak ulang : &D &T'; 
   }
   
   
   
   function ctk_stat($datalstmhs,$datasumstat,$thnsms)
   {
      $this->setActiveSheetIndex(0);
	  $this->setSheetTittle("Mahasiswa");
	  
	  $this->setColumnWidth($this->col_width_);
	  	  
	  $mythnsem = new mythnsem;
	  
	  
	  $thnsms1=$mythnsem->substhnsem($thnsms,1); 
	  
	  $this->jdl_lstmhs[5]['txt']=$mythnsem->gettxtsem($thnsms1).' '.$mythnsem->getthn($thnsms1);
	  $this->jdl_lstmhs[6]['txt']=$mythnsem->gettxtsem($thnsms).' '.$mythnsem->getthn($thnsms);
	  
	  $this->tulis_data($this->jdl_lstmhs);
	  	  
	  $start_row=10;
	  $i=1; 
	  foreach($datalstmhs as $row)
      {
	     $this->isilstmhs[0]['txt'] = $row["tahunmsmhs"];
	     $this->isilstmhs[1]['txt'] = $row["nimhsmsmhs"];
	     $this->isilstmhs[2]['txt'] = $row["nmmhsmsmhs"]; 
		 $this->isilstmhs[3]['txt'] = $row["shiftmsmhs"]=="R" ? "Reguler" : "Non Reguler";
         $this->isilstmhs[4]['txt'] = $this->ci->Stat_mhs_model->getstatmhs($thnsms1,$row["nimhsmsmhs"]) ;
	     $this->isilstmhs[5]['txt'] = $this->ci->Stat_mhs_model->getstatmhs($thnsms,$row["nimhsmsmhs"]);
		 $this->tulis_data($this->isilstmhs,($start_row+$i));
		 $i++;
	  }
	  $this->bdrlstmhs[0]['wbrdjml']=$i-2;
	  $this->tulis_data($this->bdrlstmhs);
	  
      $this->setPageSetup(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT,PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4,true,false);
	  $margin = 0.5 / 2.54;
	  $this->setMargin($margin,$margin,$margin,$margin);
			
	  $this->setFooter($this->pagefooter); 	  
	 
	 
	 $this->createSheet(); 
	 $this->setActiveSheetIndex(1);
	 $this->setSheetTittle("Summary");
	 
	 $this->setColumnWidth($this->col_width_1);	

	  $this->tulis_data($this->jdl_sumstat);
	  
        $jmltot = array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'T'=>0);
		$kls = array('R','N');
		
		$start_row=10;
	    $i=1;
		foreach($datasumstat as $row)
		{
		   foreach($kls as $kls1)
		   {
             $this->isisumstat[0]['txt'] = $row['tahunmsmhs'];
			 $this->isisumstat[1]['txt'] = $kls1=='R' ? "Reguler" : "Non Reguler";
			 $jml=$this->ci->Stat_mhs_model->getjmlmhs_jmlstat($thnsms,$row['tahunmsmhs'],$kls1);
			 
			 $this->isisumstat[2]['txt'] = $tmp=$jml['1']['jml']; 
			 $jmltot['1']+=$tmp;
			 $this->isisumstat[3]['txt'] = $tmp=$jml['2']['jml']; 
			 $jmltot['2']+=$tmp;
			 $this->isisumstat[4]['txt'] = $tmp=$jml['3']['jml']; 
			 $jmltot['3']+=$tmp;
			 $this->isisumstat[5]['txt'] = $tmp=$jml['4']['jml']; 
			 $jmltot['4']+=$tmp;
			 $this->isisumstat[6]['txt'] = $tmp=$jml['5']['jml']; 
			 $jmltot['5']+=$tmp;
			 $this->isisumstat[7]['txt'] = $tmp=$jml['6']['jml']; 
			 $jmltot['6']+=$tmp;
			 $this->isisumstat[8]['txt'] = $tmp=$jml['T']['jml']; 
			 $jmltot['T']+=$tmp;

			 $this->tulis_data($this->isisumstat,($start_row+$i));
			 $i++;
	       }
		}
		     $this->bdrsumstat[0]['wbrdjml']=$i-2;
	         $this->tulis_data($this->bdrsumstat);
			 
			 $this->jml[1]['txt'] = $jmltot['1'];
			 $this->jml[2]['txt'] = $jmltot['2'];
			 $this->jml[3]['txt'] = $jmltot['3'];
			 $this->jml[4]['txt'] = $jmltot['4'];
			 $this->jml[5]['txt'] = $jmltot['5'];
			 $this->jml[6]['txt'] = $jmltot['6'];
			 $this->jml[7]['txt'] = $jmltot['T'];
			 $this->tulis_data($this->jml,($start_row+$i));
			 
		 	$this->setPageSetup(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT,PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4,true,false);
			$margin = 0.5 / 2.54;
			$this->setMargin($margin,$margin,$margin,$margin);
			
			$this->setFooter($this->pagefooter);
   }
   
   
}