<?php

class HotelTypeModel extends Model
{
   protected $table = 'hotel_types';
   protected $allowedColumns = ['id', 'name', "created_at", "updated_at", "deleted_at"];
}
