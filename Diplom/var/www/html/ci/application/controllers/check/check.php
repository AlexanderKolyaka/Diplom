<?php
require_once APPPATH.'core/main_controller.php';
/**
 * check.php - Краткое описание 
 *
 * Copyright 2018 ymenshov.
 * 27.07.2018 Версия 1
 *
 * Полное описание файла
 * @property Check_Model $chk_model Модель работы с чеками
 */
class Check extends Main_Controller
{
  const OTHER_MAG = -99999998;
  const OTHER_MAG_NAME = "Прочие расходы";
//***********************************
//  P U B L I C
//***********************************
  public function __construct() 
  {
    parent::__construct();
    $this->load->model("check/check_model", "chk_model");
  }
  
  /**
   * Основное меню
   */
  public function index()
  {
    $this->load->view('check/views/index');
    return self::OUTPUT_MIN;
  }

  /**
   * Страница ввода строки из QR кода
   */
  public function checkin()
  {
    $this->load->view('check/views/checkin');
  }
  
  /**
   * Страница корректировки чека
   */
  public function checktst()
  {
    $chk_date = $this->input->get("t");
    if ($chk_date === FALSE)
    {
      $chk_date = new DateTime;
    }
    else
    {
      $chk_date = mb_substr(filter_var($chk_date,FILTER_SANITIZE_SPECIAL_CHARS),0,13);
      $chk_date = DateTime::createFromFormat("Ymd\THi",$chk_date);
    }
    $chk_sum = $this->input->get('s');
    if ($chk_sum === FALSE)
    {
      $chk_sum = 0;
    }
    else
    {
      $chk_sum = is_numeric(filter_var($chk_sum, FILTER_SANITIZE_SPECIAL_CHARS))? $chk_sum : 0;
    }    
    $chk_fnid = $this->input->get('fn');
    if ($chk_fnid === FALSE)
    {
      $chk_fnid = 0;
    }
    else 
    {
      $chk_fnid = filter_var($chk_fnid, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    $chk_nchk = $this->input->get('i');
    if ($chk_nchk === FALSE)
    {
      $chk_nchk = 0;
    }
    else 
    {
      $chk_nchk = filter_var($chk_nchk, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    $a["DT"] = $chk_date;
    $a["S"]  = $chk_sum;
    $a["FN"] = $chk_fnid;
    $a["I"]= $chk_nchk;
    $a["OLDC"] = $this->chk_model->getcheck($a["FN"], $a["I"]);
    $this->load->view('check/views/checktst', $a);
  }
  
  /**
   * Список чеков за период
   */
  public function chklist()
  {
    $a = $this->check_list_post_param();
    $a["LIST"] = $this->chk_model->chklist($a["SD"], $a["FD"]);
    $this->load->view('check/views/chklist', $a);    
  }

  /**
   * Список магазинов
   */
  public function shplist()
  {
    $a["LIST"] = $this->chk_model->shplist();
    $this->load->view('check/views/shplist', $a);    
  }
  
  /**
   * Редактирование одного магазина (ККМ - кассового аппарата)
   * @param int $ID - идентификатор ККМ
   */
  public function oneshop($ID = NULL)
  {
    if (is_null($ID) || !is_numeric($ID))
    {
      redirect('check/check/shplist');
    }
    else
    {
      $z = $this->chk_model->oneshop($ID);
      $a["ID"] = $ID;
      if (count($z)>0)
      {
        $a["NAME"] = $z["name_rec"];
        $a["COMMON"] = $z["common_name"];
      }
      else
      {
        $a["NAME"] = "";
        $a["COMMON"] = "";
      }
      $this->load->view('check/views/oneshop', $a);
    }
  }
  
  /**
   * Отчёт по магазинам за определёный период
   */
  public function bystore()
  {
    $a = $this->check_list_post_param();
    $a["LIST"] = $this->chk_model->chklist_bystore($a["SD"], $a["FD"]);
    $this->load->view('check/views/bystore', $a);    
  }
  
  /**
   * Ручной ввод суммы
   */
  public function handmade()
  {
    $this->load->view('check/views/handmade');
  }

  /**
   * Сохранение корректированных данных и переход на ввод
   */
  public function savcheck()
  {
    $sv["t"] = $this->input->post("DT");
    $sv["i"] = $this->input->post("I");
    $sv["s"] = $this->input->post("S") * 100;
    $sv["fn"]= $this->input->post("FN");
    $this->chk_model->savecheck($sv);
    redirect('check/check/checkin');
  }
  
  public function scanmag()
  {
    $part = $this->input->get("term");    
    $a["ASCAN"]= $this->chk_model->scanmag($part);
    $this->load->view('check/views/scanmag',$a);
    return self::OUTPUT_NONE;
  }

    /**
   * Сохранение отредактированного магазина
   * @param int $ID - идентификатор магазина
   * @return type
   */
  public function saveshop($ID = NULL)
  {
    $nr = $this->input->post("NAME");
    $cn = $this->input->post("COMMON");
    do 
    {
      if (is_null($ID))
      {
        break;
      }
      if (empty($nr) && empty($cn))
      {
        break;
      }
      $this->chk_model->saveshop($ID, $nr, $cn);
    } while (FALSE);
    redirect('check/check/shplist');
    return self::OUTPUT_NONE;
  }
  
  public function savehand($forced = NULL)
  {
    $msg  = "Неопознанная ошибка сохранениния чека";
    $dat = $this->input->post("DAT");
    $mag = $this->input->post("MAG");
    $sum = $this->input->post("SUM");
    $magID = $this->input->post("MID");
    $magSEL = $this->input->post("MSEL");
    $savforced = FALSE;
    $view_params = array();
    $view_params["DAT"] = $dat;
    $view_params["MAG"] = $mag;
    $view_params["SUM"] = $sum;
    $view_params["MID"] = $magID;
    $view_params["MSEL"] = $magSEL;
    $view_params["NOERR"] = FALSE;
    do 
    {
      if (($dat === FALSE) ||
          ($mag === FALSE) ||
          ($sum === FALSE) ||
          ($magID === FALSE) ||
          ($magSEL === FALSE))
      {
        $msg = "Параметры неправильные. Повторите ввод.";
        break;
      }
      if (!is_numeric($sum))
      {
        $msg = "Параметр сумма неправильный. Повторите ввод.";
        break;
      }
      if ($sum == 0)
      {
        $msg = "Нет смысла сохранять 0 руб. Чек не сохранён.";
        break;        
      }
      $sum = $sum * 100;
      if (!is_null($forced) && is_numeric($forced) && $forced == 1)
      {
        $savforced = TRUE;
      }
      if (empty($mag)) // Прочие
      {
        $magID = self::OTHER_MAG;
        $mag = self::OTHER_MAG_NAME;
      }
      else
      {
        if ($magSEL !== $mag) // Новый 
        {
          $magID = BAD_VALUE;
        } // else - всё нормально - выбран существующий
      }
      $rezsav = $this->chk_model->savehandcheck($magID, $mag, $sum, $dat, $savforced);
      $view_params["REZSV"] = $rezsav;
      $view_params["FORCE"] = $savforced;
      $view_params["NOERR"] = TRUE;
      $msg = "Сохранено";
    } while (FALSE);
    $view_params["MSG"] = $msg;
    $this->load->view('check/views/savehand',$view_params);
    return;
  }

  //******************
  //  P R I V A T E
  //******************
  
  /**
   * Проверка параметров переданных через POST параметры и возвращение их в виде массива
   * @return array - Содержит 3 элемента 
   * ["SD"] = начальная дата периода
   * ["FD"] = конечная дата периода
   * ["OFFSET"] = длина периода в месяцах, например 6
   */
  private function check_list_post_param()
  {
    $rc = array();
    $sd = $this->input->post("SD");
    $fd = $this->input->post("FD");
    $ofs_module = $this->input->post("DIFF");
    $ofs_sign   = $this->input->post("OFFSET");
    if (($sd === FALSE)||($ofs_module === FALSE)||($ofs_sign === FALSE)||($fd === FALSE))
    {
      $frd = new DateTime();
      $frd->modify("midnight first day of this month");
      $tod = new DateTime();
      $tod->modify("midnight first day of next month");
      $offset = 1;
    }
    else
    {
      $offset = $ofs_module * $ofs_sign;
      if ($offset<0)
      {
        $tod = new DateTime($sd);
        $frd = clone $tod;
        $frd->sub(new DateInterval("P".(-$offset)."M"));
      }
      else
      {
        $frd = new DateTime($fd);
        $tod = clone $frd;
        $tod->add(new DateInterval("P".$offset."M"));
      }
    }
    $tod->sub(new DateInterval("PT1S"));
    $rc["SD"] = $frd;
    $rc["FD"] = $tod;
    $rc["OFFSET"] = $offset < 0 ? -$offset : $offset;
    return $rc;
  }
}