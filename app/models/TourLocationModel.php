<?php

class TourLocationModel extends Model
{
   protected $table = 'tour_locations'   ;
   protected $allowedColumns = ['id', 'tour_id', 'location_id', "created_at", "updated_at"];
}