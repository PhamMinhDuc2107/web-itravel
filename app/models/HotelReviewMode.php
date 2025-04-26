<?php

class HotelTypeModel extends Model
{
   protected $table = 'hotel_reviews';
   protected $allowedColumns = ['id', "hotel_id", "user_name", 'location_rating', "price_rating", "service_rating", "cleanliness_rating", "amenities_rating", "nights_stayed", "trip_type", "review_text", "review_date", "created_at", "updated_at", "deleted_at"];
}
