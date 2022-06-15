<?php

/* 
 * index.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 27.07.2018 Версия 1
 *
 * Полное описание файла
 */
  $this->page_control_data->TITLE = "Ввод с чека";
  $this->page_control_data->add_css(view_prefix("check/css/index.css"));
?>

<table id="MMN">
  <tr>
    <td id="P1">
      <a href="check/checkin">Ввод чека QR</a>
    </td>
    <td id="P2">
      <a href="check/chklist">Список</a>
    </td>
  </tr>
  <tr>
    <td id="P3">
      <a href="check/shplist">Магазины</a>
    </td>
    <td id="P4">
      <a href="check/bystore">По магазинам</a>
    </td>
  </tr>
  <tr>
    <td id="P5">
      <a href="check/handmade">Ввод вручную</a>
    </td>
    <td id="P6">
      <a href="#"></a>
    </td>
  </tr>
</table>
