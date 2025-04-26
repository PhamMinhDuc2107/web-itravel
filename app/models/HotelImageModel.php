<?php

class HotelTypeModel extends Model
{
   protected $table = 'hotel_images';
   protected $allowedColumns = ['if ', 'hotel_id', "image", "created_at", "updated_at", "deleted_at"];
}
