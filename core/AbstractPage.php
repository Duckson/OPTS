<?php

abstract class AbstractPage
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
        

        if (is_array($page_data)) {
            extract($page_data);
        }

        include($_SERVER['DOCUMENT_ROOT'] . '/OPTS/views/header.php');
        include($_SERVER['DOCUMENT_ROOT'] . "/OPTS/" . $view_file); // подключаем разметку, которая эти переменные использует
        include($_SERVER['DOCUMENT_ROOT'] . '/OPTS/views/footer.php');
    }

    protected abstract function content(); // обязываем нас создать метод который формирует контент
}