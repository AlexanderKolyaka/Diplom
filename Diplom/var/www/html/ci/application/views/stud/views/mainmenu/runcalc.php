<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
    <script type="text/javascript">
     location="<?=$config['base_url']?>/mainmenu/runcalc/<?=$NEXTSTEP?>";
    </script> 

 *  */

?>
<!DOCTYPE html>
<html>
  <head>
    <title><?=$this->page_control_data->TITLE?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=350, initial-scale=1">
    <?php if ($PERCENT<=1): ?>
    <script type="text/javascript">      
       timeoutID = window.setTimeout(function(){location="<?=$BASE?>mainmenu/runcalc/<?=$NEXTSTEP?>";}, 100);
    </script> 
    <?php endif; ?>
  </head>
  <body>
      <label title="<?=$PERCENT*100?>%">Выполнение
          <meter value="<?=$PERCENT?>"><?=$PERCENT*100?>%</meter>
      </label>
       <?php if ($PERCENT>1): ?>
       Готово
    <?php endif; ?>
  </body>
      