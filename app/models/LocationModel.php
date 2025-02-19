<?php

class LocationModel extends Model
{
   protected $table = 'locations'   ;
   protected $allowedColumns = ['id', 'name', 'slug',"description","image","is_departure","is_destination", "created_at", "updated_at"];
}