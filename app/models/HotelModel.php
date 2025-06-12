<?php

class HotelModel extends Model
{
   protected $table = 'hotels';
   protected $allowedColumns = ['id', 'name', "slug", "address", "city", "country", "phone_number", "email", "rating", "price", "description", "hotel_type_id", "created_at", "updated_at", "deleted_at"];
   protected $hiddenColumns = ['created_at','updated_at','deleted_at'];
   public function getHotels()
   {
      $sql = "
         SELECT 
            $this->table.*,
            ht.name AS hotel_type_name,
            AVG(hr.overall_rating) as avg_overall_rating,
            count(hr.overall_rating) as total_review
            FROM $this->table
            LEFT JOIN hotel_types ht ON $this->table.hotel_type_id = ht.id
            LEFT JOIN hotel_reviews hr ON $this->table.id = hr.hotel_id 
      ";
      $sql .= " GROUP BY {$this->table}.{$this->orderBy}";
      $sql .= " ORDER BY {$this->orderBy} {$this->order} ";
      $sql .= " LIMIT {$this->limit} OFFSET {$this->offset}";
      $stmt = $this->_query($sql);
      return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
   }
   public function filterHotelsByRange($data) {
      $whereClauses = [];
      $params = [];
      $sql = "
       SELECT
         $this->table.*,
         ht.name AS hotel_type_name,
         AVG(hr.overall_rating) as avg_overall_rating,
         count(hr.overall_rating) as total_review
      FROM $this->table
      LEFT JOIN hotel_types ht ON $this->table.hotel_type_id = ht.id
      LEFT JOIN hotel_reviews hr ON $this->table.id = hr.hotel_id 
      
      "; 
      $budgets = isset($data['budget']) ? $data['budget'] :'';
      $ratings = isset($data['sortRating']) ? $data['sortRating'] :"";
      $hotelTypes = isset($data['hotelType']) ? $data['hotelType'] :"";
      if (!empty($budgets)) {
         $budgetConditions = [];
         foreach ($budgets as $index => $range) {
            $startKey = ":budget_start$index";
            $endKey = ":budget_end$index";
            $budgetConditions[] = "(price BETWEEN $startKey AND $endKey)";
            $params[$startKey] = (int)$range['start'];
            $params[$endKey] = (int)$range['end'];
         }
         $whereClauses[] = '(' . implode(' OR ', $budgetConditions) . ')';
      }


      if (!empty($hotelTypes)) {
         $placeholders = [];
         foreach ($hotelTypes as $index => $typeId) {
            $key = ":hotel_type_$index";
            $placeholders[] = $key;
            $params[$key] = (int)$typeId;
         }
         $whereClauses[] = "$this->table.hotel_type_id IN " ."(" . implode(', ', $placeholders) . ")";
      }

      if(!empty($whereClauses)) {
         $sql .= ' WHERE ' .implode(' AND ', $whereClauses);
      }
      $sql .= " GROUP BY $this->table.id ";
      $ratingConditions = [];
      if (!empty($ratings)) {

         foreach ($ratings as $index => $range) {
            $startKey = ":rating_start$index";
            $endKey = ":rating_end$index";
            $ratingConditions[] = "(AVG(hr.overall_rating) BETWEEN $startKey AND $endKey)";
            $params[$startKey] = (float)$range['start'];
            $params[$endKey] = (float)$range['end'];
         }
         if($ratingConditions) {
            $sql .= " HAVING  " .'(' . implode(' OR ', $ratingConditions) . ')';
         };
      }
      $sql .= " ORDER BY {$this->orderBy} {$this->order} ";
      $sql .= " LIMIT {$this->limit} OFFSET {$this->offset}";
      $stmt = $this->_query($sql, $params);
      return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
   }
}
