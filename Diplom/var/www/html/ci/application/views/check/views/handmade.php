<?php

/* 
 * handmade.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 10.08.2018 Версия 1
 *
 * Полное описание файла
 */
  $this->page_control_data->TITLE = "Ручной ввод текста";
  $this->page_control_data->add_css(view_prefix("check/css/chktable.css"));
  $this->page_control_data->add_css(view_prefix("check/css/handmade.css"));
  $this->page_control_data->add_js (view_prefix("js/jquery-ui-1.12.1/external/jquery/jquery.js"));
  $this->page_control_data->add_js (view_prefix("js/jquery-ui-1.12.1/jquery-ui.js"));
  $this->page_control_data->add_css(view_prefix("js/jquery-ui-1.12.1/jquery-ui.css"));
  $this->page_control_data->add_css(view_prefix("js/jquery-ui-1.12.1/jquery-ui.theme.css"));
  $this->page_control_data->add_js (view_prefix("check/js/handmade.js"));
  $nowdate = new DateTime();
?>
<form method="POST" action="savehand">
  <table class="chktable">
  <caption>
    Ручной ввод
  </caption>
  <tr>
    <th>
      Дата
    </th>
    <td>
      <input type="date" value="<?=$nowdate->format("Y-m-d")?>" name="DAT">
    </td>
  </tr>
  <tr>
    <th>
      Сумма руб
    </th>
    <td>
      <input type="number" value="0" step="0.01" name="SUM">
    </td>
  </tr>
  <tr>
    <th>
      Магазин
    </th>
    <td>
      <input type="text" value="" name="MAG" id="MAG">
    </td>
  </tr>
  </table>
  <div id="SVD">
    <input type="hidden" value="<?=BAD_VALUE;?>" name="MID" id="MID">
    <input type="hidden" value="" name="MSEL" id="MSEL">
    <button type="submit">
      Сохранить
    </button>
  </div>
</form>