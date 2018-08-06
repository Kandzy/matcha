<?php
/**
 * Created by PhpStorm.
 * User: dkliukin
 * Date: 6/8/18
 * Time: 2:28 PM
 */

namespace App\Database;

use PDO;
use App\Models\User;

class DatabaseRequest
{
    private $dbConnect;

    public function __construct($connection)
    {
        if (!empty($connection)) {
            $this->dbConnect = $connection;
        }
    }

    public function createDataBase($dbname)
    {
        try {
            $this->dbConnect->exec("CREATE DATABASE {$dbname}");
        }
        catch (PDOException $ex)
        {
            return 0;
        }
        return 1;
    }

    public function UseDB($dbname)
    {
        try {
            $this->dbConnect->exec("USE {$dbname}");
        }
        catch (PDOException $ex)
        {
            echo "UseDB Connection to data base failed: ".$ex->getMessage()."</br>";
            return 0;
        }
        return 1;
    }

    public function DropConnection()
    {
        $this->dbConnect = NULL;
    }

    public function createTable($name, $ID)
    {
        try {
            $this->dbConnect->exec("CREATE TABLE {$name}({$ID} INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY)");
        }
        catch (PDOException $ex)
        {
            echo "createTable failed: ".$ex->getMessage()."</br>";
            return 0;
        }
        return 1;
    }

    public function clearTable($name)
    {
        try {
            $this->dbConnect->exec("TRUNCATE {$name}");
        }
        catch (PDOException $ex)
        {
            echo "clearTable failed: ".$ex->getMessage()."</br>";
            return 0;
        }
        return 1;
    }

    public function dropTable($name)
    {
        try {
            $this->dbConnect->exec("DROP TABLE {$name}");
        }
        catch (PDOException $ex)
        {
            echo "dropTable failed: ".$ex->getMessage()."</br>";
            return 0;
        }
        return 1;
    }

    public function dropDB($dbname)
    {
        try {
            $this->dbConnect->exec("DROP DATABASE"." ". $dbname);
        }
        catch (PDOException $ex)
        {
            echo "dropDB failed: ".$ex->getMessage()."</br>";
            return 0;
        }
        return 1;
    }

    public function addTableColumn($tableName, $column, $param)
    {
        try {
            $this->dbConnect->exec("ALTER TABLE {$tableName} ADD {$column} {$param}");
        }
        catch (PDOException $ex)
        {
            echo "addTableColumn failed: ".$ex->getMessage()."</br>";
            return 0;
        }
        return 1;
    }

    public function addTableData($Table, $columns, $val)
    {
        try {
            $this->dbConnect->exec("INSERT INTO {$Table}({$columns}) VALUES ({$val})");
        }
        catch (PDOException $ex)
        {
            echo "addTableData failed: ".$ex->getMessage()."</br>";
            return 0;
        }
        return 1;
    }

    public function updateTableData($Table, $Params, $Where)
    {
        try {
            $this->dbConnect->exec("UPDATE {$Table} SET {$Params} WHERE 1=1 AND {$Where}");
        }
        catch (PDOException $ex)
        {
            echo "updateTableData failed: ".$ex->getMessage()."</br>";
            return 0;
        }
        return 1;
    }

    public function deleteTableData($Table, $Where)
    {
        try {
            $this->dbConnect->exec("DELETE FROM {$Table} WHERE 1=1 AND {$Where}");
        }
        catch (PDOException $ex)
        {
            echo "ADD failed: ".$ex->getMessage()."</br>";
            return 0;
        }
        return 1;
    }

    public function findData_ASSOC($Table, $data, $Where)
    {
        $result = 0;
        try {
            $prep = $this->dbConnect->prepare("SELECT {$data} FROM {$Table} WHERE 1=1 AND {$Where}");
            $prep->execute();
            $result = $prep->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex)
        {
            echo "findData_ASSOC failed: ".$ex->getMessage()."</br>";
        }
        return $result;
    }

    public function findData_OBJ($Table, $data, $Where)
    {
        $result = 0;
        try {
            $prep = $this->dbConnect->prepare("SELECT {$data} FROM {$Table} WHERE 1=1 AND {$Where}");
            $prep->execute();
            $result = $prep->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOException $ex)
        {
            echo "findData_OBJ failed: ".$ex->getMessage()."</br>";
        }
        return $result;
    }

    public function findData_CLASS($Table, $data, $Where, $model)
    {
        $result = 0;
        try {
            $prep = $this->dbConnect->prepare("SELECT {$data} FROM {$Table} WHERE 1=1 AND {$Where}");
            $prep->execute();
            $result = $prep->fetchAll(PDO::FETCH_CLASS, $model);
        }
        catch (PDOException $ex)
        {
            echo "findData_OBJ failed: ".$ex->getMessage()."</br>";
        }
        return $result;
    }
}