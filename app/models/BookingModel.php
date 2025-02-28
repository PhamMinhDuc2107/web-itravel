<?php

class BookingModel extends Model
{
   protected $table = 'bookings';
   protected $allowedColumns =
      [
         "id", "booking_code", "tour_id", "customer_name", "customer_email", "customer_phone", "departure_date",
         "num_adults", "num_children", "num_infants", "total_price", "status", "payment_status", "payment_method", "notes", "booking_date", "created_at", "updated_at"
      ];

   public function getBookings($isSort = true)
   {
      try {
         $sql = "SELECT
                      $this->table.*,
                      tours.name AS tour_name
                  FROM
                      $this->table
                  JOIN
                      tours ON $this->table.tour_id = tours.id";;
         if ($isSort) {
            $sql .=" ORDER BY {$this->colOrderBy} {$this->order}
                   LIMIT {$this->limit} OFFSET {$this->offset}";
         }
         $params = [];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
   public function getMonthlyBookingSummary($month) {
      try {
         $sql = "SELECT COUNT(id) AS total_order_monthly,SUM(total_price) AS total_price_monthly
                FROM $this->table
                WHERE MONTH($this->table.booking_date) = :m  AND YEAR($this->table.booking_date) =YEAR(CURDATE())";
         $params = [":m" => $month];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
   public function getDailyBookingRevenue ($month) {
      try {
         $sql = "SELECT DATE(booking_date) AS ngay, SUM(total_price) AS total_price_day FROM $this->table WHERE MONTH(booking_date) = :m AND YEAR(booking_date) = YEAR(CURDATE()) GROUP BY DATE(booking_date);";
         $params = [":m" => $month];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
   public function getColumns(): array
   {
      return $this->allowedColumns;
   }
}