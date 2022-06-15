<?php

/* 
 * full_head.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 02.08.2018 Версия 1
 *
 * Полное описание файла
 */
  $this->page_control_data->add_css(view_prefix("core/main_controller/css/full.css"), TRUE);
  $css_list = $this->page_control_data->CSS;
  $js_list  = $this->page_control_data->JS;
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?=$this->page_control_data->TITLE?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=350, initial-scale=1">
    <?php foreach ($css_list as $onecss): ?>
    <link rel="stylesheet" type="text/css" href="<?=$onecss?>">
    <?php endforeach;?>
    <?php foreach ($js_list as $onejs): ?>
    <script src="<?=$onejs?>"></script>
    <?php endforeach;?>
  </head>
  <body>
