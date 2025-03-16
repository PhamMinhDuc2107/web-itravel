<?php

class BlogModel extends Model
{
   protected $table = 'blogs';
   protected $allowedColumns =
      [
         "id", "title","slug", "thumbnail", "content", "category_id","author_id",'status_hot',"created_at","updated_at","status"
      ];
   public function getBlogs($condition = [], $getAll = false, $keyword = null)
   {
      try {
         $sql = "SELECT $this->table.id,$this->table.title, $this->table.slug, $this->table.status,$this->table.thumbnail, $this->table.created_at , blog_categories.name AS category_name, admins.username AS admin_username, blog_categories.slug as category_slug
                FROM {$this->table}
                LEFT JOIN blog_categories ON $this->table.category_id = blog_categories.id
                LEFT JOIN admins ON $this->table.author_id = admins.id";

         $params = [];
         $whereClauses = [];

         if (!empty($condition)) {
            foreach ($condition as $key => $value) {
               $whereClauses[] = "$this->table.$key = :$key";
               $params[":$key"] = $value;
            }
         }

         if (!empty($keyword)) {
            $whereClauses[] = "$this->table.title LIKE :keyword";
            $params[':keyword'] = '%' . $keyword . '%';
         }

         if (!empty($whereClauses)) {
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
         }

         $sql .= " ORDER BY $this->table"."."."{$this->colOrderBy} {$this->order}";

         if (!$getAll) {
            $sql .= " LIMIT {$this->limit} OFFSET {$this->offset}";
         }
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }
   public function getBlogById($id) {
      try {
         $sql = "SELECT b.*, bc.name AS category_name, a.username AS admin_username
                FROM {$this->table} AS b
                LEFT JOIN blog_categories AS bc ON b.category_id = bc.id
                LEFT JOIN admins AS a ON b.author_id = a.id
                WHERE b.id = :id";

         $params = [":id" => $id];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }



}