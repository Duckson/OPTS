<div class="col-sm-8">
    <? foreach ($page_data['contracts'] as $contract): ?>
        <h2>Контракт <?= $contract['id']?></h2>
        <table class="table table-hover table-condensed table-bordered">
            <tr>
                <th>Дата старта</th>
                <th>Дата конца</th>
                <th>Компания</th>
                <th>Дата подписания контракта</th>
                <th>Тип практики</th>
                <th>Студенты</th>
            </tr>
            <? foreach ($page_data['apps'] as $app): ?>
                <?php if ($contract['id'] == $app['contr_id']): ?>
                    <tr>
                        <td><?= $app['app_start'] ?></td>
                        <td><?= $app['app_end'] ?></td>
                        <td><?= $app['company'] ?></td>
                        <td><?= $app['contr_date'] ?></td>
                        <td><?= $app['practice_type'] ?></td>
                        <td>
                            <?php foreach ($app['students'] as $student)
                                echo $student['last_name'] . ' ' . $student['first_name'] . ' ' . $student['patronymic'] . '<br>'; ?>
                        </td>
                    </tr>
                <?php endif ?>
            <? endforeach; ?>
        </table>
        <button class="temp">Добавить приложение</button>
    <? endforeach; ?>
</div>
