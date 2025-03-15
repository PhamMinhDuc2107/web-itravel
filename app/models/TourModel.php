<?php

class TourModel extends Model
{
   protected $table = 'tours';
   protected $allowedColumns = ['id', "code_tour", 'name', 'slug', "description", "duration", "status", "category_id", "status_hot", "created_at", "updated_at", "deleted_at"];

   public function getTours($condition = [], $where = false)
   {
      try {
         $params = [];
         $sql = "
            SELECT 
                tours.*, 
                categories.name AS category_name,
                dest_loc.name AS destination_name,
                dep_loc.name AS departure_name,
                tpc.adult_price, 
                tpc.child_price, 
                tpc.infant_price, 
                tpc.date,
                MIN(tour_images.image) AS image
            FROM 
                tours
            LEFT JOIN 
                categories ON tours.category_id = categories.id
            LEFT JOIN 
                tour_images ON tours.id = tour_images.tour_id
            LEFT JOIN 
                tour_price_calendar tpc ON tours.id = tpc.tour_id 
                AND tpc.date = (
                    SELECT date
                    FROM tour_price_calendar
                    WHERE tour_id = tours.id
                    ORDER BY ABS(DATEDIFF(CURDATE(), date)) 
                    LIMIT 1
                )
            LEFT JOIN 
                locations dest_loc ON tours.destination_id = dest_loc.id 
            LEFT JOIN 
                locations dep_loc ON tours.departure_id = dep_loc.id 
        ";

         if ($where && !empty($condition)) {
            $sql .= " WHERE ";
            $whereClauses = [];

            foreach ($condition as $key => $value) {
               $whereClauses[] = "$this->table.$key = :$key";
               $params[":$key"] = $value;
            }

            $sql .= implode(" AND ", $whereClauses);
         }

         $sql .= " GROUP BY {$this->table}.$this->colOrderBy ";
         $sql .= " ORDER BY {$this->colOrderBy} {$this->order} ";
         $sql .= " LIMIT {$this->limit} OFFSET {$this->offset}";
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
   public function getTour($condition)
   {
      try {
         $params = [];
         $sql = "
            SELECT 
                $this->table.*, 
                categories.name AS category_name,
                dest_loc.name AS destination_name,
                dep_loc.name AS departure_name,
                tpc.adult_price, 
                tpc.child_price, 
                tpc.infant_price, 
                tpc.date,
                (SELECT image FROM tour_images WHERE tour_id = $this->table.id ORDER BY id  limit 1) AS image
            FROM 
                $this->table
            LEFT JOIN 
                categories ON $this->table.category_id = categories.id
            LEFT JOIN 
                tour_price_calendar tpc ON $this->table.id = tpc.tour_id 
                AND tpc.date = (
                    SELECT date
                    FROM tour_price_calendar
                    WHERE tour_id = $this->table.id
                    ORDER BY ABS(DATEDIFF(CURDATE(), date)) 
                    LIMIT 1
                )
            LEFT JOIN 
                locations dest_loc ON $this->table.destination_id = dest_loc.id 
            LEFT JOIN 
                locations dep_loc ON $this->table.departure_id = dep_loc.id 
            WHERE $this->table
        ";

         $whereClauses = [];
         foreach ($condition as $key => $value) {
            $whereClauses[] = ".$key = :$key";
            $params[":$key"] = $value;
         }

         $sql .= implode(" AND ", $whereClauses);
         $stmt = $this->_query($sql, $params);
         return $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return null;
      }
   }
   public function searchTours($filters = [])
   {
      try {
         if (empty($filters)) {
            return [];
         }
         $params = [];
         $sql = "
         SELECT
             tours.*,
             categories.name AS category_name,
             dest_loc.name AS destination_name,
             dep_loc.name AS departure_name,
             tpc.adult_price,
             tpc.child_price,
             tpc.infant_price,
             tpc.date,
             MIN(tour_images.image) AS image
         FROM
             tours
         LEFT JOIN
             categories ON tours.category_id = categories.id
         LEFT JOIN
             tour_images ON tours.id = tour_images.tour_id
         LEFT JOIN
             tour_price_calendar tpc ON tours.id = tpc.tour_id
         LEFT JOIN
             locations dest_loc ON tours.destination_id = dest_loc.id
         LEFT JOIN
             locations dep_loc ON tours.departure_id = dep_loc.id
     ";

         $whereClauses = [];

         $searchDate = isset($filters['fromDate']) && !empty($filters['fromDate']) ?
            $filters['fromDate'] : date('Y-m-d');

         $whereClauses[] = "tpc.date = (SELECT MIN(date) FROM tour_price_calendar WHERE tour_id = tours.id AND date >= :searchDate)";
         $params[':searchDate'] = $searchDate;

         if (isset($filters['destinationTo']) && !empty($filters['destinationTo'])) {
            $whereClauses[] = "dest_loc.name = :destinationTo";
            $params[':destinationTo'] = $filters['destinationTo'];
         }

         if (isset($filters['departureFrom']) && !empty($filters['departureFrom'])) {
            $whereClauses[] = "dep_loc.name = :departureFrom";
            $params[':departureFrom'] = $filters['departureFrom'];
         }

         if (isset($filters['fromDate']) && !empty($filters['fromDate'])) {
            $whereClauses[] = "tpc.date >= :fromDate";
            $params[':fromDate'] = $filters['fromDate'];
         }

         if (isset($filters['priceStart']) || isset($filters['priceEnd'])) {
            if (!empty($filters['priceStart']) && !empty($filters['priceEnd'])) {
               $whereClauses[] = "tpc.adult_price BETWEEN :priceStart AND :priceEnd";
               $params[':priceStart'] = $filters['priceStart'];
               $params[':priceEnd'] = $filters['priceEnd'];

            } else if(!empty($filters['priceStart'])) {
               $whereClauses[] = "tpc.adult_price >= :priceStart";
               $params[':priceStart'] = $filters['priceStart'];
            } else if (!empty($filters['priceEnd'])) {
               $whereClauses[] = "tpc.adult_price <= :priceEnd";
               $params[':priceEnd'] = $filters['priceEnd'];
            }
         }

         if (!empty($whereClauses)) {
            $sql .= " WHERE " . implode(" AND ", $whereClauses);

         }

         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
   public function countSearchTours($filters = [])
   {
      try {
         $params = [];
         $whereClauses = [];

         if (isset($filters['destinationTo']) && !empty($filters['destinationTo'])) {
            $whereClauses[] = "dest_loc.name = :destinationTo";
            $params[':destinationTo'] = $filters['destinationTo'];
         }

         if (isset($filters['departureFrom']) && !empty($filters['departureFrom'])) {
            $whereClauses[] = "dep_loc.name = :departureFrom";
            $params[':departureFrom'] = $filters['departureFrom'];
         }

         if (isset($filters['fromDate']) && !empty($filters['fromDate'])) {
            $whereClauses[] = "tpc.date >= :fromDate";
            $params[':fromDate'] = $filters['fromDate'];
         }

         if (isset($filters['priceStart']) && isset($filters['priceEnd'])) {
            if (!empty($filters['priceStart']) && !empty($filters['priceEnd'])) {
               $whereClauses[] = "tpc.adult_price BETWEEN :priceStart AND :priceEnd";
               $params[':priceStart'] = $filters['priceStart'];
               $params[':priceEnd'] = $filters['priceEnd'];
            } elseif (!empty($filters['priceStart'])) {
               $whereClauses[] = "tpc.adult_price >= :priceStart";
               $params[':priceStart'] = $filters['priceStart'];
            } elseif (!empty($filters['priceEnd'])) {
               $whereClauses[] = "tpc.adult_price <= :priceEnd";
               $params[':priceEnd'] = $filters['priceEnd'];
            }
         }

         $whereClauseString = !empty($whereClauses) ? " WHERE " . implode(" AND ", $whereClauses) : "";

         // Truy vấn đếm số lượng tour (tối ưu hóa)
         $countSql = "
            SELECT COUNT(DISTINCT tours.id)
            FROM tours
            LEFT JOIN tour_price_calendar tpc ON tours.id = tpc.tour_id
            LEFT JOIN locations dest_loc ON tours.destination_id = dest_loc.id
            LEFT JOIN locations dep_loc ON tours.departure_id = dep_loc.id
            {$whereClauseString}
            AND tpc.date = (SELECT MIN(date) FROM tour_price_calendar WHERE tour_id = tours.id AND date >= :fromDate)
        ";

         $countStmt = $this->_query($countSql, $params);
         $totalCount = (int) $countStmt->fetchColumn();

         return $totalCount;
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return 0;
      }
   }
   public function getNameTours()
   {
      try {
         $sql = "
          SELECT id, name
          FROM $this->table
          GROUP BY
              {$this->table}.id
          ORDER BY {$this->colOrderBy} {$this->order}
          LIMIT {$this->limit} OFFSET {$this->offset}
      ";
         $params = [];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
}