<?php

/* 
 * oneshop.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 01.08.2018 Версия 1
 *
 * Полное описание файла
 */
  $this->page_control_data->TITLE = "Ввод кассы";
  $this->page_control_data->add_css(view_prefix("check/css/chktable.css"));
  $this->page_control_data->add_css(view_prefix("check/css/oneshop.css"));
?>
<form action="../saveshop/<?=$ID?>/1" method="POST">
<table class="chktable">
  <tr>
    <th colspan="2">
      <?=$ID?>
    </th>
  </tr>
    <td>
      Общее
    </td>
    <td>
      <input type="text" value="<?=$COMMON?>" name="COMMON">
    </td>
  <tr>
  </tr>
  <tr>
    <td>
      Частное
    </td>
    <td>
      <input type="text" value="<?=$NAME?>" name="NAME">
    </td>
  </tr>
  <tr>
    <td id="BUTTSAVTD" colspan="2">
      <button type="submit">
        Готово
      </button>
    </td>
  </tr>
</table>
</form>
