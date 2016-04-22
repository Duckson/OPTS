<?php

class Login extends AbstractPage
{
    protected $view_file = '/views/login.php';// говорим какое представление использовать
    protected $title = 'Index';

    protected function content()
    {
        $check = Post::checkUser($_POST['username'], $_POST['password']);
        if ($check != -1) header("Location: ./index.php?page=Index");
    }
}