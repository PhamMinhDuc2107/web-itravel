<?php

class AmenityCategoryModel extends Model
{
   protected $table = 'amenity_categories';
   protected $allowedColumns = ['id', 'name', "image", "created_at", "updated_at", "deleted_at"];
}
