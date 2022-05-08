<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods:GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
class DataBase    
{
    public $host = HOSTNAME;
    public $name = USERTNAME;
    public $pass = PASS;
    public $database = DATABASEBNAME;


    public $link;
    public $error;
    public  function __construct()
    {
        $this->connectDB();
    }
    public function connectDB(){
            $this->link = new mysqli($this->host,$this->name,$this->pass,$this->database);
            if ($this->link -> connect_errno) {
                echo "Failed to connect to MySQL: ".$this->link -> connect_error;
                exit();
              }
    }
    public function send($query){
        $result = $this->link->query($query);
        if($result){
            return $result;
        }else {
            echo "fail";
        }
    }
    public function num($query){
        $result = $this->link->query($query);
        return mysqli_num_rows($result);
    }
} 
class Cookie{
    public static function init()
    {
        //INIT CODE
    }
    public static function set($cname , $cvalue){
        if(!self::check($cname)){
            setcookie($cname, $cvalue, time() + (86400 * 3), "/");   
        }else {
            $_COOKIE[$cname] = $cvalue;
        }
    } 
    public static function get($cname){
        if(self::check($cname)){
            return $_COOKIE[$cname];   
        }else return false;
    } 
    public static function delete($cname){
        if(self::check($cname)){
            setcookie($cname, "", time()-3600, "/");
        }
    } 
    public static function check($cname){
        if(isset($_COOKIE[$cname])){
            return true;
        }else return false;
    }
} 
?>