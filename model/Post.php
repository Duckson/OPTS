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
        $path = $_SERVER['DOCUMENT_ROOT'] . '/OPTS/pages/';

        include $path . $class . '.php';
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

    public static function getAll($result = "all")
    {
        /**$sql = Config::get()->db;
         * $students_table = $sql->query("SELECT * FROM students");
         * $links_table = $sql->query("SELECT * FROM student_app_link");
         * $apps_table = $sql->query("SELECT * FROM applications");
         * $contracts_table = $sql->query("SELECT * FROM contracts");
         * $i = 0;
         *
         * $result_table = $sql->query("SELECT students.last_name, students.first_name, students.patronymic,
         * FROM students
         * INNER JOIN student_app_link
         * WHERE student_app_link.");
         *
         * while ($student = $students_table->fetch_array) $students[] = $student;
         * while ($link = $links_table) $links[] = $link;
         * while ($app = $apps_table) $apps[] = $app;
         * while ($contract = $contracts_table) $contracts[] = $contract;
         *
         * foreach ($students as $student) {
         * $result[$i] = $student;
         * foreach ($links as $link) {
         * if ($link['student_id'] == $student['id']) {
         * $result[$i]['app_id'] = $link['app_id'];
         * foreach ($apps as $app) {
         * if ($app['id'] = $link['app_id']) {
         * $result[$i]['app_start'] = $app['start_date'];
         * $result[$i]['app_end'] = $app['end_date'];
         * foreach ($contract as $contract) {
         * }
         * }
         * }
         * }
         *
         * }
         * }
         * $i++;
         * }
         * return $result;*/
        $sql = Config::get()->db;
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
  LEFT JOIN companies ON (companies.id = contracts.company_id)
");
        echo $sql->error;

        $apps = []; // [int=>[start,end,contract]]
        $contracts = [];// [int=>[text,date]]
        while ($row = $data->fetch_array()) {
            $all[] = $row;

            if ($row['app_id']) {
                if (!isset($apps[$row['app_id']])) {
                    $apps[$row['app_id']] = [
                        'start' => $row['app_start'],
                        'end' => $row['app_end'],
                        'contract_id' => $row['contr_id']
                    ];
                }

                if (!isset($contracts[$row['contr_id']])) {
                    $contracts[$row['contr_id']] = [
                        'text' => $row['contr_text'],
                        'date' => $row['contr_date']
                    ];
                }
            }
        }
        if ($result == "all") return $all;
    }

    public static function addStudent($last_name, $name, $patronymic) {
        $sql = Config::get()->db;
        $name = ucfirst($name);
        $last_name = ucfirst($last_name);
        $patronymic = ucfirst($patronymic);

        $sql->query("INSERT INTO students(first_name, last_name, patronymic) VALUES ('$name', '$last_name', '$patronymic')");
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