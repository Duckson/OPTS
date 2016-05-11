<?php

class Post
{
    /** public static function getAll()
     * {
     * $obj_array = [];
     * foreach ($_SESSION['news'] as $news) {
     *     $post_obj = new Post();
     *     $post_obj->title = $news['title'];
     *     $post_obj->text = $news['text'];
     *     $obj_array[] = $post_obj;
     * }
     * return $obj_array; // возвращаем массив объектов
     * $sql = new mysqli('localhost', 'root', 'root', "News");
     * $result = $sql->query("SELECT * FROM News");
     * $news = [];
     * while ($row = mysqli_fetch_assoc($result)) {
     * $cat_id = $sql->query("SELECT name FROM categories WHERE id='{$row['category']}'");
     * $cat_id = $cat_id->fetch_row()[0];
     * $news[] = [
     * 'id' => $row['id'],
     * 'title' => $row['title'],
     * 'text' => $row['text'],
     * 'category' => $cat_id
     * ];
     * };
     * return $news;
     *
     * }
     *
     * /public static function getCategories()
     * {
     * $sql = new mysqli('localhost', 'root', 'root', "News");
     * $result = $sql->query("SELECT * FROM categories ORDER BY id;");
     * var_dump($result);
     * $cats = [];
     * while ($row = mysqli_fetch_assoc($result)) {
     * $cats[] = [
     * 'id' => $row['id'],
     * 'name' => $row['name']
     * ];
     * }
     * return $cats;
     * }
     *
     *
     * public static function addPost($title, $text, $cat)
     * {
     * /**if (!isset($_SESSION['news'])) $_SESSION['news'] = [];
     * $title = filter_var($_POST["title"], FILTER_SANITIZE_SPECIAL_CHARS);
     * $text = filter_var($_POST["text"], FILTER_SANITIZE_SPECIAL_CHARS);
     *
     * if (!empty($title) && !empty($text))
     * $_SESSION['news'][] = [
     * 'title' => $title,
     * 'text' => $text
     * ];
     *
     * $sql = new mysqli('localhost', 'root', 'root', "News");
     * $title = filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS);
     * $text = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);
     * $cat = (int)$cat;
     *
     * if (!empty($title) && !empty($text) && !empty($cat)) {
     *
     * $sql->query("INSERT INTO news(title, text, category) VALUES('$title', '$text', '$cat')");
     * }
     * }
     *
     * static function addCategory($cat)
     * {
     * $sql = new mysqli('localhost', 'root', 'root', "News");
     * $sql->query("INSERT INTO categories(name) VALUES('$cat')");
     * }*/

    public static function Loader($class)
    {
        $full_class_name = explode('\\', $class);
        list($namespace, $class) = $full_class_name;
        $path = $_SERVER['DOCUMENT_ROOT'] . '/OPTS/';

        include $path . $namespace. '/' . $class . '.php';
    }

    public static function checkUser($username, $password)
    {
        $sql = Config::get()->db;
        $password = md5($password);
        $result = $sql->query("SELECT role FROM users WHERE login='$username' AND password='$password'");

        if ($result != 0) {
            $result = $result->fetch_array();
            if (!isset($result)) return -1;
            return $result;
        }
        return -1;
    }

    public static function get($result = "all")
    {
        $sql = Config::get()->db;
        switch ($result) {
            default:
                $data = $sql->query("
            SELECT students.id st_id,
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
                LEFT JOIN companies ON(companies.id = contracts.company_id)
            ORDER BY students.last_name ASC, students.first_name ASC
                  ");
                echo $sql->error;
                while ($row = $data->fetch_array()) {
                    $all[] = $row;
                }
                return $all;
                break;
            case "contracts":
                $data = $sql->query("SELECT * FROM contracts");
                while ($row = $data->fetch_assoc()) {
                    $contracts[] = $row;
                }
                return $contracts;
            case "companies":
                $data = $sql->query("SELECT * FROM companies");
                while ($row = $data->fetch_assoc()) {
                    $companies[] = $row;
                }
                return $companies;
            case 'types':
                $data = $sql->query("SELECT * FROM practice_types");
                while ($row = $data->fetch_assoc()) {
                    $types[] = $row;
                }
                return $types;
        }


    }

    public static function addStudent($last_name, $name, $patronymic)
    {
        $sql = Config::get()->db;
        $name = ucfirst($name);
        $last_name = ucfirst($last_name);
        $patronymic = ucfirst($patronymic);

        $sql->query("INSERT INTO students(first_name, last_name, patronymic) VALUES ('$name', '$last_name', '$patronymic')");
        echo $sql->error;
    }

    public static function addContract($company, $date, $text)
    {
        $sql = Config::get()->db;

        $sql->query("INSERT INTO contracts(company_id, formation_date, text) VALUES ('$company', '$date', '$text')");
        echo $sql->error;
    }

    public static function test()
    {
        $sql = Config::get()->db;
        $students_table = $sql->query("SELECT * FROM students");
        while ($student = $students_table->fetch_array()) $students[] = $student;
        var_dump($students);
    }
}