<?php
class Model extends Database {
    public function __construct(){
        parent::__construct();
    }

    public function read($table, $cond = NULL, $fields = "*") {
        $cond = $cond != NULL ? " WHERE ".$cond : "";
        $query = "SELECT ".$fields." FROM ".$table.$cond;
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function insert($table, $fields, $values) {
        $vstring = $this->arrayToString($values);
        $fstring = $this->arrayToString($fields, FALSE);
        $query = "INSERT INTO ".$table."(".$fstring.") VALUES(".$vstring.");";
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
    }

    public function update($table, $columns, $cond = NULL){
        $cond = $cond != NULL ? " WHERE ".$cond : "";
        $query = "UPDATE ".$table." SET ".$columns.$cond.";";
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
    }

    private function arrayToString($values, $quotes = TRUE) {
        $vstring = "";
        $q = $quotes ? "'": "";
        for($i = 0; $i < sizeof($values);$i++){
            $vstring .= $q.mysqli_escape_string($this->conn, $values[$i]).$q.",";
        }
        return rtrim($vstring, ",");
    }
}
?>

