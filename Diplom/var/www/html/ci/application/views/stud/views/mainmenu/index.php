<?php
  $this->page_control_data->TITLE = "Статистика экзаменов";
  $this->page_control_data->add_js(view_prefix("stud/js/mainmenu/index.js"));
  $this->page_control_data->add_css(view_prefix("stud/css/mainmenu/index.css"));
?>
<table ID="MAINT">
    <tr>
        <th ID="HEADT" colspan="2">
           Статистика экзаменов
        </th>
    </tr>
    <tr>
        <th class="LMENU" onclick="showPage('grouplist');">
            Группы
        </th>
        <td rowspan="5" ID="VBODY">            
            <div ID="VBD5" hidden>
                Настройки программы
            </div>
        </td>
    </tr>
    <tr>
        <th class="LMENU" onclick="showPage('examinerlist');">
            Преподаватели
        </th>
    </tr>
    <tr>
        <th class="LMENU" onclick="showPage('subjectlist');">
            Предметы
        </th>
    </tr>
    <tr>
        <th class="LMENU" onclick="showPage('runcalc');">
            Расчёт всего
        </th>
    </tr>
    <tr>
        <th class="LMENU" onclick="showPage('predict');">
            Прогноз
        </th>
    </tr>    
    <tr>
        <th class="LMENU" onclick="showPage('projectsetup')">
            Параметры
        </th>
    </tr>
</table>