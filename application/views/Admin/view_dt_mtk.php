<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>      

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $judul;?></h4>
      </div>
      <form id="dtmtk" action="" method="post" >  

      <div class="modal-body">         
         <?php              
              
              $from = new html_form();
              echo $from->addInput('hidden',"kode",$Kode,null);
              $desc = new desc($view);                   
              $body=$desc->display('dl-horizontal'); 

              $box=array('class'=>'box-primary');
              $header_box = array('class'=>'','title'=>'Data Matakuliah');
              $tempbox=new box($box,$header_box,$body); 
              echo $tempbox->display();

                    $row = array('jml'=>1);
                    $col = array('jml'=>1,'class'=>array('col-md-12'));
                    $divrowcol = new div_row_col($row,$col,array(array('<div>'.$lstsyarat.'</div>')));                 
                       

                    $header_box = array('class'=>'','title'=>'Prasyarat Matakuliah');
                    $body = $divrowcol->display();
                    $tempbox=new box($box,$header_box,$body); 
                    echo $tempbox->display();
         ?>
       </div>
      </div>
      <div class="modal-footer">
       <?php if(($hak==1) and ($idx==2) ){ ?> 
         <button type="submit" class="btn btn-primary">Delete</button>
       <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>           
      </div>
    </form>