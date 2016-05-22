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
        $query = 'SELECT contracts.id id,
                         contracts.formation_date f_date,
                         companies.name company_name
                  FROM contracts
                  LEFT JOIN companies ON (companies.id = contracts.company_id)';

        $where=[];
        if(!empty($_POST['с_date']))
            $where[]="contracts.formation_date='{$_POST['с_date']}'";
        if(!empty($_POST['c_name']))
            $where[]="companies.name='{$_POST['c_name']}'";

        $where_str='';
        if(!empty($where)){
            $where_str=' WHERE '.join(' AND ',$where);
        }
        $query.=$where_str;

        $contracts = \DB::query($query);
        $result['contracts'] = $contracts;
        $this->title = 'Контракты';
        $this->render('views/default/contracts.php', $result);
    }

    public function appsAction()
    {
        $id = $_GET['id'];
        if (!empty($id)) {
            $query = "
            SELECT applications.id id,
                   applications.start_date app_start,
                   applications.end_date app_end,
                   contracts.id contr_id,
                   contracts.formation_date contr_date,
                   companies.name company,
                   practice_types.type practice_type
            FROM applications
            LEFT JOIN contracts ON (applications.contract_id = contracts.id)
            LEFT JOIN companies ON (contracts.company_id = companies.id)
            LEFT JOIN practice_types ON (applications.practice_id = practice_types.id)
            WHERE contracts.id = '$id'
        ";
            $where=[];
            if(!empty($_POST['a_start_date']))
                $where[]="applications.start_date='{$_POST['a_start_date']}'";
            if(!empty($_POST['a_end_date']))
                $where[]="applications.end_date='{$_POST['a_end_date']}'";
            if(!empty($_POST['a_type']) && $_POST['a_type'] != 'meh')
                $where[]="practice_types.type='{$_POST['a_type']}'";

            $where_str='';
            if(!empty($where)){
                $where_str=' AND '.join(' AND ',$where);
            }
            $query.=$where_str;

            $apps = \DB::query($query);
            if(!empty($apps)) {
                $students = \DB::query('SELECT * FROM students');
                $links = \DB::query('SELECT * FROM student_app_link');

                foreach ($apps as $key => $app) {
                    $unset = false;
                    foreach ($links as $link) {
                        if ($link['app_id'] == $app['id'])
                            foreach ($students as $s_key => $student) {
                                if ($link['student_id'] == $student['id']) {
                                    $apps[$key]['students'][] = $student;
                                    if(!empty($_POST['a_first_name']) && $_POST['a_first_name'] != $student['first_name'])
                                        $unset = true;
                                    if(!empty($_POST['a_last_name']) && $_POST['a_last_name'] != $student['last_name'])
                                        $unset = true;
                                    if(!empty($_POST['a_patro']) && $_POST['a_patro'] != $student['patronymic'])
                                        $unset = true;
                                }
                            }
                    }
                    if($unset)
                        unset($apps[$key]);
                }
            }

            $types = \DB::query('SELECT practice_types.type p_type FROM practice_types');
            $result['types'] = $types;
            $result['apps'] = $apps;
            $result['id'] = $id;
            $this->title = 'Приложения';
            $this->render('views/default/apps.php', $result);
        } else $this->render('views/default/error.php', '');
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
        if(!empty($_POST['s_first_name']))
            $where[]="students.first_name='{$_POST['s_first_name']}'";
        if(!empty($_POST['s_last_name']))
            $where[]="students.last_name='{$_POST['s_last_name']}'";
        if(!empty($_POST['s_patronymic']))
            $where[]="students.patronymic='{$_POST['s_patronymic']}'";
        if(!empty($_POST['s_start_date']))
            $where[]="applications.start_date='{$_POST['s_start_date']}'";
        if(!empty($_POST['s_end_date']))
            $where[]="applications.end_date='{$_POST['s_end_date']}'";
        if(!empty($_POST['s_company']))
            $where[]="company_name='{$_POST['s_company']}'";
        switch ($_POST['s_practice']) {
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