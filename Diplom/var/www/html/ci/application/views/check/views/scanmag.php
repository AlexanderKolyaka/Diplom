<?php

/* 
 * scanmag.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 10.08.2018 Версия 1
 *
 * Полное описание файла
 */
$sendto = array();
foreach ($ASCAN as $v)
{
  $a = array("id"=>$v["id"], 
         "label"=>trim($v["common_name"]." ".$v["name_rec"]), 
         "value"=>trim($v["common_name"]." ".$v["name_rec"]));
  $sendto[] = $a;
}
echo json_encode($sendto);