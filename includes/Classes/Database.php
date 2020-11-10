<?php
class Database{
    // DB credentials 
    private $host;
    private $db_name;
    private $user;
    private $pass;
    private $charset;
    private $option;
    public $db;
    
    public function __construct()
    {
        $this->connect();
    }

    public function connect(){
        $this->host = 'localhost';
        $this->db_name = 'reporting';
        $this->user = 'root';
        $this->pass = '';
        $this->charset = 'utf8';
        $this->option = array(pdo::ATTR_PERSISTENT);

        try{
//data source name
$dsn = 'mysql:host='.$this->host.';dbname='.$this->db_name.';charset='.$this->charset;

//database connection
$this->db = new PDO($dsn,$this->user,$this->pass,$this->option);
$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

return $this->db;
        }catch(PDOException $e){
            $error = $e->getMessage();
            echo 'failed to connect'.$error;
        }

    }
}
?>