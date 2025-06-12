<?php

class AmenityModel extends Model
{
   protected $table = 'amenities';
   protected $allowedColumns = ['id', 'name', "category_id", "created_at", "updated_at", "deleted_at"];
   protected $hiddenColumns = ['created_at','updated_at','deleted_at'];
}
