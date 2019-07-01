<?php
class Database {

    protected static $_pdo;

    public static function get_pdo()
    {
      	
        if (empty(static::$_pdo))
        {
            $config =
              [
                'host'   => 'localhost',
              	'port'	 =>	'3306',
                'dbname' => 'test',
                'user'   => 'calendar',
                'passw'  => 'lololo',
            ];

            static::$_pdo = new PDO('mysql:host=' . $config['host'] .';dbname=' . $config['dbname'],
                'root', 
                '');
        }
				static::$_pdo->exec('SET NAMES "utf8";');
        return static::$_pdo;
    }

}