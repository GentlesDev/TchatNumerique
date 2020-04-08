<?php


/*
 * Database configuration settings used by PDO.
 */
$con = MySQLi_connect(
  "localhost", //Server host name.
  "root", //Database username.
  "", //Database password.
  "chat_num" //Database name or anything you would like to call it.
);
//Check connection
if (MySQLi_connect_errno()) {
  echo "Failed to connect to MySQL: " . MySQLi_connect_error();
}

  class Database {

    private $pdo;

    function __construct(){
      $this->pdo = new PDO('mysql:host=localhost;
                            dbname=chat_num;
                            charset=UTF8',
                            'root',
                            '');
    }

    public function executeSql($sql, array $values = [])
    {
      $this->pdo->exec('SET NAMES UTF8');
      $query = $this->pdo->prepare($sql);

      $query->execute($values);
    }

    public function query($sql, array $values = [])
    {
        $this->pdo->exec('SET NAMES UTF8');

        $query = $this->pdo->prepare($sql);

        $query->execute($values);

        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function queryOne($sql, array $values = [])
    {
        $this->pdo->exec('SET NAMES UTF8');

        $query = $this->pdo->prepare($sql);

        $query->execute($values);

        return $query->fetch(PDO::FETCH_ASSOC);

    }

  }
