<div class="col-sm-3">
    <h3 class="text-center">Фильтр</h3>
    <form action="index.php?page=DefaultController/students" method="post">
        Фамилия <input type="text" name="last_name" value="<?= $_POST['last_name'] ?>"><br>
        Имя <input type="text" name="first_name" value="<?= $_POST['first_name'] ?>"><br>
        Отчество <input type="text" name="patronymic" value="<?= $_POST['patronymic'] ?>"><br>
        Дата начала практики <input type="date" name="start_date" value="<?= $_POST['start_date'] ?>"><br>
        Дата конца практики <input type="date" name="end_date" value="<?= $_POST['end_date'] ?>"><br>
        Компания <input type="text" name="company" value="<?= $_POST['company'] ?>"><br>
        Проходит практику? <select name="practice" id="sel">
                <option value="meh">Без разницы</option>
                <option value="yes">Да</option>
                <option value="no">Нет</option>
            </select><br>
        <script>
            document.getElementById('sel').value = "<?= $_POST['practice']?>";
        </script>
            <input type="submit" value="Применить">
    </form>
    <form action="index.php?page=DefaultController/students" method="post">
        <input type="submit" value="Очистить">
    </form>
</div>
<div class="col-sm-9">
    <table class="table table-hover table-condensed">
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

