<?php
class Index extends AbstractPage
{
    protected $view_file = '/views/index.php';// говорим какое представление использовать
    protected $title = 'Index';

    protected function content()
    {
        if ($_SESSION['role'] = -1) header("Location: ./index.php?page=Login");
        
    }
}