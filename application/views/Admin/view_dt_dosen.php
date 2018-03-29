<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>      

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $judul;?></h4>
      </div>
      <form id="dtdosen" action="" method="post" >  

      <div class="modal-body">         
         <?php              
              $from = new html_form();
              echo $from->addInput('hidden',"kode",$Kode,null);
              $desc = new desc($view);                   
              echo $desc->display('dl-horizontal'); 
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