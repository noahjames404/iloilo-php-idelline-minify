<?php 

include_once "backend/conn.php";

class CRUD {
    public $table = ""; 
    public $primaryKey = "";
    public $columns = [];

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function get($id = ""){

        $returnValue = [];
        $where_clause = "";
        if(!empty($id)){  
            $where_clause = "WHERE {$this->primaryKey} = {$id}";
        }

        $columns = $this->columns;
        $columns[] = $this->primaryKey;
        
        $sql = "SELECT {$this->getColumns($columns)} FROM {$this->table} {$where_clause}";
    
        echo $sql;
        echo "<br>";
        $result = $this->conn->query($sql);
      
        if ($result != null) {
            while ($returnValue[] = $result->fetch_array(MYSQLI_ASSOC));
            if(count($returnValue) > 0) unset($returnValue[count($returnValue)-1]);
        } else {
            echo "not working";
        } 

        return $returnValue;
    }  

    public function update($columns,$id){  
        $sql = "UPDATE {$this->table} SET {$this->toColumns($columns)} WHERE {$this->primaryKey} = {$id}";
     
        echo $sql;
        $result = $this->conn->query($sql);
        

        return $result === TRUE;
    }

    public function create($columns){
        $sql = "INSERT INTO {$this->table} ({$this->toCreateColumns($columns)}) VALUES ({$this->toCreateValues($columns)})";
   
        $result = $this->conn->query($sql);
        

        return $result === TRUE;
    }

    public function delete($id){
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey}=$id";
   
        $result = $this->conn->query($sql);
        

        return $result === TRUE;
    }

    function getColumns($columns){
        $str = "";
        foreach($columns as $col){
            if($str == ""){
                $str = $col;        
            }else {
                $str .= ",$col";
            }
           
        }

        return $str;
    }

    function toColumns($columns){
        $str = "";
        foreach($columns as $row => $key ){
            if($str == ""){
                $str = "$row='$key'";        
            }else {
                $str .= "AND $row='$key'";
            }
           
        }

        return $str;
    }

    function toCreateColumns($columns){
        $str = "";
        foreach($columns as $row => $key ){
            if($str == ""){
                $str = "$row";        
            }else {
                $str .= ",$row";
            }
           
        }

        return $str;
    }

    function toCreateValues($columns){ 
        $str = "";
        foreach($columns as $row => $key ){
            if($str == ""){ 
                $str = "'{$key}'";        
            }else {
                $str .= ",'{$key}'";
            }
           
        }

        return $str;
    }

}



