<?php

class TourModel extends Model
{
	protected $table = 'tours';
	protected $allowedColumns = ['id', "code_tour", 'name', 'slug', "description", "duration", "destinations", "meals", "suitable_for", "ideal_time", "transportation", "promotion", "status", "category_id", "status_hot", "created_at", "updated_at", 'delete_at'];

	public function getTours($condition = [], $where = false, $keyword = null)
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
            INNER JOIN 
                categories ON tours.category_id = categories.id
            INNER JOIN 
                tour_images ON tours.id = tour_images.tour_id
            INNER JOIN 
                tour_price_calendar tpc ON tours.id = tpc.tour_id 
                AND tpc.date = (
                    SELECT date
                    FROM tour_price_calendar
                    WHERE tour_id = tours.id
                    AND date >= CURDATE()
                  ORDER BY date ASC
                    LIMIT 1
                )
            INNER JOIN 
                locations dest_loc ON tours.destination_id = dest_loc.id 
            INNER JOIN 
                locations dep_loc ON tours.departure_id = dep_loc.id 
        ";

			$whereClauses = [];

			if ($where && !empty($condition)) {
				foreach ($condition as $key => $value) {
					$whereClauses[] = "$this->table.$key = :$key";
					$params[":$key"] = $value;
				}
			}

			if (!empty($keyword)) {
				$whereClauses[] = "tours.name LIKE :keyword";
				$params[':keyword'] = '%' . $keyword . '%';
			}

			if (!empty($whereClauses)) {
				$sql .= " WHERE " . implode(" AND ", $whereClauses);
			}

			$sql .= " GROUP BY {$this->table}.{$this->orderBy}";
			$sql .= " ORDER BY {$this->orderBy} {$this->order} ";
			$sql .= " LIMIT {$this->limit} OFFSET {$this->offset}";
			$stmt = $this->_query($sql, $params);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			error_log("Database Error: " . $e->getMessage());
			return [];
		}
	}
	public function countTours($condition = [], $where = false, $keyword = null)
	{
		try {
			$params = [];
			$sql = "
            SELECT COUNT(DISTINCT tours.id) AS total
            FROM tours
            INNER JOIN categories ON tours.category_id = categories.id
            INNER JOIN tour_price_calendar tpc ON tours.id = tpc.tour_id 
                AND tpc.date = (
                    SELECT date
                    FROM tour_price_calendar
                    WHERE tour_id = tours.id
                    AND date >= CURDATE()
                    ORDER BY date ASC
                    LIMIT 1
                )
            INNER JOIN locations dest_loc ON tours.destination_id = dest_loc.id
            INNER JOIN locations dep_loc ON tours.departure_id = dep_loc.id
        ";

			$whereClauses = [];

			// Giữ nguyên các điều kiện giống hàm getTours()
			if ($where && !empty($condition)) {
				foreach ($condition as $key => $value) {
					$whereClauses[] = "$this->table.$key = :$key";
					$params[":$key"] = $value;
				}
			}

			if (!empty($keyword)) {
				$whereClauses[] = "tours.name LIKE :keyword";
				$params[':keyword'] = '%' . $keyword . '%';
			}

			if (!empty($whereClauses)) {
				$sql .= " WHERE " . implode(" AND ", $whereClauses);
			}

			$stmt = $this->_query($sql, $params);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result ? (int)$result['total'] : 0;
		} catch (PDOException $e) {
			error_log("Database Error: " . $e->getMessage());
			return 0;
		}
	}
	public function getAdminTours($condition = [], $where = false, $keyword = null)
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
                AND date >= CURDATE()
                ORDER BY date ASC
                LIMIT 1
            )
        LEFT JOIN 
            locations dest_loc ON tours.destination_id = dest_loc.id 
        LEFT JOIN 
            locations dep_loc ON tours.departure_id = dep_loc.id 
        ";

			$whereClauses = [];

			if ($where && !empty($condition)) {
				foreach ($condition as $key => $value) {
					$whereClauses[] = "tours.$key = :$key";
					$params[":$key"] = $value;
				}
			}

			if (!empty($keyword)) {
				$whereClauses[] = "{$this->table}.name LIKE :keyword";
				$params[':keyword'] = '%' . $keyword . '%';
			}

			if (!empty($whereClauses)) {
				$sql .= " WHERE " . implode(" AND ", $whereClauses);
			}

			$sql .= " GROUP BY $this->table.id ";
			$sql .= " ORDER BY {$this->orderBy} {$this->order} ";
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
            INNER JOIN 
                categories ON $this->table.category_id = categories.id
            INNER JOIN 
                tour_price_calendar tpc ON $this->table.id = tpc.tour_id 
                AND tpc.date = (
                    SELECT date
                    FROM tour_price_calendar
                    WHERE tour_id = $this->table.id
                    ORDER BY ABS(DATEDIFF(CURDATE(), date)) 
                    LIMIT 1
                )
            INNER JOIN 
                locations dest_loc ON $this->table.destination_id = dest_loc.id 
            INNER JOIN 
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
          INNER JOIN categories ON tours.category_id = categories.id
          INNER JOIN tour_images ON tours.id = tour_images.tour_id
          INNER JOIN 
                  tour_price_calendar tpc ON tours.id = tpc.tour_id 
                  AND tpc.date = (
                      SELECT date
                      FROM tour_price_calendar
                      WHERE tour_id = tours.id
                      AND date >= CURDATE()
                    ORDER BY date ASC
                      LIMIT 1
                  )
          INNER JOIN locations dest_loc ON tours.destination_id = dest_loc.id
          INNER JOIN locations dep_loc ON tours.departure_id = dep_loc.id
          ";

			$whereClauses = [];

			if (!empty($filters['destination'])) {
				$whereClauses[] = "dest_loc.slug = :destination";
				$params[':destination'] = $filters['destination'];
			}

			if (!empty($filters['departure'])) {
				$whereClauses[] = "dep_loc.slug = :departure";
				$params[':departure'] = $filters['departure'];
			}
			if (!empty($filters['typeTour'])) {
				$whereClauses[] = "tours.category_id = :category_id";
				$params[':category_id'] = $filters['typeTour'];
			}

			if (!empty($filters['fromDate'])) {
				$whereClauses[] = "tpc.date >= :fromDate";
				$params[':fromDate'] = $filters['fromDate'];
			}

			if (isset($filters['priceStart']) || isset($filters['priceEnd'])) {
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


			if (!empty($whereClauses)) {
				$sql .= " WHERE " . implode(" AND ", $whereClauses);
			}
			$sql .= " GROUP BY {$this->table}.id";

			if (!empty($filters['priceSort']) && in_array($filters['priceSort'], ['asc', "desc"])) {
				$sql .= " ORDER BY tpc.adult_price " . htmlspecialchars($filters["priceSort"]) . "";
			} else {
				$sql .= " ORDER BY {$this->table}.{$this->orderBy} {$this->order} ";
			}
			$page = isset($filters['page']) ? max(1, intval($filters['page'])) : 1;
			$offset = ($page - 1) * $this->limit;
			$sql .= " LIMIT {$this->limit} OFFSET {$offset}";

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
			if (empty($filters)) {
				return 0;
			}

			$params = [];
			$sql = "
            SELECT COUNT(DISTINCT tours.id) AS total
            FROM tours
            INNER JOIN categories ON tours.category_id = categories.id
            INNER JOIN tour_price_calendar tpc ON tours.id = tpc.tour_id 
                AND tpc.date = (
                    SELECT date
                    FROM tour_price_calendar
                    WHERE tour_id = tours.id
                    AND date >= CURDATE()
                    ORDER BY date ASC
                    LIMIT 1
                )
            INNER JOIN locations dest_loc ON tours.destination_id = dest_loc.id
            INNER JOIN locations dep_loc ON tours.departure_id = dep_loc.id
        ";

			$whereClauses = [];

			if (!empty($filters['destination'])) {
				$whereClauses[] = "dest_loc.slug = :destination";
				$params[':destination'] = $filters['destination'];
			}

			if (!empty($filters['departure'])) {
				$whereClauses[] = "dep_loc.slug = :departure";
				$params[':departure'] = $filters['departure'];
			}

			if (!empty($filters['typeTour'])) {
				$whereClauses[] = "tours.category_id = :category_id";
				$params[':category_id'] = $filters['typeTour'];
			}

			if (!empty($filters['fromDate'])) {
				$whereClauses[] = "tpc.date >= :fromDate";
				$params[':fromDate'] = $filters['fromDate'];
			}

			if (isset($filters['priceStart']) || isset($filters['priceEnd'])) {
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

			if (!empty($whereClauses)) {
				$sql .= " WHERE " . implode(" AND ", $whereClauses);
			}

			$stmt = $this->_query($sql, $params);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result ? (int)$result['total'] : 0;
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
				ORDER BY {$this->orderBy} {$this->order}
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
