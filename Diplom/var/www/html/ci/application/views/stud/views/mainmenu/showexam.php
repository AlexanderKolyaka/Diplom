<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
    $this->page_control_data->add_css(view_prefix("stud/css/mainmenu/bodyframe.css"));
?>
<h2>
    <?=$GROUP["title"]?> набора <?=$GROUP["start_year"]?>г. 
</h2>
<table>
    <thead>
        <tr>
            <td>
                Сессия
            </td>
            <td>
                Экзамен
            </td>
            <td>
                Предмет 
            </td>
            <td>
                Преподаватель
            </td>
            <td>
                Сдавало
            </td>
            <td>
                Сдало
            </td>
            <td>
                y
            </td>
            <td>
                xts
            </td>
            <td>
                x1
            </td>
            <td>
                x2
            </td>
        </tr>
    </thead>
    <?php foreach ($ALLEXAM as $k => $v): ?>
    <tr data-id="<?=$v["id_exam_list"]?>">
        <td>
            <?=$v["session_number"]?>
        </td>        
        <td>
            <?=$v["exam_number_in_session"]?>
        </td>
        <td>
            <?=$v["title_subject"]?>
        </td>
        <td>
            <?=$v["first_name"]?>
        </td>
        <td>
            <?=$v["number_students_in_group"]?>
        </td>
        <td>
            <?=$v["number_positive_ratings"]?>
        </td>
        <td>
            <?=$v["y"]?>
        </td>
        <td>
            <?=$v["xts"]?>
        </td>
        <td>
            <?=$v["x1"]?>
        </td>
        <td>
            <?=$v["x2"]?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
    