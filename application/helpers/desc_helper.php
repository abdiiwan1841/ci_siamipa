<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class desc
{
	private $content_;
	

	function __construct($content)
	{
		$this->content_=$content;
  }

	function display($class)
	{
        $txt='<dl class="'.$class.'">';
        if(!empty($this->content_))
        {
        	foreach ($this->content_ as $key=>$value) {
               $txt.='<dt>';
               $txt.=$key;                  
               $txt.='</dt>';

               $txt.='<dd>';
               $txt.=$value;                  
               $txt.='</dd>';
          }
        }
        $txt.='</dl>'; 

        return $txt;
	}
}