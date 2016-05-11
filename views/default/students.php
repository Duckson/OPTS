<div class="col-sm-8">
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
<div class="col-sm-2">
    <b>Нет данных о прохождении практики:</b><br>
    <? foreach ($page_data['all'] as $student): ?>
        <?php if (!$student['app_id']): ?>
            <?=$student['st_l_name'] . " " . $student['st_f_name'] . " " . $student['st_patro'] . "<br>"?>
        <?php endif ?>
    <? endforeach; ?>

</div>
