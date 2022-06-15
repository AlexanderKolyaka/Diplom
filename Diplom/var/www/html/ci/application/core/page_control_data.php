<?php
/* 
 * page_control_data.php - Управление выводом страницы
 *
 * Copyright 2018 ymenshov.
 * 02.08.2018 Версия 1
 *
 */

/**
 * Класс управляющий выводом страницы, накопление нужных значений для заголовков/подвалов
 * @property-read array $CSS Список подключаемых CSS
 * @property-read arraj $JS  Список подключаемых JS
 */
class Page_Control_Data
{
//*****************
//  P U B L I C 
//*****************
  /**
   * @var string Название страницы
   */
  public $TITLE;
  
  /**
   * переменная для указания типа вывода, для возможности перекрытия кода возврата метода контроллера, имеет больший
   * приоритет чем в контроллере return значение; 
   * Должно принимать значения Main_Controller::OUTPUT_xxx или наследников. 
   * Если значение = NULL, то берётся значение которое вернул контроллер.
   * @var int 
   */
  public $show_override;

  public function __construct()
  {
    $this->css_array = array();
    $this->js_array = array();
    $this->title = "";
    $this->show_override = NULL;
  }
  
  /**
   * Добавить CSS в список
   * @param string $css - имя CSS
   * @param boolean $to_top - TRUE - значение добавляется в начало списка, иначе - в конец
   * @return NULL
   */
  public function add_css($css, $to_top = FALSE)
  {
    $this->add_into_array("css_array", $css, $to_top);
    return;
  }
  
  /**
   * Добавить JS в список
   * @param string $js - имя JS
   * @param boolean $to_top - TRUE - значение добавляется в начало списка, иначе - в конец
   * @return NULL
   */
  public function add_js($js, $to_top = FALSE)
  {
    $this->add_into_array("js_array", $js, $to_top);
    return;
  }
  
  public function __get($name)
  {
    $rc = NULL;
    switch ($name)
    {
      case "CSS":
        $rc = $this->css_array;
        break;
      case "JS":
        $rc = $this->js_array;
        break;
      default:
        show_error(get_class($this).":: Обращение к несуществующему свойству класса [".$name."]");
        break;
    }
    return $rc;
  }

//*********************
//  P R O T E C T E D
//*********************

  /**
   * @var array Массив CSS
   */
  protected $css_array;
  
  /**
   * @var array Массив JS 
   */
  protected $js_array;
  
//*********************
//  P R I V A T E
//*********************
  private function add_into_array($arr_name,$value, $to_top)
  {
    
    if (!in_array($value, $this->$arr_name))
    {
      if ($to_top)
      {
        array_unshift($this->$arr_name, $value);
      }
      else
      {
        $this->$arr_name[] = $value;
      }
    }
    return;
  }
}