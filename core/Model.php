<?php

class Model extends Database
{
   protected $table;
   protected $allowedColumns = [];
   protected  $limit = 10;
   protected  $colOrderBy = "id";
   protected $order = "ASC";
   protected $offset = 0;
   /**
    * @throws Exception
    */
   public function __construct()
   {
      parent::__construct();
   }

   public function all()
   {
      try {
         $sql = "SELECT * FROM $this->table ORDER BY $this->colOrderBy $this->order";
         $params = [];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }

   public function get()
   {
      try {
         $sql = "SELECT * FROM $this->table ORDER BY $this->colOrderBy $this->order LIMIT $this->limit OFFSET $this->offset";
         $params = [];
         $stmt = $this->_query($sql, $params);
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
   public function where($value, $column = "id") {
      try {
         if (!$this->isAllowedColumn($column)) {
            throw new Exception("Invalid column: $column");
         }
         $sql = "SELECT * FROM $this->table WHERE $column = :value";
         $params = [":value" => $value];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

   public function update(array $data, $val, $column = "id"): bool {
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
         var_dump($sql);

         $params[":$column"] = $val;
         $stmt = $this->_query($sql, $params);
         return $stmt->rowCount() > 0;
      } catch (PDOException $e) {
         error_log("Update Error: " . $e->getMessage());
         return false;
      }
   }

   public function delete($id, $col = "id"): bool {
      try {
         $sql = "DELETE FROM $this->table WHERE $col = :id";
         $params = [":$col" => $id];
         $stmt = $this->_query($sql, $params);
         return (bool)$stmt;
      } catch (PDOException $e) {
         error_log("Delete Error: " . $e->getMessage());
         return false;
      }
   }
   public function getLastInsertId()
   {
      return $this->lastInsertId();
   }
   public function isAllowedColumn($column): bool
   {
      return in_array($column, $this->allowedColumns);
   }
   public function setLimit(int $limit)
   {
      $this->limit = $limit;
   }

   public function setOffset(int $offset)
   {
      $this->offset = ($offset - 1) * $this->limit;
   }

   public function setColOrderBy(string $colOrderBy)
   {
      $this->colOrderBy = $colOrderBy;
   }
   public function setOrderBy(string $orderBy)
   {
      $this->order = $orderBy;
   }

   public function getCount(): int
   {
      try {
         $sql = "SELECT COUNT(*) FROM $this->table";
         $stmt = $this->_query($sql);
         return (int)$stmt->fetchColumn();
      } catch (PDOException $e) {
         error_log("Count Error: " . $e->getMessage());
         return 0;
      }
   }
   public function getTotalPages():int  {
      return ceil($this->getCount() / $this->limit);
   }
}
