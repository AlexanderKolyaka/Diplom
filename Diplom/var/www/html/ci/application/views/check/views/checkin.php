<?php

/* 
 * checkin.php - 
 *
 * Copyright 2018 ymenshov.
 * 27.07.2018 Версия 1
 *
 * Полное описание файла
 */
  $this->page_control_data->TITLE = "Ввод с чека";
  $this->page_control_data->add_js(view_prefix("check/js/checkin.js"));
  $this->page_control_data->add_css(view_prefix("check/css/checkin.css"));
?>
<div id="CHKDIV">
  <input type="text" id="ITS">
  <button type="button" onclick="runcheckin('ITS', 'checktst')">
    Послать
  </button>  
</div>
