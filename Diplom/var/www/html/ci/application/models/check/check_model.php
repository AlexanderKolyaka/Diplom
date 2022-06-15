<?php

/* 
 * check_model.php - Модель работы с чеками
 *
 * Copyright 2018 ymenshov.
 * 27.07.2018 Версия 1
 *
 * Полное описание файла
 */
class Check_Model extends CI_Model
{
  public function __construct() 
  {
    parent::__construct();
  }
  
  /**
   * Взять чек и его поля
   * @param int $kkm
   * @param int $chkID
   * @return array
   */
  public function getcheck($kkm, $chkID)
  {
    $rc = array();
    $q = $this->db->query(
            "SELECT 
               c.*, 
               s.name_rec,
               s.common_name
             FROM checkdata c
             LEFT JOIN shoplist s ON c.fn = s.id
             WHERE c.fn=? AND c.i=?",
            array($kkm,$chkID));
    if ($q->num_rows()>0)
    {
      $r1 = $q->result_array();
      $rc = $r1[0];
      $rc["t"] = new DateTime($rc["t"]);
      $rc["s"] = $rc["s"]/100;
    }
    return $rc;
  }
  
  /**
   * Сохранение чека
   * @param array $arsv - массив значений полей
   * @return NULL
   */
  public function savecheck($arsv)
  {
    $q = $this->db->query("SELECT count(*) AS nz FROM checkdata WHERE fn=? AND i=?", array($arsv["fn"],$arsv["i"]));
    $rz = $q->result();
    if ($rz[0]->nz == 0)  // Если новая запись
    {
      $sql = "INSERT INTO checkdata (s,t,fn,i) VALUES (?,?,?,?)";
    }
    else 
    {
      $sql = "UPDATE checkdata SET s=?, t=? WHERE fn=? AND i=?";
    }
    $q = $this->db->query($sql,array($arsv["s"],$arsv["t"],$arsv["fn"],$arsv["i"]));
    return;
  }
  
  /**
   * Выбрать платежи между датами
   * @param DateTime $fromdate - с какой даты начать
   * @param DateTime $todate - до какой даты
   * @return array - строки
   */
  public function chklist($fromdate,$todate)
  {    
    $q = $this->db->query(
      "SELECT * 
      FROM checkdata c
      LEFT JOIN shoplist s ON c.fn = s.id
      WHERE t BETWEEN ? AND ?
      ORDER BY t",
      array($fromdate->format(DateTime::ATOM),$todate->format(DateTime::ATOM))
            );
    $rc = $q->result_array();
    foreach ($rc as $k=>$v) // Доработка выборки 
    {
      $rc[$k]["s"] = $v["s"]/100.0;
      $rc[$k]["t"] = new DateTime($v["t"]);
    }
    return $rc;
  }

  /**
   * Список платежей с группировкой по магазинам
   * @param DateTime $fromdate - с какой даты начать
   * @param DateTime $todate - до какой даты
   * @return array - строки
   */
  public function chklist_bystore($fromdate,$todate)
  {
    $q = $this->db->query(
      "SELECT 
        SUM(s) AS summon, 
        EXTRACT(YEAR FROM t)*100 + EXTRACT(MONTH FROM t) as dtm, 
        CASE
        WHEN COALESCE(s.common_name,'') = '' AND s.name_rec = '' THEN
          cast(fn AS char(100))
        ELSE
          CASE 
          WHEN COALESCE(s.common_name,'') = '' THEN s.name_rec
          ELSE 
            CASE
            WHEN s.name_rec = '' THEN
              s.common_name
            ELSE
              concat(s.common_name,' (',s.name_rec,')')
            END
          END
        END as shp
      FROM testdb.checkdata c
      LEFT JOIN testdb.shoplist s ON c.fn = s.id
      WHERE t BETWEEN ? AND ?
      GROUP BY 
        EXTRACT(YEAR FROM t)*100 + EXTRACT(MONTH FROM t), 
        CASE
        WHEN COALESCE(s.common_name,'') = '' AND s.name_rec = '' THEN
          cast(fn AS char(100))
        ELSE
          CASE 
          WHEN COALESCE(s.common_name,'') = '' THEN s.name_rec
          ELSE 
            CASE
            WHEN s.name_rec = '' THEN
              s.common_name
            ELSE
              concat(s.common_name,' (',s.name_rec,')')
            END
          END
        END
      ORDER BY shp, dtm",
        array($fromdate->format(DateTime::ATOM),$todate->format(DateTime::ATOM))
      );
    $rez = $q->result_array();
    $rc = array();
    $kz = NULL;
    $sumsum = 0;
    $detalshp=array();
    $namshp = "";
    foreach ($rez as $k=>$v)
    {
      $nkz = crc32($v["shp"]);
      if (is_null($kz))
      {
        $kz = $nkz;
        $rc[$kz] = array();
      }
      if ($kz !== $nkz)
      {
        $rc[$kz] = array("S"=>$sumsum, "N"=>$namshp, "MN"=>$detalshp);
        $kz = $nkz;
        $sumsum = 0;
        $detalshp=array();
      }
      $namshp = $v["shp"];
      $sumsum += $v["summon"]/100.0;
      $x = DateTime::createFromFormat("Ym", $v["dtm"]);
      $detalshp[$x->format("m.y")] = $v["summon"]/100.0;
    }
    if (!is_null($kz))
    {
      $rc[$kz] = array("S"=>$sumsum, "N"=>$namshp, "MN"=>$detalshp);
    }
    return $rc;
  }

  
  /**
   * Список магазинов (кассовых аппаратов)
   * @return array
   */
  public function shplist()
  {
    $q = $this->db->query(
      "SELECT DISTINCT c.fn,s.name_rec, COALESCE(s.common_name,'') as common_nam
      FROM checkdata c
      LEFT JOIN shoplist s ON c.fn = s.id
      ORDER BY c.fn"
            );
    $rc = $q->result_array();
    return $rc;
  }
  
  public function saveshop($ID,$nameshop, $common_name)
  {
    $q = $this->db->query("SELECT COUNT(*) as nsh FROM shoplist WHERE id = ?",
         array($ID));
    $r = $q->result();
    $sql = $r[0]->nsh == 0 ?
           "INSERT INTO shoplist (name_rec,common_name, id) VALUES (?,?,?)" :
           "UPDATE shoplist SET name_rec=?, common_name=? WHERE id=?";
    $q = $this->db->query($sql,array($nameshop,$common_name, $ID));
    return;
  }
  
  public function oneshop($ID)
  {
    $rc = array();
    $q = $this->db->query("SELECT * FROM shoplist WHERE id=?",
      array($ID));
    if ($q->num_rows() > 0)
    {
      $r = $q->result_array();  // всегда одна или 0 записей - выборка по ключу
      $rc = $r[0];
    }
    return $rc;
  }
  
  /**
   * Выборка похожих магазинов
   * @param string $partstr
   */
  public function scanmag($partstr)
  {
    $q = $this->db->query(
      "SELECT * 
       FROM shoplist
       WHERE concat(common_name,' ', name_rec) LIKE concat('%',?,'%') ",
       array($partstr));
    return $q->result_array();
  }
  
  /**
   * Запись чека 
   * @param type $magID
   * @param type $magname
   * @param type $sumval
   * @param type $dat
   * @param type $force
   * @return int -1 - не записан, 1,2 - записан
   */
  public function savehandcheck($magID, $magname, $sumval, $dat, $force)
  {
    $rc = 0;
    $IDM = $this->check_mag($magID, $magname);
    $arsv["s"] = $sumval;
    $arsv["t"] = $dat;
    $arsv["fn"]= $IDM;
    if (!$force) // Проверить и не записывать если есть
    {
      $chkid = $this->checkID($arsv["fn"], $arsv["s"], $arsv["t"]);
      if (is_null($chkid))  // Чека нет. Если NULL - записать Иначе нет
      {
        $rc = 1;  // Просто записать 
      }
      else
      {
        $rc = -1; // Не записан
      }
    }
    else
    {
      $rc = 2; // Точно записать 
    }
    if ($rc > 0) // Всё-таки записать
    {
      $arsv["i"] = mt_rand();
      $this->savecheck($arsv);
    }
    return $rc;
  }

// PRIVATE
  
  /**
   * Проверить чек 
   * @param type $IDmag
   * @param type $sumval
   * @param type $dat
   * @return int/NULL
   */
  private function checkID($IDmag, $sumval, $dat)
  {
    $rc = NULL;
    $q = $this->db->query(
      "SELECT i FROM checkdata WHERE fn=? AND s=? AND t=?",
      array($IDmag,$sumval,$dat));
    if ($q->num_rows() > 0)
    {
      $rz = $q->result();
      $rc = $rz[0]->i; 
    }
    return $rc;
  }
 
  /**
   * Проверить и добавить если надо магазин
   * @param type $magID
   * @param type $magname
   * @return int
   */
  private function check_mag($magID, $magname)
  {
    if ($magID == BAD_VALUE)  // Неизвестный магазин
    {
      $apprxmag = $this->scanmag($magname); // Может не такой неизвестный? Просто не выбран?
      if (count($apprxmag)>0)
      {
        foreach ($apprxmag as $v)
        {
          if (mb_stristr($magname, $v["common_name"])!==FALSE || mb_stristr($magname, $v["name_rec"])!==FALSE)
          {
            $magID = $v["id"];
            break;
          }
        }
      }
      if ($magID == BAD_VALUE)  // Неизвестный магазин
      {
        $magID = -mt_rand(1, -BAD_VALUE);  // Сгенерировать случаный ID
      }
    }
    $q = $this->db->query(
      "SELECT COUNT(*) AS n FROM shoplist WHERE id=?",
      array($magID)
      );
    $rz = $q->result();
    if ($rz[0]->n == 0) // Записи с таким ID нет
    {
      $q = $this->db->query(
        "INSERT INTO shoplist (id, name_rec) VALUES (?, ?)",
        array($magID, $magname)
        );      
    }
    return $magID;
  }
}