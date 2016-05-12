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
        $data = [];

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $result = \DB::checkUser($_POST['username'], $_POST['password']);
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
        $_SESSION['role'] = -1;
        header('Locaton: /?page=DefaultController/login');
    }

    public function contractsAction()
    {
        $this->post();
        $apps = \DB::getApps();
        $students = \DB::query('SELECT * FROM students');
        $links = \DB::query('SELECT * FROM student_app_link');
        $contracts = \DB::query('SELECT * FROM contracts');

        foreach ($links as $link){
            foreach ($apps as $key=>$app){
                if($link['app_id'] == $app['id'])
                    foreach ($students as $s_key=>$student){
                        if($link['student_id'] == $student['id'])
                            $apps[$key]['students'][] = $student;
                    }
            }
        }
        
        $result['apps'] = $apps;
        $result['contracts'] = $contracts;
        $this->title = 'Контракты';
        $this->render('views/default/contracts.php', $result);
    }

    protected function post()
    {
        if (!empty($_POST['name']) && !empty($_POST['last_name']) && !empty($_POST['patronymic'])) {
            \DB::addStudent($_POST['last_name'], $_POST['name'], $_POST['patronymic']);
        }

        if (!empty($_POST['company']) && !empty($_POST['formation_date']) && !empty($_POST['contr_text'])) {
            \DB::addContract($_POST['company'], $_POST['formation_date'], $_POST['contr_text']);
        }
    }

    protected function getAll()
    {
        $result['all'] = \DB::getStudents();
        $result['contracts'] = \DB::query('SELECT * FROM contracts');
        $result['companies'] = \DB::query('SELECT * FROM companies');
        $result['types'] = \DB::query('SELECT * FROM practice_types');

        return $result;
    }
}