<?php

/* 
 * bystore.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 06.08.2018 Версия 1
 *
 * Полное описание файла
 */
  $oldshp = "***";
  $showfoot = FALSE;
  $this->page_control_data->TITLE = "Суммарно по магазинам";
  $this->page_control_data->add_js(view_prefix("check/js/bystore.js"));
  $this->page_control_data->add_css(view_prefix("check/css/bystore.css"));
  $this->load->view('check/views/datehdrdiv',array("SD"=>$SD, "FD"=>$FD, "OFFSET"=>$OFFSET));
?>  
<table ID="SUMALL">
<?php foreach ($LIST as $kshop=>$oneshp): ?>
  <tbody id="S<?=$kshop?>" class="S" onclick="selfhide(this, 'F<?=$kshop?>')">
    <tr>
      <td class="COL1">
        <?=$oneshp["N"]?>
      </td>
      <td>
        <?=$oneshp["S"]?>
      </td>
    </tr>    
  </tbody>
  <tbody id="F<?=$kshop?>" class="F" onclick="selfhide(this, 'S<?=$kshop?>')" hidden>
  <tr>
    <td colspan="2" class="HCOL">
      <?=$oneshp["N"]?>
    </td>
  </tr>
  <?php foreach ($oneshp["MN"] as $kdat=>$csum): ?>  
  <tr>
    <td class="COL1">
      <?=$kdat?>
    </td>
    <td>
      <?=$csum?>
    </td>
  </tr>
  <?php endforeach; ?>  
  </tbody>
<?php endforeach; ?>  
</table>