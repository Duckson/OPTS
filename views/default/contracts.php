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
