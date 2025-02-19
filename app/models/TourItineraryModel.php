<?php

class TourItineraryModel extends Model
{
   protected $table = 'tour_itinerary'   ;
   protected $allowedColumns = ['id', 'tour_id', 'day_number',"title","content","created_at", "updated_at"];
}