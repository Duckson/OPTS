<?php
class Config{
    public $db;// (1) нельзя создать подключение не в методе, поэтому просто объявляем поле
    private function __construct(){ // (2) вот наш метод который создаст подключение
        $this->db=new mysqli('localhost', 'root', 'root', "practice");
        $this->db->set_charset('utf8');
    }
    // но мы не хотим каждый раз создавать новое подключение и плодить объекты конфигов
    private static $instance=null;
    public static function get(){ // (3) делаем статический метод
        // который создаст объект конфига если его ещё нет
        // а если есть то вернёт сущесвуюущий
        if(!Config::$instance){
            Config::$instance = new Config();
        }
        return Config::$instance;
    }

    public static function Loader($class)
    {
        $full_class_name = explode('\\', $class);
        list($namespace, $class) = $full_class_name;
        $path = $_SERVER['DOCUMENT_ROOT'] . '/OPTS/';

        include $path . $namespace. '/' . $class . '.php';
    }
}