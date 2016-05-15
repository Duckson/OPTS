<div class="col-sm-8">
    <h2 class="text-center">Приложения контракта <?= $page_data['id'] ?></h2><br>
    <?php if (!empty($page_data['apps'])) : ?>
        <table class="table table-hover table-condensed table-bordered">
            <tr>
                <th>Дата старта</th>
                <th>Дата конца</th>
                <th>Тип практики</th>
                <th>Студенты</th>
            </tr>
            <? foreach ($page_data['apps'] as $app): ?>
                    <tr>
                        <td><?= $app['app_start'] ?></td>
                        <td><?= $app['app_end'] ?></td>
                        <td><?= $app['practice_type'] ?></td>
                        <td>
                            <?php foreach ($app['students'] as $student)
                                echo $student['last_name'] . ' ' . $student['first_name'] . ' ' . $student['patronymic'] . '<br>'; ?>
                        </td>
                    </tr>
            <? endforeach; ?>
        </table>
    <?php else : ?> Нет приложений
    <?php endif ?>
</div>