<?php

class CategoryModel extends Model
{
   protected $table = 'categories'   ;
   protected $allowedColumns = ['id', 'name', 'parent_id', "created_at", "updated_at", "deleted_at"];
}