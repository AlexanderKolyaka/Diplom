<?php
require_once APPPATH.'core/main_controller.php';

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @property Stud_Model $stud_model
 */
class MainMenu extends Main_Controller
{
//***********************************
//  P U B L I C
//***********************************
    const MAX_RUN_STEPS = 5;

    public function __construct() 
  {
    parent::__construct();
    $this->load->model("stud/stud_model", "stud_model");
  }
  
  public function index()
  {
    $this->load->view('stud/views/mainmenu/index');
  }
  
  public function grouplist()
  {
      $a[] = array("Группа","Год набора","Сдавало","Сдало","Норма");
      $b = $this->stud_model->grouplist();
      $data_vew['STRLIST'] = array_merge($a,$b);
      $data_vew['HREF']="showexam/";
      $this->load->view('stud/views/mainmenu/unilist',$data_vew);
      return Main_Controller::OUTPUT_MIN;
  }
  
  public function examinerlist()
  {
      $a[] = array("Фамилия","Имя","Сдавало","Сдало","Норма");
      $b = $this->stud_model->examinerlist();
      $data_vew['STRLIST'] = array_merge($a,$b);
      $this->load->view('stud/views/mainmenu/unilist',$data_vew);
      return Main_Controller::OUTPUT_MIN;
  }
  
  public function subjectlist()
  {
      $a[] = array("Предмет","Кратко","Сдавало","Сдало","Норма");
      $b = $this->stud_model->subjectlist();
      $data_vew['STRLIST'] = array_merge($a,$b);
      $this->load->view('stud/views/mainmenu/unilist',$data_vew);
      return Main_Controller::OUTPUT_MIN;
  }

  public function runcalc($stepno = 0)
  {
      switch ($stepno) {
          case 0:
              $this->stud_model->clear_all();
              break;
          case 1:
              $this->stud_model->calc_group();
              break;
          case 2:
              $this->stud_model->calc_subject();
              break;
          case 3:
              $this->stud_model->calc_examiner();
              break;
          case 4:
              $this->stud_model->calc_exam_x();
              break;
          default:
          $stepno = 999;
              break;
      }
      $stepno++;
      $view_data["PERCENT"] = $stepno/self::MAX_RUN_STEPS;
      $view_data["NEXTSTEP"] = $stepno;
      $view_data["BASE"] = $this->config->base_url();
      $this->load->view('stud/views/mainmenu/runcalc',$view_data);
      return Main_Controller::OUTPUT_NONE;
  }
  
  public function showexam($ngr)
  {
      $data_view['GROUP'] = $this->stud_model->get_group($ngr); 
      $data_view['ALLEXAM'] = $this->stud_model->get_group_exam($ngr); 
      $this->load->view('stud/views/mainmenu/showexam',$data_view);
      return Main_Controller::OUTPUT_MIN;
  }
  
}