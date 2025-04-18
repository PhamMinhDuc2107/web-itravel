<?php

class Database {
   protected $_con;

   public function __construct() {
      $this->_con = Connection::getInstance();
      if (!$this->_con) {
         throw new Exception("Database connection failed");
      }
   }
   public function _query($sql, $params = []) {
      if ($this->_con === null) {
         die("Database connection is not initialized.");
      }
      $stmt = $this->_con->prepare($sql);
      if ($stmt && !empty($params)) {
         foreach ($params as $key=>$value) {
            $stmt->bindValue($key, $value,PDO::PARAM_STR);
         }
      }
      if ($stmt) {
         $stmt->execute();
         return $stmt;
      }
      return false;
   }
   public function lastInsertId(): int {
      return $this->_con->lastInsertId();
   }


}
