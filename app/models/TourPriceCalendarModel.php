<?php

class TourPriceCalendarModel extends Model
{
   protected $table = 'tours'   ;
   protected $allowedColumns = ['id', 'tour_id', 'date',"adult_price","child_price","infant_price","created_at", "updated_at"];
}