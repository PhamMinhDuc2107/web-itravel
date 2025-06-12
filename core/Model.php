<?php

class Model extends Database
{
   protected $table;
   protected $allowedColumns = [];
   protected $hiddenColumns = [];
   protected  $limit = 10;
   protected  $orderBy = "id";
   protected $order = "ASC";
   protected $offset = 0;
   public function __construct()
   {
      parent::__construct();
   }

   public function all()
   {
      try {
         $sql = "SELECT * FROM $this->table ORDER BY $this->orderBy $this->order";
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
         $sql = "SELECT * FROM $this->table ORDER BY $this->orderBy $this->order LIMIT $this->limit OFFSET $this->offset";
         $params = [];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
   public function find($value, $column = "id")
   {
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
   public function where($conditions,$pagi = false)
   {
      try {
         if (!is_array($conditions) || empty($conditions)) {
            throw new Exception("Invalid conditions");
         }

         $sql = "SELECT * FROM $this->table WHERE ";
         $params = [];
         $clauses = [];

         foreach ($conditions as $column => $value) {
            if (!$this->isAllowedColumn($column)) {
               throw new Exception("Invalid column: $column");
            }

            if (is_array($value)) {
               $placeholders = implode(", ", array_map(function ($key) {
                  return ":$key";
               }, array_keys($value)));

               $clauses[] = "$column IN ($placeholders)";
               foreach ($value as $k => $v) {
                  $params[":$k"] = $v;
               }
            } else {
               $clauses[] = "$column = :$column";
               $params[":$column"] = $value;
            }
         }

         $sql .= implode(" AND ", $clauses);
         $sql .= " ORDER BY {$this->orderBy} {$this->order}";
         if ($pagi) {
            $sql .= " LIMIT {$this->limit} OFFSET {$this->offset}";
         }
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
         error_log("Error: " . $e->getMessage());
         return null;
      }
   }
   public function whereIn(string $column, array $values)
   {
      try {
         if (!$this->isAllowedColumn($column)) {
               throw new Exception("Invalid column: $column");
         }
         if (empty($values)) {
               return [];
         }

         $placeholders = rtrim(str_repeat('?,', count($values)), ',');

         $sql = "SELECT * FROM $this->table WHERE $column IN ($placeholders) ORDER BY {$this->orderBy} {$this->order}";
         $stmt = $this->_con->prepare($sql);

         foreach ($values as $k => $val) {
               $stmt->bindValue($k + 1, $val);
         }

         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
         error_log("whereIn Error: " . $e->getMessage());
         return null;
      }
   }

   public function insert(array $data): bool
   {
      try {
         if (empty($data)) {
            return false;
         }
         foreach (array_keys($data) as $key) {
            if (!$this->isAllowedColumn($key)) {
               throw new Exception("Invalid column: $key");
            }
         }
         $params = [];
         $columns = implode(",", array_keys($data));
         $placeholders = ":" . implode(",:", array_keys($data));
         $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
         foreach ($data as $key => $value) {
            $params[":$key"] = $value;
         }
         $stmt = $this->_query($sql, $params);
         return (bool)$stmt->rowCount();
      } catch (PDOException $e) {
         error_log("Insert Error: " . $e->getMessage());
         return false;
      }
   }

   public function update(array $data, $val, $column = "id"): bool
   {
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
         $params[":$column"] = $val;
         $stmt = $this->_query($sql, $params);
         return $stmt->rowCount() > 0;
      } catch (PDOException $e) {
         error_log("Update Error: " . $e->getMessage());
         return false;
      }
   }

   public function delete($id, $col = "id"): bool
   {
      try {
         $sql = "DELETE FROM $this->table WHERE $col = :$col";
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


   public function getCount($where = false, $params = [], $condi = ""): int
   {
      try {
         $sql = "SELECT COUNT(*) FROM $this->table";
         if ($where) {
            $sql .= " WHERE " . $condi;
         }
         $stmt = $this->_query($sql, $params);
         return (int)$stmt->fetchColumn();
      } catch (PDOException $e) {
         error_log("Count Error: " . $e->getMessage());
         return 0;
      }
   }
   public  function setBaseModel()
   {
      if (Request::has("page", "get")) {
         $page = (int)htmlspecialchars(Request::input("page"));
         $this->setOffset($page);
      }
      if (Request::has("limit", "get")) {
         $limit = (int)htmlspecialchars(Request::input("limit")) ?? $this->limit ?? 10;
         $this->setLimit($limit);
      }
      if (Request::has("order", "get")) {
         $order = htmlspecialchars(Request::input("order"));
         $this->setOrder($order);
      }
      if (Request::has("orderBy", "get")) {
         $orderCol = htmlspecialchars(Request::input("orderBy"));
         $this->setOrderBy($orderCol);
      }
   }
   public function like(array $data)
   {
      try {
         $sql = "SELECT * FROM $this->table WHERE ";
         $params = [];

         foreach ($data as $key => $value) {
            $sql .= " $key LIKE :$key OR ";
            $params[":$key"] = $value;
         }

         $sql = rtrim($sql, "OR ");
         $sql .= " ORDER BY {$this->orderBy} {$this->order} 
                   LIMIT {$this->limit} OFFSET {$this->offset}";
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Query Error: " . $e->getMessage());
         return false;
      }
   }
    public function countLike(array $data)
    {
        try {
            $sql = "SELECT count(*) as total FROM $this->table WHERE ";
            $params = [];

            foreach ($data as $key => $value) {
                $sql .= " $key LIKE :$key OR ";
                $params[":$key"] = $value;
            }
            $sql = rtrim($sql, "OR ");
            $stmt = $this->_query($sql, $params);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res["total"] ?? 0;
        } catch (PDOException $e) {
            error_log("Query Error: " . $e->getMessage());
            return 0;
        }
    }



    public function getTotalPages($where = false, $params = [], $condi = ""): int
   {
      $count = $this->getCount($where, $params, $condi);
      return ceil($count / $this->limit);
   }
   public function setLimit(int $limit)
   {
      $this->limit = $limit;
   }

   public function setOffset(int $offset)
   {
      $this->offset = ($offset - 1) * $this->getLimit();
   }

   public function setOrderBy(string $orderBy)
   {
      $this->orderBy = $orderBy;
   }

   public function setOrder(string $orderBy)
   {
      $this->order = $orderBy;
   }

   public function getLimit(): int
   {
      return $this->limit;
   }

   public function getOffset(): int
   {
      return $this->offset;
   }

   public function getColOrderBy(): string
   {
      return $this->orderBy;
   }

   public function getOrderBy(): string
   {
      return $this->order;
   }
   public function getColumns(): array {
      return array_diff($this->allowedColumns, $this->hiddenColumns);
   }
}
