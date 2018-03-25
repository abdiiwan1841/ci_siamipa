<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class div_row_col
{
	private $row_;
	private $col_;
	private $content_;

	function __construct($row,$col,$content)
	{
		$this->row_=$row;
		$this->col_=$col;
		$this->content_=$content;

	}

	function display()
	{
        $txt='';
        if(!empty($this->row_))
        {
        	for ($i=1;$i<=$this->row_['jml'];$i++) {
        	  $txt.='<div class="row">';
        	  if (!empty($this->col_)) {
        	  	for ($j=1; $j <= $this->col_['jml']; $j++) { 
        	  		$txt.='<div class="'.$this->col_['class'][$j-1].'">';
                    if(isset($this->content_[$i-1][$j-1])){
        	  		  $txt.=$this->content_[$i-1][$j-1];
                    }        	  		
                    $txt.='</div>';        	  	
        	  	}        		
         	  }
        	  $txt.='</div>';
            }        	
        	  
        }


        return $txt;
	}
}