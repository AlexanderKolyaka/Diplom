<?php
/* 
 * datehdrdiv.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 08.08.2018 Версия 1
 *
 * Форма для выбора периода, при изменении даты вызывает ту же страницу, с параметрами POST:
 * SD - начальная дата 
 * FD - конечная дата
 * DIFF - количество месяцев смещения
 * OFFSET - направление смещения +-1
 * Входные параметры:
 * $SD - начальная дата DateTime
 * $FD - конечная дата DateTime
 * $OFFSET - количество месяцев смещения
 */
  $this->page_control_data->add_css(view_prefix("check/css/datehdrdiv.css"));
  $FD2 = clone $FD;
  $FD2->add(new DateInterval("PT1S"));
?>
<form method='POST' id="MNH">
  <input type="hidden" value="<?=$FD2->format(DateTime::ATOM)?>" name="FD">    
  Список за период c <input type="date" value="<?=$SD->format("Y-m-d")?>" name="SD"> длиной 
  <select name="DIFF">
    <?php for($i=1;$i<13;$i++): ?>
    <option <?=($i==$OFFSET ? "selected": "")?> value="<?=$i?>"><?=$i?></option>
    <?php endfor;?>
  </select>
  месяцев.
  <table>
  <tr>
    <td>
      <button value="-1" name="OFFSET" type="submit">
       <<
      </button>
    </td>
    <td>
  <button value="1" name="OFFSET" type="submit" onclick="FD.value=SD.value">
    Применить период
  </button>            
    </td>
    <td>
      <button value="1" name="OFFSET" type="submit">
        >>
      </button>        
    </td>
  </tr>
  </table>    
</form>