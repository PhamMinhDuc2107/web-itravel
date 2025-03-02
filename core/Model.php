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

   public function getCount($where= false, $params = [], $condi = ""): int
   {
      try {
         $sql = "SELECT COUNT(*) FROM $this->table";
         if($where){
            $sql .= " WHERE ".$condi;
         }
         $stmt = $this->_query($sql ,$params);
         return (int)$stmt->fetchColumn();
      } catch (PDOException $e) {
         error_log("Count Error: " . $e->getMessage());
         return 0;
      }
   }
   public  function setBaseModel() {
      if (Request::has("page", "get")) {
         $page = (int)htmlspecialchars(Request::input("page"));
         $this->setOffset($page);
      }
      if (Request::has("limit", "get")) {
         $limit = (int)htmlspecialchars(Request::input("limit")) ?? 10;
         $this->setLimit($limit);
      }
      if (Request::has("sortBy", "get") ) {
         $order = htmlspecialchars(Request::input("sortBy"));
         $this->setOrderBy($order);
      }
      if (Request::has("sortCol", "get") ) {
         $orderCol = htmlspecialchars(Request::input("sortCol"));
         $this->setColOrderBy($orderCol);
      }
   }
   public function like(array $data) {
      try {
         $sql = "SELECT * FROM $this->table WHERE ";
         $params = [];

         foreach ($data as $key => $value) {
            $sql .= " $key LIKE :$key OR ";
            $params[":$key"] = $value;
         }

         $sql = rtrim($sql, "OR ");
         $sql .= " ORDER BY {$this->colOrderBy} {$this->order} 
                  LIMIT {$this->limit} OFFSET {$this->offset}";
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Query Error: " . $e->getMessage());
         return false;
      }
   }


   public function getTotalPages($where = false, $params = [],$condi=""):int  {
      $count = $this->getCount($where, $params, $condi);
      return ceil($count / $this->limit);
   }
}
