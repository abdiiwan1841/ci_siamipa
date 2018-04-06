<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

$box=array('class'=>'');
$header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));                  

$body2=$lst_pindahan; 

$header_box['title']='Daftar Nilai Konversi : '.$nm.' ('.$nim.')';
$tempbox= new box($box,$header_box,$body2); 
echo $tempbox->display();
?>    



 