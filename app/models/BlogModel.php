<?php

class BlogModel extends Model
{
   protected $table = 'blogs';
   protected $allowedColumns =
      [
         "id", "title","slug", "thumbnail", "content", "category_id","author_id","created_at","updated_at","status"
      ];
   public function getBlogs() {
      try {
         $sql = "SELECT $this->table.*, blog_categories.name AS category_name, admins.username AS admin_username
                FROM {$this->table}
                LEFT JOIN blog_categories ON $this->table.category_id = blog_categories.id
                LEFT JOIN admins ON $this->table.author_id = admins.id
                ORDER BY {$this->colOrderBy} {$this->order}
                LIMIT {$this->limit} OFFSET {$this->offset}";
         $params = [];
         $stmt = $this->_query($sql, $params);
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
         error_log("Database Error: " . $e->getMessage());
         return [];
      }
   }


}