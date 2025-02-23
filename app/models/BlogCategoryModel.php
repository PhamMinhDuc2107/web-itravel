<?php

class BlogCategoryModel extends Model
{
   protected $table = 'blog_categories';
   protected $allowedColumns =
      [
         "id", "name","slug"
      ];
}
