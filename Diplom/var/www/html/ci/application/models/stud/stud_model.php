<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stud_Model extends CI_Model
{
  public function __construct() 
  {
    parent::__construct();
  }
  
  public function grouplist()
  {
    $rc = array();
    $q = $this->db->query(
            "SELECT title as info1,  
                    start_year as info2,  
                    ntotal,
                    npositiv,
                    id_group as id
             FROM stud.group
             ");        
    if ($q->num_rows()>0)
    {
      $rc = $q->result_array();
    }
    return $rc;
  }
  
  public function examinerlist()
  {
    $rc = array();
    $q = $this->db->query(
            "SELECT first_name as info1,
                    second_name as info2,
                    ntotal,
                    npositiv,
                    id_examiner as id
             FROM stud.examiner
             ");        
    if ($q->num_rows()>0)
    {
      $rc = $q->result_array();
    }
    return $rc;
  }
  
  public function subjectlist()
  {
    $rc = array();
    $q = $this->db->query(
            "SELECT title_subject as info1,
                    '...' as info2,
                    ntotal,
                    npositiv,
                    id_subject as id
             FROM stud.subject
             ");        
    if ($q->num_rows()>0)
    {
      $rc = $q->result_array();
    }
    return $rc;
  }
  
  public function clear_all()
  {
    $this->db->query(
          "UPDATE stud.subject
           SET    ntotal = NULL,
                  npositiv = NULL;
           ");
    $this->db->query(
          "UPDATE stud.examiner
           SET    ntotal = NULL,
                  npositiv = NULL;
           ");
    $this->db->query(
          "UPDATE stud.group
           SET    ntotal = NULL,
                  npositiv = NULL;
           ");
    $this->db->query("DELETE FROM stud.exam_expand");
  }
  
  public function calc_group()
  {
      $this->db->query($this->prepare_updt_norma("group"));      
  }
  
  public function calc_examiner()
  {
      $this->db->query($this->prepare_updt_norma("examiner"));      
  }  
  
  public function calc_subject()
  {
      $this->db->query($this->prepare_updt_norma("subject"));      
  }
  
  public function calc_exam_x()
  {
    $this->db->query(
        "INSERT INTO stud.exam_expand (idexamlist,xts,x2,x1,y)
         SELECT  id_exam_list, sqrt((ex.npositiv/ex.ntotal)*(s.npositiv/s.ntotal)) AS xts, 
        sqrt((ex.npositiv/ex.ntotal)*(s.npositiv/s.ntotal))*exam_number_in_session AS x2,
        sqrt((ex.npositiv/ex.ntotal)*(s.npositiv/s.ntotal))*exam_number_in_session*exam_number_in_session AS x1,
        number_positive_ratings/number_students_in_group as y
        FROM exam_list e
        INNER JOIN examiner ex ON ex.id_examiner = e.idexaminer
        INNER JOIN stud.subject s ON s.id_subject = e.idsubject"
    );
  }
  
  public function get_group($ngr)
  {
    $rc = array();
    $q = $this->db->query("SELECT * FROM stud.group WHERE id_group=?", array($ngr));
    if ($q->num_rows()>0)
    {
      $rc = $q->result_array()[0];
    }    
    return $rc;
  }
  
  public function get_group_exam($ngr)
  {
    $rc = array();
    $q = $this->db->query(
      "SELECT 
        id_exam_list,
        session_number,
        exam_number_in_session,
        title_subject,
        first_name,
        xts, 
        x1,
        x2,
        ex.y,
        number_positive_ratings,
        number_students_in_group
       FROM exam_list e 
       INNER JOIN exam_expand ex ON e.id_exam_list = ex.idexamlist
       INNER JOIN examiner t ON e.idexaminer = t.id_examiner
       INNER JOIN subject s ON e.idsubject = s.id_subject
       WHERE idgroup=?
       ORDER BY session_number,
        exam_number_in_session",
       array($ngr));
    if ($q->num_rows()>0)
    {
      $rc = $q->result_array();
    }    
    return $rc;
  }

  //*******************************
  //* PRIVATE
  //*******************************
  private function prepare_updt_norma($table)
  {
      return
      "UPDATE stud.".$table.
         " SET npositiv = (select sum(stud.exam_list.number_positive_ratings) 
                from stud.exam_list where stud.exam_list.id".$table." = id_".$table."),
              ntotal = (select sum(stud.exam_list.number_students_in_group) 
                from stud.exam_list where stud.exam_list.id".$table." = id_".$table.")";
  }
}