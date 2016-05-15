<?php
namespace pages;

class DefaultController extends \AbstractPage
{
    // этот метод - одна страница
    public function studentsAction()
    {
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
        $query = "SELECT students.id st_id,
            	students.first_name st_f_name,
            	students.last_name st_l_name,
            	students.patronymic st_patro,
            	applications.id app_id, 
            	applications.start_date app_start,
                applications.end_date app_end,
            	contracts.id contr_id,
            	contracts.text contr_text,
            	contracts.formation_date contr_date,
            	companies.name company_name
            FROM students 
                LEFT JOIN student_app_link ON(student_app_link.student_id = students.id)
                LEFT JOIN applications ON(student_app_link.app_id = applications.id)
                LEFT JOIN contracts ON(contracts.id = applications.contract_id)
                LEFT JOIN companies ON(companies.id = contracts.company_id)";
        $where=[];
        if(!empty($_POST['first_name']))
            $where[]="students.first_name='{$_POST['first_name']}'";
        if(!empty($_POST['last_name']))
            $where[]="students.last_name='{$_POST['last_name']}'";
        if(!empty($_POST['patronymic']))
            $where[]="students.patronymic='{$_POST['patronymic']}'";
        if(!empty($_POST['start_date']))
            $where[]="applications.start_date='{$_POST['start_date']}'";
        if(!empty($_POST['end_date']))
            $where[]="applications.end_date='{$_POST['end_date']}'";
        if(!empty($_POST['company']))
            $where[]="company_name='{$_POST['company']}'";
        switch ($_POST['practice']) {
            case 'yes':
                    $where[] = "applications.id IS NOT NULL";
                break;
            case 'no':
                $where[] = "applications.id IS NULL";
                break;
            default:
                break;
        }

        $where_str='';
        if(!empty($where)){
            $where_str=' WHERE '.join(' AND ',$where);
        }
        $query.=$where_str;

        $result['all'] = \DB::query($query);
        $result['contracts'] = \DB::query('SELECT * FROM contracts');
        $result['companies'] = \DB::query('SELECT * FROM companies');
        $result['types'] = \DB::query('SELECT * FROM practice_types');

        return $result;
    }
}