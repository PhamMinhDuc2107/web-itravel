<?php

class ConsultationModel extends Model
{
   protected $table = 'consultations';
   protected $allowedColumns = ['id', 'customer_name', 'customer_email', "customer_phone", "tour_preference", "message","status", "created_at"];
   public function getColumns() {
      return $this->allowedColumns;
   }
   public function getTotalConsultation() {
      try {
         $sql = "SELECT  COUNT(id) as total FROM $this->table WHERE status = 0";
         $params = [];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
}