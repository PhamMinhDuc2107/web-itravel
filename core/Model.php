<?php

class Model extends Database
{
   protected $table;
   protected $allowedColumns = [];

   public function __construct()
   {
      parent::__construct();
   }

   public function all() {
      $sql = "SELECT * FROM $this->table";
      $stmt = $this->_query($sql);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function find($value, $column = "id") {
      if (!$this->isAllowedColumn($column)) {
         die("Invalid column: $column");
      }
      $sql = "SELECT * FROM $this->table WHERE $column = :value";
      $params = [":value" => $value];
      $stmt = $this->_query($sql,  $params);
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }
   public function insert(array $data):bool {
      if (empty($data)) {
         return false;
      }
      $params = [];
      $sql = "INSERT INTO $this->table (";

      foreach ($data as $key => $value) {
         $sql .= "$key,";
      }
      $sql = trim($sql, ",");
      $sql .= ") VALUES (";
      foreach ($data as $key => $value) {
         $sql .= ":$key,";
         $params[":$key"] = $value;
      }
      $sql = rtrim($sql, ","). ")";

      $stmt = $this->_query($sql, $params);
      return (bool)$stmt;
   }
   public function update(array $data,$id,$column = "id"):bool {
      if (empty($data)) {
         return false;
      }
      $sql = "UPDATE $this->table SET ";
      $params = [];
      foreach ($data as $key=>$value) {
         $sql.= "$key = :$key,";
         $params[":$key"] = $value;
      }
      $params[":$column"] = $id;
      $sql = rtrim($sql, ",");
      $sql .= " WHERE $column = :$column";
      $stmt = $this->_query($sql, $params);
      if ($stmt->rowCount() > 0) {
         return true;
      }
      return false;
   }
   public function delete($id): bool
   {
      $sql = "DELETE FROM $this->table WHERE id = :id";
      $params = [":id" => $id];
      $stmt = $this->_query($sql, $params);
      return (bool)$stmt;
   }
   public function isAllowedColumn($column) {
      return in_array($column, $this->allowedColumns);
   }
}
