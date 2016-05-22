<div class="col-sm-3">
    <h3 class="text-center">Фильтр</h3>
    <form action="index.php?page=DefaultController/contracts" method="post">
        Название компании <input type="text" name="c_name" value="<?= htmlspecialchars($_POST['c_name']) ?>"><br>
        Дата подписания <input type="date" name="с_date" value="<?= htmlspecialchars($_POST['с_date']) ?>"><br>
        <input type="submit" value="Применить">
    </form>
    <form action="index.php?page=DefaultController/contracts" method="post">
        <input type="submit" value="Очистить">
    </form>
</div>
<div class="col-sm-8">
    <h2 class="text-center">Контракты</h2><br>
    <table class="table table-condensed table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Компания</th>
            <th>Дата подписания</th>
            <th>Приложения</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($page_data['contracts'] as $contract): ?>
            <tr>
                <td><?= $contract['id'] ?></td>
                <td><?= $contract['company_name'] ?></td>
                <td><?= $contract['f_date'] ?></td>
                <td><a href="index.php?page=DefaultController/apps&id=<?= $contract['id'] ?>"><button>Посмотреть</button></a></td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
    <button class="temp">Добавить контракт</button>
</div>
