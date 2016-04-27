<?php
class Students extends AbstractPage
{
    protected $view_file = '/views/students.php';// говорим какое представление использовать
    protected $title = 'Студенты';

    protected function content()
    {
        if (!empty($_POST['name']) && !empty($_POST['last_name']) && !empty($_POST['patronymic'])) {
            Post::addStudent($_POST['name'], $_POST['last_name'], $_POST['patronymic']);
        }
        if ($_SESSION['role'] == -1) header("Location: /OPTS/students.php?page=Login");
        return Post::getAll();
    }
}