<?php
 class DB{
     private $host;
     private $login;
     private $password;
     public  $dbname;
     public  $connect;
     public  $result;
    ///  создаем переменные


     /**
      * @param $host
      * @param $login
      * @param $password
      * @param $dbname
      */
     public function __construct($host, $login, $password, $dbname)
     {
         $this->host = $host;
         $this->login = $login;
         $this->password = $password;
         $this->dbname = $dbname;

         $this->connect = new mysqli($host,$login,$password,$dbname);
     }
     /// обьявляем методы конструктора
     /// this это ссылка на вызываемый обьект

    public function All($table1)
    {
        $this->result = $this->connect->query("SELECT * FROM  $table1");
        return $this;
    }
    /// Выбор всех записей из таблицы
    /// query это запрос к базе данных
    /// SELECT * FROM - выбор всех столбцов из таблицы (* означет все стобцы)
    /// чтобы вывести определенный столбец изпользуем SELECT column_name(s) FROM table_name
    public function One($table1,$string)
    {
        $this->result = $this->connect->query("SELECT * FROM $table1" );
        return $this;
    }
    ///fetch_all — Выбирает все строки из результирующего набора и помещает их в массив
    public function WhereOne($table1, $where)
    {
        $this->result = $this->connect->query("SELECT * FROM $table1 WHERE id=$where");
        return $this;
    }
    ///извлекает первую строку результата
     public function WhereAnd($tableName, $condition)
     {
         $this->result = $this->connect->query("SELECT * FROM " . $tableName . " where " . implode(' AND ', $condition));
         return $this;
     }
     public function getAll()
     {
         $arr = [];
         while ($row = $this->result->fetch_assoc()) {
             array_push($arr, $row);
         }
         return $arr;
     }

 }
$db1 = new DB("localhost","root","","practica");
var_dump($db1->One("table1","password")->getAll());
var_dump($db1->WhereOne("table1","3")->getAll());
var_dump($db1->All("table1")->getAll());
var_dump($db1->WhereAnd("table1", ["text = 'i love hot bebra'"])->getAll());

 ?>


