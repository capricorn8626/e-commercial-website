<?php

class DB{

    
    protected $servername ="localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "milktea_web";
    public $conn;

    function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }
    function where_not_in($fields = NULL, $array = NULL,$is_where = false){
      $qr ='';
      $string_where = " where ";
      $id_array = array_values($array);
      $values = implode(",",$id_array);
      if ($fields != NULL && $array != NULL) {
      if ($is_where == true) {
      $string_where = ' and';
      }
      $qr .= $string_where." ".$fields." not in (".$values.")";
      }
      return $qr;
    }
    
      function join_table($table = NULL , $query_join = NULL,$type_join = NULL) {
      $qr = '';
      if ($table != NULL && $query_join != NULL && $type_join != NULL) {
      $qr .= ' '.$type_join." JOIN " .$table ." "."ON ".$query_join;
      }
      return $qr;
    }
}

?>