<?php

/* 
 * MY_url_helper.php - Ещё более нужные функции для работы со ссылками
 *
 * Copyright 2018 ymenshov.
 * 31.07.2018 Версия 1
 *
 * Полное описание файла
 */

if ( ! function_exists('view_prefix'))
{
  
/**
 * Добавление пути к файлам вью/js/css
 * @param string $endpathto - файл с путём к которому нужно добавить путь, 
 * обычно добавляемый путь - это application/views
 * @return string - готовая строка.
 * @version 2
 */  
function view_prefix($endpathto)
{
  return base_url().APPPATH."views/".$endpathto;
}

}
