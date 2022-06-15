<?php
/* 
 * main_controller.php - Класс CI_Controller улучшенный под конкретную задачу
 *
 * Copyright 2018 ymenshov.
 * 01.08.2018 Версия 1
 *
 * Класс CI_Controller улучшенный под конкретную задачу. 
 * Модифицирован для возможности в методе контроллера написать:
 *   return тип-вывода; 
 * Где тип вывода - одна из констант управления выводом.
 * В данном классе реализованы 3 типа вывода:
 * а) OUTPUT_NONE - только stdout
 * б) OUTPUT_MIN - упрощённая страница
 * в) OUTPUT_FULL - полная страница
 * Возможно добавление типов вывода. Для этого нужно:
 * 1) Унаследоваться от этого класса
 * 2) Описать доп. константу, например OUTPUT_SPECIAL = 5
 * 3) В конструкторе после вызова родительского конструктора написать:
 *    $this->out_control_view[self::OUTPUT_SPECIAL] =array("head"=>"файл-заголовочной-части","foot"=>"файл-нижней-части");
 * 4) файлы-вьюхи заголовка и подвала должны распологаться в application/views/core/main_controller/
 * 5) в методах контроллера можно будет писать:
 *    return self::OUTPUT_SPECIAL;
 * 6) Можно переопределить вывод по умолчанию вместо OUTPUT_FULL переопределив константу OUTPUT_DEFAULT. Например так:
 *    const OUTPUT_DEFAILT = self::OUTPUT_SPECAL;
 */
require_once 'constants.php';
require_once 'page_control_data.php';

class Main_Controller extends CI_Controller
{
//*****************
//  P U B L I C 
//*****************

  const HEADERS_PATH = "core/main_controller/";
  // Константы для управления выводом 
  /**
   * Управление выводом: никаких заголовков не выводить. Пример: JSON
   */
  const OUTPUT_NONE = 0;
  /**
   * Управление выводом: выводить html, head, body и всё. Пример: содержимое iframe.
   */  
  const OUTPUT_MIN  = 1;
  /**
   * Управление выводом: выводить всё оформление страницы.
   */    
  const OUTPUT_FULL = 2;
  
  /**
   * Режим вывода по умолчанию
   */
  const OUTPUT_DEFAILT = self::OUTPUT_FULL;

  /**
   * @var int Управление выводом - может принимать только значения констант OUTPUT_xxx
   */
  public $output_control;
  
  /**
   * @var Page_Control_Data класс для накопления нужных данных для вывода 
   */
  public $page_control_data;

  public function __construct() 
  {
    parent::__construct();
    $this->output_control = self::OUTPUT_FULL;  // Обычный вывод
    // Инициализация массива константами для управления выводом
    $this->out_control_view = array();
    $this->out_control_view[self::OUTPUT_NONE] =array("head"=>"none_head","foot"=>"none_foot");
    $this->out_control_view[self::OUTPUT_MIN ] =array("head"=>"min_head" ,"foot"=>"min_foot");
    $this->out_control_view[self::OUTPUT_FULL] =array("head"=>"full_head","foot"=>"full_foot");
    $this->page_control_data = new Page_Control_Data();
  }
  
  /**
   * Доопределение обработчика, чтобы отлавливать возвращаемое значение методом контроллера
   * @param string $method - имя метода
   * @param array $params - параметры
   * @return NULL
   */
  public function _remap($method, $params = array())
  {
    $s404 = TRUE; // Допустим вызывать нечего
    if (method_exists($this, $method)) // Есть такой метод?
    {
      $tcls = new ReflectionClass($this);
      $met_data = $tcls->getMethod($method);  // Взять параметры метода
      if ($met_data->isPublic())              // Можно вызвать если он PUBLIC иначе - нет
      {
        $s404 = FALSE;
        $rz = call_user_func_array(array($this, $method), $params);
        $this->output_control = $this->check_result_call($rz, static::OUTPUT_DEFAILT);  // Либо результат контроллера
        // Либо значение установленное в show_override (если установлено) - больший приоритет 
        $this->output_control = $this->check_result_call($this->page_control_data->show_override, $this->output_control);
      } // Иначе ничего не вызывать - и вывалится 404
    } // Нет метода - ничего не делать и 404!
    if ($s404)
    {
      show_404(); // Вообще вызывает exit по-простому
    }
    return;  // CodeIgniter не интересует, что возвращено функцией
  }

  /**
   * Доопределение метода вывода, чтобы выводить "красиво"
   * @param string $outstr - ранее выведенный stdout
   */
  public function _output($outstr)
  {
    $header = $this->load->view(self::HEADERS_PATH.$this->out_control_view[$this->output_control]["head"],NULL,TRUE);
    $footer = $this->load->view(self::HEADERS_PATH.$this->out_control_view[$this->output_control]["foot"],NULL,TRUE);
    echo $header.$outstr.$footer;
  }

//*****************
//  PROTECTED
//*****************

  /**
   * @var array Массив вьюх для отображения 
   */
  protected $out_control_view;
  
//*****************
//  P R I V A T E
//*****************
  
  /**
   * Проверка результата выполнения метода контроллера на допустимость 
   * @param int $result_call - проверяемое значение
   * @param int $default_val - значение которое нужно присвоить в случае недопустимого значения
   * @return int - правильное значение
   */
  private function check_result_call($result_call, $default_val)
  {
    $rc = $default_val;
    if (!is_null($result_call))
    {
      if (in_array($result_call, array_keys($this->out_control_view)))  // Результат выполнения метода контроллера допустим?
      {
        $rc = $result_call;
      }
    }
    return $rc;
  }
}