<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title><?= $this->title ?></title>
</head>
<body>
<div class="container-fluid">
    <?php if (($_SESSION['role'] == 1 || $_SESSION['role'] == 0) && $_SESSION['role'] != NULL): ?>
        <div class="row content">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">ОПТС</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php?page=DefaultController/students">Студенты<span class="sr-only">(current)</span></a></li>
                            <li><a href="index.php?page=DefaultController/contracts">Контракты</a></li>
                            <li><a href="#">Компании</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/OPTS/index.php?page=Login">Выход</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
    <?php endif; ?>
    <div class="row content">
        <div class="col-sm-2">
            <?php if ($_SESSION['role'] == 1): ?>
                <a href="#spoiler-1" data-toggle="collapse" class="btn btn-primary">Добавить студента</a>
                <div class="collapse" id="spoiler-1">
                    <div class="well">
                        <form action="index.php?page=<?=$_GET['page']?>" method="post">
                            Фамилия</br><input type="text" name="last_name"></br>
                            Имя</br><input type="text" name="name"></br>
                            Отчество</br><input type="text" name="patronymic"></br></br>
                            <input type="submit" value="Добавить">
                        </form>
                    </div>
                </div>
                <a href="#spoiler-2" data-toggle="collapse" class="btn btn-primary">Добавить контракт</a>
                <div class="collapse" id="spoiler-2">
                    <div class="well">
                        <form action="index.php?page=<?=$_GET['page']?>" method="post">
                            Компания</br>
                            <select name="company">
                                <?foreach ($page_data['companies'] as $company) :?>
                                    <option value="<?=$company['id']?>"><?=$company['name']?></option>
                                <?endforeach;?>
                            </select></br>
                            Дата подписания</br><input type="date" name="formation_date"></br>
                            Текст контракта</br><textarea name="contr_text"></textarea></br></br>
                            <input type="submit" value="Добавить">
                        </form>
                    </div>
                </div>
                <a href="#spoiler-3" data-toggle="collapse" class="btn btn-primary">Добавить компанию</a>
                <div class="collapse" id="spoiler-3">
                    <div class="well">
                        <form action="index.php?page=<?=$_GET['page']?>" method="post">
                            Название</br><input type="text" name="company_name"></br>
                            Адрес</br><textarea name="address"></textarea></br>
                            Номер телефона</br><input type="text" name="telephone_number"></br></br>
                            <input type="submit" value="Добавить">
                        </form>
                    </div>
                </div>
                <a href="#spoiler-4" data-toggle="collapse" class="btn btn-primary">Добавить приложение</a>
                <div class="collapse" id="spoiler-4">
                    <div class="well">
                        <form action="index.php?page=<?=$_GET['page']?>" method="post">
                            Контракт</br>
                            <select name="contract">
                                <?foreach ($page_data['contracts'] as $contract) :?>
                                    <option value="<?=$contract['id']?>"><?=$contract['formation_date'] . ' - ' .
                                        $page_data['companies'][$contract['company_id'] - 1]['name'] ?></option>
                                <?endforeach;?>
                            </select></br>
                            Тип практики</br>
                            <select name="practice_type">
                                <?foreach ($page_data['types'] as $type) :?>
                                    <option value="<?=$type['id']?>"><?=$type['type']?></option>
                                <?endforeach;?>
                            </select></br>
                            Дата начала</br><input type="date" name="start_date"></br>
                            Дата конца</br><input type="date" name="end_date"></br>
                            Студенты</br>
                            <select name="students multiple">
                                <?foreach ($page_data['all'] as $type) :?>
                                    <option value="<?=$type['id']?>"><?=$type['type']?></option>
                                <?endforeach;?>
                            </select></br></br>
                            <input type="submit" value="Добавить">
                        </form>
                    </div>
                </div>

            <?php endif ?>
        </div>
        
        
