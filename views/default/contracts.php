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
        <? foreach ($page_data as $student): ?>
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
<div class="col-sm-2"></div>