<?php

class HotelReviewModel extends Model
{
   protected $table = 'hotel_reviews';
   protected $allowedColumns = ['id', "hotel_id", "user_name", "phone",'location_rating', "price_rating", "service_rating", "cleanliness_rating", "amenities_rating","overall_rating", "nights_stayed", "trip_type", "review_text", "review_date","departure_date", "created_at", "updated_at", "deleted_at"];
   protected $hiddenColumns = ['created_at','updated_at','deleted_at'];


   public function getReviewAverageRatings($id)
   {
      $sql = "
         SELECT
         AVG({$this->table}.location_rating) AS avg_location_rating,
         AVG({$this->table}.price_rating) AS avg_price_rating,
         AVG({$this->table}.cleanliness_rating) AS avg_cleanliness_rating,
         AVG({$this->table}.service_rating) AS avg_service_rating,
         AVG({$this->table}.amenities_rating) AS avg_amenities_rating
      FROM
         {$this->table}
      WHERE 
         {$this->table}.hotel_id = :id

      ";

      $param = [":id"=> $id];
      $stmt = $this->_query($sql, $param); 
      
      return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
   }
   public function getReviewCount($conditions =[])
   {
      $params = [];
      
      $sql = "SELECT COUNT(*) AS review_count FROM {$this->table} WHERE ";
      foreach ($conditions as $key => $value) {
         $sql .= "$key = :$key AND ";
         $params[":$key"] = $value;
      }     
      $sql = rtrim($sql, " AND ");
      $stmt = $this->_query($sql, $params);
      return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC)['review_count'] : 0;
   }
}
