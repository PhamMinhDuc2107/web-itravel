<?php

class HotelTypeModel extends Model
{
   protected $table = 'hotel_amenities';
   protected $allowedColumns = ['hotel_id ', 'amenity_id ', "created_at"];
}
