<?php

class Database
{
   protected $_con;

   public function __construct()
   {
      $this->_con = Connection::getInstance();
      if (!$this->_con) {
         Util::loadError('500', 500);
      }
   }
   public function _query($sql, $params = [])
   {
      $stmt = $this->_con->prepare($sql);
      if ($stmt && !empty($params)) {
         foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
         }
      }
      if ($stmt) {
         $stmt->execute();
         return $stmt;
      }
      return false;
   }
   public function lastInsertId(): int
   {
      return $this->_con->lastInsertId();
   }
   public function beginTransaction()
   {
      if (!$this->_con->inTransaction()) {
         $this->_con->beginTransaction();
      }
   }

   public function commit()
   {
      if ($this->_con->inTransaction()) {
         $this->_con->commit();
      }
   }

   public function rollBack()
   {
      if ($this->_con->inTransaction()) {
         $this->_con->rollBack();
      }
   }
}
