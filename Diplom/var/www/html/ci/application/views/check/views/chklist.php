<?php

/* 
 * chklist.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 31.07.2018 Версия 1
 *
 * Полное описание файла
 */
  $this->page_control_data->add_css(view_prefix("check/css/chktable.css"));
  $this->page_control_data->add_css(view_prefix("check/css/chklist.css"));
  $oldmon = "***";
  $hdrout = FALSE;
  $sum = 0;
  
  function finbody($s)
  {  
?>
  <tr>
    <td colspan="4">
      Итого <strong><?=$s?></strong> руб
    </td>
  </tr>
 </table>
<?php 
  }; 
    $this->load->view('check/views/datehdrdiv',array("SD"=>$SD, "FD"=>$FD));
?>
 
<?php foreach ($LIST as $onechk): ?>
  <?php 
    $z = $onechk["t"]->format("Ym"); 
    $td2 = empty($onechk["name_rec"]) ? "" : $onechk["name_rec"];
    if (empty($onechk["common_name"]))
    {
      if (empty($onechk["name_rec"]))
      {
        $td1 = "(".$onechk["fn"].")";
      }
      else
      {
        $td1 = $onechk["name_rec"];
        $td2 = "";
      }
    }
    else
    {
      $td1 = $onechk["common_name"];
    }
  ?>
  <?php if ($oldmon != $z): ?>
    <?php if ($hdrout)
    {
      finbody($sum);
      $sum = 0;
    }
    ?>
<table class="chktable">
  <caption>
    Месяц <?=$onechk["t"]->format("m")?> год <?=$onechk["t"]->format("Y")?>
  </caption>
     <tbody>
    <?php 
      $oldmon = $z;
      $hdrout = TRUE;
    ?>
  <tr>
    <th>
      Дата время
    </th>
    <th>
      Сумма (р) 
    </th>
    <th>
      Магазин
    </th>
    <th>
      Прочее
    </th>
  </tr>
  <?php endif;?>
  <tr>
    <td>
      <?=$onechk["t"]->format("d.m.y H:i")?>
    </td>
    <td>
      <?=$onechk["s"]?>
      <?php $sum += $onechk["s"]; ?>
    </td>
    <td>
      <?=$td1?>
    </td>
    <td>
      <?=$td2?>
    </td>
  </tr>    
<?php endforeach;?>
    <?php if ($hdrout)
    {
      finbody($sum);
    }
    ?>
