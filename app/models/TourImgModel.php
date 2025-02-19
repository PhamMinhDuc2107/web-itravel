<?php

class TourImgModel extends Model
{
   protected $table = 'tour_images'   ;
   protected $allowedColumns = ['id', 'tour_id', 'image_url',"description","is_thumbnail","order"];
}