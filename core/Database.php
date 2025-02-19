<?php

class Database {
   protected $_con;

   public function __construct() {
      $this->_con = Connection::getInstance();
      if (!$this->_con) {
         throw new Exception("Database connection failed");
      }
   }

//   public function insert(string $table, array $data) {
//      if (empty($data)) {
//         return false;
//      }
//
//      $fields = implode(", ", array_keys($data));
//      $placeholders = implode(", ", array_fill(0, count($data), "?"));
//
//      $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
//      return $this->_query($sql, array_values($data));
//   }
//
//   public function update(string $table, array $data, $condi) {
//      if (empty($data)) {
//         return false;
//      }
//
//      $updates = [];
//      foreach ($data as $key => $value) {
//         $updates[] = "$key = ?";
//      }
//      $updateStr = implode(", ", $updates);
//
//      $sql = "UPDATE $table SET $updateStr WHERE $condi";
//      return $this->_query($sql, array_values($data));
//   }
//
//   public function delete(string $table, $condi = null) {
//      $sql = "DELETE FROM $table";
//      if (!empty($condi)) {
//         $sql .= " WHERE $condi";
//      }
//
//      return $this->_query($sql);
//   }

   public function _query($sql, $params = []) {
      if ($this->_con === null) {
         die("Database connection is not initialized.");
      }
      $stmt = $this->_con->prepare($sql);
      if ($stmt && !empty($params)) {
         foreach ($params as $key=>$value) {
            $stmt->bindValue($key, $value);
         }
      }
      if ($stmt) {
         $stmt->execute();
         return $stmt;
      }

      return false;
   }

   private function _lastInsertId() {
      return $this->_con->lastInsertId();
   }
}
