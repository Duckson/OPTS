<?php

class Login extends AbstractPage
{
    protected $view_file = '/views/login.php';// говорим какое представление использовать
    protected $title = 'Login';

    protected function content()
    {
        if (!empty($_POST['username']) && !empty($_POST['username'])) {
            $result = Post::checkUser($_POST['username'], $_POST['password']);
            var_dump($result);
            if ($result != -1) {
                $_SESSION['role'] = $result['role'];
                header("Location: /OPTS/index.php?page=Index");
            } else $_SESSION['role'] = -1;
        } else $_SESSION['role'] = -1;
    }
}