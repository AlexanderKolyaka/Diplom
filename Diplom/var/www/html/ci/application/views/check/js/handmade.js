/* 
 * handmade.js - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 10.08.2018 Версия 1
 *
 * Полное описание файла
 */

$( function() 
{
  $( "#MAG" ).autocomplete({
    source: "scanmag",
    minLength: 2,
    select: function( event, ui ) {
      $("#MID").val(ui.item.id);
      $("#MSEL").val(ui.item.value);
    }
  });
} );
