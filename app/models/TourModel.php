<?php

class TourModel extends Model
{
   protected $table = 'tours'   ;
   protected $allowedColumns = ['id', "code_tour",'name', 'slug',"description","duration","status","category_id","status_hot", "created_at", "updated_at", "deleted_at"];
   public function getTours() {
      try {
         $sql = "
          SELECT 
              {$this->table}.*, 
              categories.name AS category_name,
              dest_loc.name AS destination_name,
              dep_loc.name AS departure_name,
              tpc.adult_price, 
              tpc.child_price, 
              tpc.infant_price, 
              tpc.date,
              MIN(tour_images.image) AS image
          FROM 
              {$this->table}
          LEFT JOIN 
              categories ON {$this->table}.category_id = categories.id
          LEFT JOIN 
              tour_images ON {$this->table}.id = tour_images.tour_id
          LEFT JOIN 
              tour_price_calendar tpc ON {$this->table}.id = tpc.tour_id AND tpc.date = (
                  SELECT 
                      date
                  FROM 
                      tour_price_calendar
                  WHERE 
                      tour_id = {$this->table}.id
                  ORDER BY 
                      ABS(DATEDIFF(CURDATE(), date))
                  LIMIT 1
              )
          LEFT JOIN 
              locations dest_loc   ON {$this->table}.destination_id = dest_loc.id 
          LEFT JOIN 
              locations  dep_loc  ON {$this->table}.departure_id = dep_loc.id 
          GROUP BY
              {$this->table}.id
          ORDER BY {$this->colOrderBy} {$this->order}
          LIMIT {$this->limit} OFFSET {$this->offset}
      ";
         $params = [];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
   public function getNameTours(){
      try {
         $sql = "
          SELECT id, name
          FROM $this->table
          GROUP BY
              {$this->table}.id
          ORDER BY {$this->colOrderBy} {$this->order}
          LIMIT {$this->limit} OFFSET {$this->offset}
      ";
         $params = [];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
}