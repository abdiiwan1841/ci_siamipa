<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

 require_once 'html_table.php';
 
 class mytable
 {
    var $tbstat_;
	var $header_;
	var $data_;
	var $footer_;
	
	
    
	function __construct($tbstat,$header,$data,$footer)
	{
       $this->tbstat_=$tbstat;
	   $this->header_=$header;
	   $this->data_=$data;
	   $this->footer_=$footer;
	}
	
	function display()
	{
	  
	    $tbl = new HTML_Table(null, 'table table-bordered table-striped', 0, 0, 0,$this->tbstat_);
		
		if(!empty($this->header_))
		{
			foreach($this->header_ as $header1)
			{		  
				$tbl->addRow();
				foreach($header1 as $data){
				  if(is_array($data)){
					 $tbl->addCell($data[0], null, 'header',$data[1]);
				  }else{		 
					 $tbl->addCell($data, null, 'header');
				  } 
				}  
			}
		}
		if(!empty($this->data_))
		{		
		  foreach($this->data_ as $row)
		  {
		    $tbl->addRow(null,array('id'=>'mainrow'));
	        foreach($row as $v){ 
			   $tbl->addCell($v[0], null, 'data',$v[1]);
	        }
		  }		
		}
		
		
		
	  if($this->footer_!=""){	
	    return $tbl->display($this->footer_);
      }else{
        return $tbl->display();
      }	  
	} 
 }