<?php

class TourModel extends Model
{
   protected $table = 'tours'   ;
   protected $allowedColumns = ['id', 'name', 'slug',"description","duration","status","status_hot", "created_at", "updated_at", "deleted_at"];
}