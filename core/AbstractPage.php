<?php

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