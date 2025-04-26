<?php

class HotelTypeModel extends Model
{
   protected $table = 'hotels';
   protected $allowedColumns = ['id', 'name', "slug", "address", "city", "country", "phone_number", "email", "rating", "price_range", "description", "hotel_type_id ", "created_at", "updated_at", "deleted_at"];
}
