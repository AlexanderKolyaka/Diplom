<?php
  $cap = "Новый чек";
  $o_t = "&nbsp";
  $o_s = "&nbsp";
  $o_fn= "&nbsp";
  $o_i = "&nbsp";
  if (count($OLDC)>0)
  {
    $cap = "Исправление чека";
    $o_t = $OLDC["t"]->format("Y-m-d H:i");
    $o_s = $OLDC["s"];
    $o_fn= $OLDC["fn"];
    $o_i = $OLDC["i"];
    if (($OLDC["t"] == $DT) &&
        ($o_s == $S) &&
        ($o_fn == $FN) &&
        ($o_i == $I))
    {
      $cap .= " (нет различий)";
    }
    $o_fn = is_null($OLDC["name_rec"]) ? $o_fn : $OLDC["name_rec"];
  }
?>
<form action="savcheck" method="POST" id="FORMTABSV">
  <table>
    <caption>
      <?=$cap?>
    </caption>
    <tr>
      <td>
        &nbsp;
      </td>
      <td>
        &nbsp;
      </td>
      <th>
        Было
      </th>
    </tr>
    <tr>
      <th>
        Дата:
      </th>
      <td>
        <input type="datetime-local" value="<?=$DT->format("Y-m-d\TH:i")?>" name="DT">
      </td>
      <td>
        <?=$o_t?>
      </td>
    </tr>
    <tr>
      <th>
        Сумма:
      </th>
      <td>
        <input type="text" value="<?=$S?>" name="S">
      </td>
      <td>
        <?=$o_s?>
      </td>
    </tr>
    <tr>
      <th>
        ИД кассы:
      </th>
      <td>
        <?php if (empty($FN)): ?>
        <input type="text" value="<?=$FN?>" name="FN">
        <?php else: ?>
        <?=$FN?>
        <input type="hidden" value="<?=$FN?>" name="FN">
        <?php endif; ?>
      </td>
      <td>
        <?=$o_fn?>
      </td>
    </tr>
    <tr>
      <th>
        Чек:
      </th>
      <td>
        <input type="text" value="<?=$I?>" name="I">
      </td>
      <td>
        <?=$o_i?>
      </td>
    </tr>
  </table>
  <button type="submit">
    Сохранить чек
  </button>
</form>