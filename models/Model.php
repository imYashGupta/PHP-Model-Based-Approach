<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Calcutta');
define('host', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'test');
define('site_url', $_SERVER['SERVER_NAME']);
define('site_name', 'website.com' );
define('site_email','example@website.com');

$GLOBALS["conn"]=mysqli_connect(host,dbuser,dbpass,dbname);

class Model {

    public $created_at;
    public $updated_at;
    public $setters = [];
    function __construct()
    {
        foreach($this->coloumn as $column){
            $this->$column = $column;
            
        }
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
        
    }



    public function save()
    {
        $keys="";
        $values="";
        foreach($this->coloumn as $column){
            if(method_exists($this,"set".$column)){
                $methodName= "set".$column;
                $this->$column = $this->$methodName($this->$column);
                array_push($this->setters,"set".$column);
            }
            $keys .=$column.",";
            $values .="'".mysqli_real_escape_string($GLOBALS["conn"],$this->$column)."',";
        }
        $tbl_keys= substr($keys,0,-1);
        $tbl_value=substr($values,0,-1);
        $query=mysqli_query($GLOBALS["conn"],"INSERT INTO $this->table($tbl_keys) VALUES ($tbl_value)");
        $this->id=mysqli_insert_id($GLOBALS["conn"]);
        return $this;
    }

    public function getStatement($statement = false)
    {   

        // return $this->table;
        if($statement){
            $query=mysqli_query($GLOBALS["conn"],"SELECT * FROM $this->table WHERE user_id=$statement");
        }else{
            $query=mysqli_query($GLOBALS["conn"],"SELECT * FROM ".$this->table);
        }

        $array = [];
        while($row=mysqli_fetch_object($query)){
            array_push($array,$this->populate($row));
        }
        
        return ($array);
    }

    public static function get($statement=false)
    {   

        $class =static::class;
        $model=new $class();
        return $model->getStatement($statement);
    }

    public function populate($object)
    {
        $class = get_called_class();
        $model = new $class();
        foreach($model->coloumn as $column){
            $model->$column = $object->$column;
        }
        return $model;
    }




}
