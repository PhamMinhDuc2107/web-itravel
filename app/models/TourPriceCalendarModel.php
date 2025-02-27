<?php

class TourPriceCalendarModel extends Model
{
   protected $table = 'tour_price_calendar';
   protected $allowedColumns = ['id', 'tour_id', 'date',"adult_price","child_price","infant_price","created_at", "updated_at"];

}