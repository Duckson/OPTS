<?php

class DB
{
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


    public static function query($query)
    {
        $sql = Config::get()->db;
        $data = $sql->query($query);
        $result = [];
        echo $sql->error;
        if (!$data)
            throw new \Exception($sql->error);
        while ($row = $data->fetch_assoc()) {
            $result[] = $row;
        }
        return $result;
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
}