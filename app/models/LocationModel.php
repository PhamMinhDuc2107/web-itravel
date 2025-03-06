<?php

class LocationModel extends Model
{
   protected $table = 'locations'   ;
   protected $allowedColumns = ['id', 'name', 'slug',"description","image","category","is_departure","is_destination", "created_at", "updated_at"];
   public function getLocations() {
      try {
         $sql = "SELECT $this->table.*, categories.name AS category_name
                FROM {$this->table}
                LEFT JOIN categories ON $this->table.category = categories.id
                ORDER BY {$this->colOrderBy} {$this->order}
                LIMIT {$this->limit} OFFSET {$this->offset}";
         $params = [];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
}