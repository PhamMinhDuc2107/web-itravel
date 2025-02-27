<?php

class BannerModel extends Model
{
   protected $table = "banners";
   protected $allowedColumns = ['id', "image","title", "status", "sort_order", "created_at", "updated_at"];
}