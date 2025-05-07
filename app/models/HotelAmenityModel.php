<?php

class HotelAmenityModel extends Model
{
   protected $table = 'hotel_amenities';
   protected $allowedColumns = ['hotel_id', 'amenity_id', "created_at"];
   public function getAmenitiesByHotelId($hotel_id)
   {
      $sql = "
         SELECT $this->table.*, a.name,a.id 
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
}
