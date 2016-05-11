<?php

/*abstract class AbstractPage
{
    protected $view_file;
    protected $title;// будет определено позже

    public function run()
    {
        // делаем обязательные для каждой страницы действия
        // и далее вызываем рассчёт контента страницы
        $page_data = $this->content();
        $this->render($this->view_file, $page_data);
    }

    function echoLinks($page)
    {
        switch ($page) {
            case 'Make':
                echo "<a href='../../Test/index.php?page=Index'>Перейти к новостям</a> <a href='../../Test/index.php?page=MakeCategory'>Добавить категорию</a>";
                break;
            case "Cat":
                echo "<a href='../../Test/index.php?page=Index'>Перейти к новостям</a> <a href='../../Test/index.php?page=Make'>Добавить новость</a>";
                break;
            default :
                echo "<a href='../../Test/index.php?page=MakeCategory'>Добавить категорию</a> <a href='../../Test/index.php?page=Make'>Добавить новость</a>";
                break;
        }
    }

    protected function render($view_file, $page_data)
    {
        // делаем элементы массива полноценными переменными
        // это работает так, пусть есть массив $arr=['a'=>123,'b'=>456]
        // extract($arr); Делает так что теперь нам доступны переменные $a и $b

        include($_SERVER['DOCUMENT_ROOT'] . '/OPTS/views/header.php');
        include($_SERVER['DOCUMENT_ROOT'] . "/OPTS/" . $view_file); // подключаем разметку, которая эти переменные использует
        include($_SERVER['DOCUMENT_ROOT'] . '/OPTS/views/footer.php');
    }

    protected abstract function content(); // обязываем нас создать метод который формирует контент
}*/

abstract class AbstractPage
{
    protected $title;

    public function run($method_name)
    {
        $full_method_name = $method_name . 'Action';
        if (method_exists($this, $full_method_name)) {    // проверяем есть ли такой метод в текущем классе
            $this->{$full_method_name}();                // если есть то вызываем его
        } else {
            throw new Exception("Страница не найдена");
        }
    }

    protected function render($view, $page_data)
    { // этот метод подключает вьюху и передаёт ей данные, ну ты знаешь)
        include($_SERVER['DOCUMENT_ROOT'] . '/OPTS/views/header.php');
        include($_SERVER['DOCUMENT_ROOT'] . "/OPTS/" . $view);
        include($_SERVER['DOCUMENT_ROOT'] . '/OPTS/views/footer.php');
    }
}