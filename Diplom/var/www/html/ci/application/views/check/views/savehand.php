<?php
/* 
 * savehand.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 17.08.2018 Версия 1
 *
 * Полное описание файла
 * 
    $view_params["DAT"] = $dat;
    $view_params["MAG"] = $mag;
    $view_params["SUM"] = $sum;
    $view_params["MID"] = $magID;
    $view_params["MSEL"] = $magSEL;
    $view_params["NOERR"] = FALSE;
    $view_params["REZSV"] = $rezsav;
    $view_params["FORCE"] = $savforced;*/ 
  $this->page_control_data->TITLE = $REZSV < 0 ?
          "Подтвердите":
          "Сохранено";
  $this->page_control_data->add_css(view_prefix("check/css/savehand.css"));  
?>
<article id="ACK">
<?php if($REZSV < 0): ?>
<form action="savehand/1" method="POST">
  <input type="hidden" name="DAT" value="<?=$DAT?>">
  <input type="hidden" name="MAG" value="<?=$MAG?>">
  <input type="hidden" name="MID" value="<?=$MID?>">
  <input type="hidden" name="MSEL" value="<?=$MSEL?>">
  <input type="hidden" name="SUM" value="<?=$SUM?>">
  <p>
  Чек <?=$MAG?> от <?=$DAT?> на сумму <?=$SUM?> уже существует.
  </p>
  <button type="submit">
    Всё равно записать
  </button>
  <button type="button" onclick="window.history.back()">
    Повторно ввести
  </button>  
</form>
<?php else: ?>
<p>
Чек <?=$MAG?> от <?=$DAT?> на сумму <?=$SUM?> записан успешно.  
</p>
<?php endif; ?>  
</article>
