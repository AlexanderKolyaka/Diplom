/* 
 * bystore.js - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 08.08.2018 Версия 1
 *
 * Полное описание файла
 */
function selfhide(obj, IDshow)
{
  obj.setAttribute("hidden", "hidden");
  document.getElementById(IDshow).removeAttribute("hidden");
}

