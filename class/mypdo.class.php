<?php
// @session_start();
// namespace ropa;

// use PDO;

class MyConnection
{
    private $host = 'localhost';
    private $port = '3306';
    private $username = 'root';
    private $password = '';
    private $dbname = 'carstaging_db';

    public $myPdo;

    function __construct()
    {
        
        try {
            // $this->myPdo = $this->connection();
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8mb4";

            $pdoObj = new PDO($dsn, $this->username, $this->password);
            $pdoObj->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdoObj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->myPdo= $pdoObj;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }

    protected function connection()
    {
        // $dsn1 = 'mysql:host=' . $this->host . '; port=' . $this->port . ';dbname=' . $this->dbname . ';charset=utf8mb4';
        // $_SESSION['dsn1'] = $dsn1;
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8mb4";
        // $_SESSION['dsn2'] = $dsn;

        $pdoObj = new PDO($dsn, $this->username, $this->password);
        $pdoObj->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdoObj->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdoObj;
    }
}

// DataType
// PDO::PARAM_BOOL  ข้อมูล Boolean
// PDO::PARAM_NULL  ข้อมูลค่าว่าง(Null)
// PDO::PARAM_INT   ข้อมูล Integer 
// PDO::PARAM_STR   ข้อมูล String
// PDO::PARAM_LOB   ข้อมูล Object
// PDO::PARAM_STMT  ข้อมูล Recordset

//fetchAll(): Fetch Style
// PDO::FETCH_NUM   คืนค่าเป็น Array ใช้เลขลำดับของคอลัมน์เป็น Index(คอลัมน์แรกคือ 0)
// PDO::FETCH_ASSOC คืนค่าเป็น Array ใช้ชื่อคอลัมน์เป็น Index
// PDO::FETCH_BOTH  คืนค่าเป็น Array ใช้เลขลำดับของคอลัมน์หรือชื่อคอลัมน์เป็น Index
// PDO::FETCH_OBJ   คืนค่าเป็น Object ใช้ชื่อคอลัมน์เป็นชื่อ Property