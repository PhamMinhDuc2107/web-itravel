<?php

class HotelImageModel extends Model
{
   protected $table = 'hotel_images';
   protected $allowedColumns = ['id', 'hotel_id', "image", "created_at", "updated_at", "deleted_at"];
   protected $hiddenColumns = ['created_at','updated_at','deleted_at'];
}