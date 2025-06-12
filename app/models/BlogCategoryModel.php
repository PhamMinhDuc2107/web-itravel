<?php

class BlogCategoryModel extends Model
{
   protected $table = 'blog_categories';
   protected $allowedColumns =
      [
         "id", "name","slug"
      ];
   protected $hiddenColumns = ['created_at','updated_at','deleted_at'];
}
