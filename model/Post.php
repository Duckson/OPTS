<?php

class Post
{
    /** public static function getAll()
     {
         $obj_array = [];
          * foreach ($_SESSION['news'] as $news) {
          *     $post_obj = new Post();
          *     $post_obj->title = $news['title'];
          *     $post_obj->text = $news['text'];
          *     $obj_array[] = $post_obj;
          * }
          * return $obj_array; // возвращаем массив объектов
         $sql = new mysqli('localhost', 'root', 'root', "News");
         $result = $sql->query("SELECT * FROM News");
         $news = [];
         while ($row = mysqli_fetch_assoc($result)) {
             $cat_id = $sql->query("SELECT name FROM categories WHERE id='{$row['category']}'");
             $cat_id = $cat_id->fetch_row()[0];
             $news[] = [
                 'id' => $row['id'],
                 'title' => $row['title'],
                 'text' => $row['text'],
                 'category' => $cat_id
             ];
         };
         return $news;

     }

    /public static function getCategories()
    {
        $sql = new mysqli('localhost', 'root', 'root', "News");
        $result = $sql->query("SELECT * FROM categories ORDER BY id;");
        var_dump($result);
        $cats = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $cats[] = [
                'id' => $row['id'],
                'name' => $row['name']
            ];
        }
        return $cats;
    }
    

    public static function addPost($title, $text, $cat)
    {
        /**if (!isset($_SESSION['news'])) $_SESSION['news'] = [];
         * $title = filter_var($_POST["title"], FILTER_SANITIZE_SPECIAL_CHARS);
         * $text = filter_var($_POST["text"], FILTER_SANITIZE_SPECIAL_CHARS);
         *
         * if (!empty($title) && !empty($text))
         * $_SESSION['news'][] = [
         * 'title' => $title,
         * 'text' => $text
         * ];

        $sql = new mysqli('localhost', 'root', 'root', "News");
        $title = filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS);
        $text = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);
        $cat = (int)$cat;

        if (!empty($title) && !empty($text) && !empty($cat)) {

            $sql->query("INSERT INTO news(title, text, category) VALUES('$title', '$text', '$cat')");
        }
    }

    static function addCategory($cat)
    {
        $sql = new mysqli('localhost', 'root', 'root', "News");
        $sql->query("INSERT INTO categories(name) VALUES('$cat')");
    }*/

    public static function Loader($class)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/OPTS/pages/';

        include $path . $class . '.php';
    }

    public static function checkUser($username, $password) {
        $sql = Config::get()->db;;
        $password = md5($password);
        $result = $sql->query("SELECT role FROM users WHERE login='$username' AND password='$password'");

        if($result != 0){
            $result = $result->fetch_array();
            if (!isset($result)) return -1;
            return $result;
        }
        return -1;
    }

    public static function backupDB() {
        $dbhost   = "localhost";
        $dbuser   = "root";
        $dbpwd    = "root";
        $dbname   = "practice";
        $dumpfile = "OTPS.sql";

        passthru("e:/Coding/MAMP/bin/mysql/bin/mysqldump --opt --host=$dbhost --user=$dbuser --password=$dbpwd $dbname > $dumpfile");
    }
}