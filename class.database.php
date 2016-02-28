<?php
class Database {
    private $connection,
            $database_error;

    function __construct() {
       $this->openConnection();
    }

    function __destruct() {
       $this->closeConnection();
    }

    private function openConnection() {
        try {
            // DB_HOST, DB_USER, DB_PASS,and DB_NAME must be defined as constants
            $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            mysqli_set_charset($this->connection, 'utf8');
        } catch (Exception $e) {
            exit($e);
        }
    }

    public function closeConnection() {
        if(isset($this->connection)) {
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function numRows($data) {
        return  mysqli_num_rows($data);
    }

    public function affectedRows() {
        if(mysqli_affected_rows($this->connection) >= 1) {
           return true;
        }else {
           return false;
        }
    }

    public function query($sql) {
        $result = mysqli_query($this->connection, $sql);
        
        if (!$result) {
            $this->database_error = mysqli_error($this->connection);
            return false;
        }
       
        return $result;
    }

    public function getError() {
         return isset($this->database_error) ? $this->database_error : false;
    }

    public function insertId() {
        return mysqli_insert_id($this->connection);
    }

    public function fetchData($data) {
        $result = mysqli_fetch_object($data);
        return $result;
    }

    public function cleanData($data, $allowed_tags="") {
        $data = strip_tags($data, $allowed_tags);
        return mysqli_real_escape_string($this->connection, trim($data));;
    }

    public function transactionStart(){
        $this->query("BEGIN");
    }

    public function transactionCommit(){
        $this->query("COMMIT");
    }

    public function transactionRollback(){
        $this->query("ROLLBACK");
    }
}

$Database = new Database();
?>
