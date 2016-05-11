<?php
namespace pages;

class DefaultController extends \AbstractPage
{
    // этот метод - одна страница
    public function studentsAction()
    {
        $this->post();
        $data = $this->getAll();
        $this->title = 'Студенты';
        $this->render('views/default/students.php', $data);
    }

    // и этот метод - другая страница
    public function loginAction()
    {
        $this->post();
        $data = [];

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $result = \Post::checkUser($_POST['username'], $_POST['password']);
            if ($result != -1) {
                $_SESSION['role'] = $result['role'];
                header("Location: /OPTS/index.php?page=DefaultController/students");
            } else $_SESSION['role'] = -1;
        } else $_SESSION['role'] = -1;

        $this->title = 'Вход в ОПТС';
        $this->render('views/default/login.php', $data);
    }

    // и даже этот метод - третья страница, но он всегда перенаправляет на другую, и не отдаёт html
    public function logoutAction()
    {

        header('Locaton: /?page=Default/index');
    }

    public function contractsAction()
    {
        $this->post();
        $data = \Post::get('contracts');
        $this->title = 'Контракты';
        $this->render('views/default/login.php', $data);
    }

    protected function post()
    {
        if ($_SESSION['role'] == -1) header("Location: /OPTS/students.php?page=Login");

        if (!empty($_POST['name']) && !empty($_POST['last_name']) && !empty($_POST['patronymic'])) {
            \Post::addStudent($_POST['last_name'], $_POST['name'], $_POST['patronymic']);
        }

        if (!empty($_POST['company']) && !empty($_POST['formation_date']) && !empty($_POST['contr_text'])) {
            \Post::addContract($_POST['company'], $_POST['formation_date'], $_POST['contr_text']);
        }


    }

    protected function getAll()
    {
        $result['all'] = \Post::get();
        $result['contracts'] = \Post::get('contracts');
        $result['companies'] = \Post::get('companies');
        $result['types'] = \Post::get('types');

        return $result;
    }
}