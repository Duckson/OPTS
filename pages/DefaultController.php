<?php
namespace pages;

class DefaultController extends \AbstractPage
{
    // этот метод - одна страница
    public function studentsAction()
    {
        $data = $this->getAll();
        $data['all'] = $this->studentsFilter($data['all']);
        $this->title = 'Студенты';
        $this->render('views/default/students.php', $data);
    }

    protected function studentsFilter($students){
        foreach ($students as $key=>$student){
            if(!empty($_POST['first_name']) && $student['st_f_name'] != $_POST['first_name'])
                unset($students[$key]);
            if(!empty($_POST['last_name']) && $student['st_l_name'] != $_POST['last_name'])
                unset($students[$key]);
            if(!empty($_POST['patronymic']) && $student['st_patro'] != $_POST['patronymic'])
                unset($students[$key]);
            if(!empty($_POST['start_date']) && $student['app_start'] != $_POST['start_date'])
                unset($students[$key]);
            if(!empty($_POST['end_date']) && $student['app_end'] != $_POST['end_date'])
                unset($students[$key]);
            if(!empty($_POST['company']) && $student['company_name'] != $_POST['company'])
                unset($students[$key]);
            switch ($_POST['practice']){
                case 'yes':
                    if(empty($student['app_id']))
                        unset($students[$key]);
                    break;
                case 'no':
                    if(!empty($student['app_id']))
                        unset($students[$key]);
                    break;
                default:
                    break;
            }
        }
        return $students;
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
        $contracts = \DB::query('SELECT contracts.id id,
                                        contracts.formation_date f_date,
                                        companies.name company_name
                                 FROM contracts
                                 LEFT JOIN companies ON (companies.id = contracts.company_id)
                                 ');

        $result['contracts'] = $contracts;
        $this->title = 'Контракты';
        $this->render('views/default/contracts.php', $result);
    }

    public function appsAction()
    {
        $this->post();
        $id = $_GET['id'];
        if (!empty($id)) {
            $apps = \DB::getApps($id);
            if(!empty($apps)) {
                $students = \DB::query('SELECT * FROM students');
                $links = \DB::query('SELECT * FROM student_app_link');

                foreach ($links as $link) {
                    foreach ($apps as $key => $app) {
                        if ($link['app_id'] == $app['id'])
                            foreach ($students as $s_key => $student) {
                                if ($link['student_id'] == $student['id'])
                                    $apps[$key]['students'][] = $student;
                            }
                    }
                }
            }

            $result['apps'] = $apps;
            $result['id'] = $id;
            $this->title = 'Приложения';
            $this->render('views/default/apps.php', $result);
        } else $this->render('views/default/error.php', '');
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