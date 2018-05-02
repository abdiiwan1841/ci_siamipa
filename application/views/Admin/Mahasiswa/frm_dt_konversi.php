<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

$box=array('class'=>'');
$header_box = array('class'=>'with-border','title'=>'','tools'=>array(array('widget'=>'collapse','icon'=>'fa fa-minus'),array('widget'=>'remove','icon'=>'fa fa-times')));                  

$body2='<div id="data1">'.$lst_pindahan.'</div>'; 

$frm = new html_form();
$button = '<div id="btn">';
if($hak==1){
      $button.=$frm->addInput('submit',"Add","Tambah Mtk",array('class'=>'btn btn-info pull-left','id'=>'add')).
      $frm->addInput('submit',"Edit","Edit HM",array('class'=>'btn btn-info pull-left','id'=>'edit')).
      $frm->addInput('submit',"Delete","Hapus Mtk",array('class'=>'btn btn-info pull-left','id'=>'del')).
      $frm->addInput('submit',"Eksport","Publikasi",array('class'=>'btn btn-info pull-left','id'=>'eksport'));
} 
$button .= $frm->addInput('submit',"Close","Close",array('class'=>'btn btn-info pull-right','id'=>'close')).'</div>';

$header_box['title']='Daftar Nilai Konversi : '.$nm.' ('.$nim.')';
$tempbox= new box($box,$header_box,$body2,$button); 
echo $tempbox->display();
?>    



 