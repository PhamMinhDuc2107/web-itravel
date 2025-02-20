<?php

class Model extends Database
{
   protected $table;
   protected $allowedColumns = [];

   /**
    * @throws Exception
    */
   public function __construct()
   {
      parent::__construct();
   }

   public function all() {
      try {
         $sql = "SELECT * FROM $this->table";
         $stmt = $this->_query($sql);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }

   public function find($value, $column = "id") {
      try {
         if (!$this->isAllowedColumn($column)) {
            throw new Exception("Invalid column: $column");
         }
         $sql = "SELECT * FROM $this->table WHERE $column = :value";
         $params = [":value" => $value];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
         error_log("Error: " . $e->getMessage());
         return null;
      }
   }

   public function insert(array $data): bool {
      try {
         if (empty($data)) {
            return false;
         }
         $params = [];
         $columns = implode(",", array_keys($data));
         $placeholders = ":" . implode(",:", array_keys($data));
         $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";

         foreach ($data as $key => $value) {
            $params[":$key"] = $value;
         }

         $stmt = $this->_query($sql, $params);
         return (bool)$stmt;
      } catch (PDOException $e) {
         error_log("Insert Error: " . $e->getMessage());
         return false;
      }
   }

   public function update(array $data, $id, $column = "id"): bool {
      try {
         if (empty($data)) {
            return false;
         }
         $params = [];
         $setClause = "";
         foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
            $params[":$key"] = $value;
         }
         $setClause = rtrim($setClause, ", ");
         $sql = "UPDATE $this->table SET $setClause WHERE $column = :$column";
         $params[":$column"] = $id;
         $stmt = $this->_query($sql, $params);
         return $stmt->rowCount() > 0;
      } catch (PDOException $e) {
         error_log("Update Error: " . $e->getMessage());
         return false;
      }
   }

   public function delete($id): bool {
      try {
         $sql = "DELETE FROM $this->table WHERE id = :id";
         $params = [":id" => $id];
         $stmt = $this->_query($sql, $params);
         return (bool)$stmt;
      } catch (PDOException $e) {
         error_log("Delete Error: " . $e->getMessage());
         return false;
      }
   }

   public function isAllowedColumn($column): bool
   {
      return in_array($column, $this->allowedColumns);
   }
}
