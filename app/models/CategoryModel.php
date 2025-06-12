<?php

class CategoryModel extends Model
{
   protected $table = 'categories'   ;
   protected $allowedColumns = ['id', 'name','slug', 'parent_id',"display_home", "created_at", "updated_at", "deleted_at"];
   protected $hiddenColumns = ['created_at','updated_at','deleted_at'];
}