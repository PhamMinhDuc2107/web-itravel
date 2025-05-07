<?php

class HotelModel extends Model
{
   protected $table = 'hotels';
   protected $allowedColumns = ['id', 'name', "slug", "address", "city", "country", "phone_number", "email", "rating", "price_range", "description", "hotel_type_id", "created_at", "updated_at", "deleted_at"];
   public function getHotels()
   {
      $sql = "
         SELECT 
            $this->table.*,
            ht.name AS hotel_type_name
            FROM hotels
            LEFT JOIN hotel_types ht ON $this->table.hotel_type_id = ht.id
      ";
      $sql .= " GROUP BY {$this->table}.{$this->colOrderBy}";
      $sql .= " ORDER BY {$this->colOrderBy} {$this->order} ";
      $sql .= " LIMIT {$this->limit} OFFSET {$this->offset}";
      $stmt = $this->_query($sql);
      return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
   }
}
