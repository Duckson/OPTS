<div class="col-sm-3">
    <h3 class="text-center">Фильтр</h3>
    <form action="index.php?page=DefaultController/students" method="post">
        Фамилия <input type="text" name="s_last_name" value="<?= htmlspecialchars($_POST['s_last_name']) ?>"><br>
        Имя <input type="text" name="s_first_name" value="<?= htmlspecialchars($_POST['s_first_name']) ?>"><br>
        Отчество <input type="text" name="s_patronymic" value="<?= htmlspecialchars($_POST['s_patronymic']) ?>"><br>
        Дата начала практики <input type="date" name="s_start_date" value="<?= htmlspecialchars($_POST['s_start_date']) ?>"><br>
        Дата конца практики <input type="date" name="s_end_date" value="<?= htmlspecialchars($_POST['s_end_date']) ?>"><br>
        Компания <input type="text" name="s_company" value="<?= htmlspecialchars($_POST['s_company']) ?>"><br>
        Проходит практику? <select name="s_practice" id="sel">
            <?php
                $ops = ['meh'=>'Без разницы', 'yes'=>'Да', 'no'=>'Нет'];
                foreach ($ops as $val=>$name){
                    echo '<option value="' . $val . '"' . ($_POST['s_practice'] == $val? "selected='selected'":'') . '>' . $name . '</option>';
                }
            ?>
            </select><br>
            <input type="submit" value="Применить">
    </form>
    <form action="index.php?page=DefaultController/students" method="post">
        <input type="submit" value="Очистить">
    </form>
</div>
<div class="col-sm-9">
    <table class="table table-hover table-condensed table-bordered">
        <tr>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Практика</th>
            <th>Начало практики</th>
            <th>Конец практики</th>
            <th>Компания</th>
        </tr>
        <? foreach ($page_data['all'] as $student): ?>
            <tr>
                <td><?= $student['st_l_name'] ?></td>
                <td><?= $student['st_f_name'] ?></td>
                <td><?= $student['st_patro'] ?></td>
                <?php if ($student['app_id']): ?>
                    <td class="success"></td>
                <?php else: ?>
                    <td class="danger"></td>
                <?php endif ?>
                <td><?= $student['app_start'] ?></td>
                <td><?= $student['app_end'] ?></td>
                <td><?= $student['company_name'] ?></td>
            </tr>
        <? endforeach; ?>
    </table>
</div>

