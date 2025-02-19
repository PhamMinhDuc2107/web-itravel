<?php

class BookingModel extends Model
{
   protected $table = 'bookings';
   protected $allowedColumns =
      [
         "id", "booking_code", "tour_id", "customer_name", "customer_email", "customer_phone", "departure_date",
         "num_adults", "num_children","num_infants", "total_price", "status", "payment_status","payment_method","notes","booking_date","created_at", "updated_at"
         ];
}