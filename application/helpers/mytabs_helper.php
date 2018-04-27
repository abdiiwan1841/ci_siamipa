<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class mytabs
{
    var $id_;
    var $header_;
    var $content_;	
	 
	 function __construct($id,$header,$content)
	 {
	  	$this->id_=$id;
        $this->header_=$header;
        $this->content_=$content;	  
	 }

     function display()
     {
        $html_txt = '<div id="'.$this->id_.'" class="nav-tabs-custom" >';
        
		$html_txt.="<ul class='nav nav-tabs'>";
        if(!empty($this->header_))
		{  $i=1;
		   foreach($this->header_ as $header)
		   {
		     $html_txt.="<li ".($i==1?'class="active"':'')."><a href='#".$this->id_."_".$i."'  data-toggle='tab' >".$header."</a></li>";
			 $i++;
		   }
		
		}
        $html_txt.="</ul>";
		
       $html_txt .='<div class="tab-content">';  
          
		if(!empty($this->content_))
		{ $i=1;
		  foreach($this->content_ as $content)
		   {
		     $html_txt.="<div class='tab-pane ".($i==1?'active':'')."' id='".$this->id_."_".$i."'>".$content."</div>";
			 $i++;
		   }
		
		}

		$html_txt .='</div>';
		
        $html_txt .='</div>';

        return $html_txt;		
     }	 
}


?>