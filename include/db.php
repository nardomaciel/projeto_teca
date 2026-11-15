<?php
class DB{
    private static $instance;

    public static function getInstance(){
        if(self::$instance != null){
            return self::$instance;
        }

        $config = require __DIR__ . '/config.php';
        $opcoes = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        if($config['driver'] == 'sqlite'){
            $novo = !file_exists($config['sqlite']);
            self::$instance = new PDO('sqlite:' . $config['sqlite'], null, null, $opcoes);
            if($novo){
                self::$instance->exec(file_get_contents(__DIR__ . '/../database/projeto_teca.sqlite.sql'));
            }
            return self::$instance;
        }

        $dsn = "mysql:host={$config['host']};dbname={$config['banco']};charset=utf8mb4";
        self::$instance = new PDO($dsn, $config['usuario'], $config['senha'], $opcoes);

        return self::$instance;
    }
}
