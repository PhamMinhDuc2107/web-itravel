<?php

class HotelAmenityModel extends Model
{
   protected $table = 'hotel_amenities';
   protected $allowedColumns = ['hotel_id', 'amenity_id', "created_at"];
   public function getAmenitiesByHotelId($hotel_id)
   {
      $sql = "
         SELECT ha.*, a.name,a.id 
         FROM hotel_amenities ha
         JOIN amenities a ON ha.amenity_id = a.id
         WHERE ha.hotel_id = :hotel_id
      ";

      $stmt = $this->_query($sql, ['hotel_id' => $hotel_id]);
      return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
   }
}
