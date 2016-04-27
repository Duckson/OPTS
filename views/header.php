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
    <?php if(($_SESSION['role'] == 1 || $_SESSION['role'] == 0) && $_SESSION['role'] != NULL):?>
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
                            <li class="active"><a href="#">Студенты<span class="sr-only">(current)</span></a></li>
                            <li><a href="#">Договоры</a></li>
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
        
        
