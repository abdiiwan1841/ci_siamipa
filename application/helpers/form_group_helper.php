<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class form_group
{
	private $label_;
	private $input_;
	
	function __construct($label,$input)
	{
		$this->label_=$label;
		$this->input_=$input;

	}

	function display()
	{       
       $txt='<div class="form-group">';
       $txt.="<label>$this->label_</label>";
       $txt.=$this->input_;                  
       $txt.='</div>';
       return $txt;
	}
}