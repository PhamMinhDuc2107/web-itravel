<?php

class HotelReviewImageModel extends Model
{
   protected $table = 'hotel_review_images';
   protected $allowedColumns = ['id', "review_id", "image", "created_at"];
}
