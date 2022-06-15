<?php

/* 
 * shplist.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 31.07.2018 Версия 1
 *
 * Полное описание файла
 */
  $this->page_control_data->add_css(view_prefix("check/css/chktable.css"));
?>
<table id="SHPLST" class="chktable">
  <tr>
    <th>
      ID
    </th>
    <th>
      Название
    </th>
    <th>
      &nbsp;
    </th>
  </tr>
<?php foreach ($LIST as $oneshp): ?>
  <tr>
    <td>
      <a href="oneshop/<?=$oneshp["fn"]?>"><?=$oneshp["fn"]?></a>
    </td>
    <td>
      <a href="oneshop/<?=$oneshp["fn"]?>"><?=$oneshp["common_nam"]?></a>      
    </td>
    <td>
      <a href="oneshop/<?=$oneshp["fn"]?>"><?=$oneshp["name_rec"]?></a>
    </td>
  </tr>
<?php endforeach;?>      
</table>