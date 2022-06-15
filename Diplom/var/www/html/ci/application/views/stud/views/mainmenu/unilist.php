<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   $this->page_control_data->add_css(view_prefix("stud/css/mainmenu/bodyframe.css"));
   $thead = true;
   $a_href = isset($HREF) ? $HREF : "";
?>
<table>
    <?php foreach ($STRLIST as $k => $v): ?>
        <?php if ($thead): ?>
         <thead>
             <tr>
            <?php foreach ($v as $kz => $vz): ?>
            <td>
              <?=$vz?>  
            </td>
            <?php endforeach; ?>
            </tr>
         </thead>
        <?php else:?>
    <tr>
        <td>
            <?php if (!empty($a_href)) :?>
            <a href="<?=$a_href.$v["id"]?>">
            <?php endif;?>              
            <?=$v["info1"]?>
            <?php if (!empty($a_href)) :?>
            </a>
            <?php endif;?>
        </td>
        <td>
          <?=$v["info2"]?>  
        </td>
        <td>
          <?= is_null($v["ntotal"]) ? "--" : $v["ntotal"]; ?>  
        </td>
        <td>
          <?= is_null($v["npositiv"]) ? "--" : $v["npositiv"]?>  
        </td>
        <td>
          <?= is_null($v["npositiv"]) || is_null($v["npositiv"])? "--" : round($v["npositiv"]/$v["ntotal"],2)?>  
        </td>
    </tr>
        <?php endif;?>
    <?php $thead=false; ?>    
    <?php endforeach; ?>
</table>