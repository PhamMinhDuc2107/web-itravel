<?php

class HotelAmenityModel extends Model
{
   protected $table = 'hotel_amenities';
   protected $allowedColumns = ['hotel_id', 'amenity_id', "created_at"];
   protected $hiddenColumns = ['created_at','updated_at','deleted_at'];
   public function getAmenitiesByHotelId($hotel_id)
   {
      $sql = "
         SELECT $this->table.*, a.name,a.id, a.category_id
         FROM $this->table
         JOIN amenities a ON $this->table.amenity_id = a.id
         WHERE $this->table.hotel_id = :hotel_id
      ";

      $stmt = $this->_query($sql, ['hotel_id' => $hotel_id]);
      return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
   }
   public function getAmenities()
   {
      $sql = "
         SELECT $this->table.*, a.name, a.id
         FROM $this->table
         JOIN amenities a ON $this->table.amenity_id = a.id
      ";

      $stmt = $this->_query($sql);
      return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
   }
   public function getHotelAmenityCategory($conditions) {
      $sql = "
         SELECT DISTINCT ac.name, ac.image as image, ac.id
         FROM hotel_amenities ha
         JOIN amenities a ON ha.amenity_id = a.id
         JOIN amenity_categories ac ON a.category_id = ac.id
      ";
      $params = [];
      foreach ($conditions as $key => $value) {
         $sql .= "WHERE $key = :$key AND";
         $params[":$key"] = $value;
      }
      $sql = trim($sql," AND");
      $stmt = $this->_query($sql, $params);
      return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
   }

}
