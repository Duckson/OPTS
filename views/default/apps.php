<div class="col-sm-3">
    <h3 class="text-center">Фильтр</h3>
    <form action="index.php?page=DefaultController/apps&id=<?=$_GET['id']?>" method="post">
        Дата старта <input type="date" name="a_start_date" value="<?= htmlspecialchars($_POST['с_date']) ?>"><br>
        Дата конца <input type="date" name="a_end_date" value="<?= htmlspecialchars($_POST['с_date']) ?>"><br>
        Тип практики <select name="a_type">
            <option value="meh">Без разницы</option>
            <?php
            foreach ($page_data['types'] as $val){
                echo '<option value="' . $val['p_type'] . '"' . ($_POST['a_type'] == $val['p_type']? "selected='selected'":'') . '>' . $val['p_type'] . '</option>';
            }
            ?>
        </select><br>
        Фамилия студента <input type="text" name="a_last_name" value="<?= htmlspecialchars($_POST['a_last_name']) ?>"><br>
        Имя студента <input type="text" name="a_first_name" value="<?= htmlspecialchars($_POST['a_first_name']) ?>"><br>
        Отчество студента <input type="text" name="a_patro" value="<?= htmlspecialchars($_POST['a_patro']) ?>"><br>
        <input type="submit" value="Применить">
    </form>
    <form action="index.php?page=DefaultController/apps&id=<?=$_GET['id']?>" method="post">
        <input type="submit" value="Очистить">
    </form>
</div>
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