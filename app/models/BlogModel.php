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
         $sql = "SELECT $this->table.*, blog_categories.name AS category_name, admins.username AS admin_username, blog_categories.slug as category_slug
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
   public function getBlogByStatus($status) {
      try {
         $sql = "SELECT $this->table.*, blog_categories.name AS category_name, admins.username AS admin_username, blog_categories.slug as category_slug
                FROM {$this->table}
                LEFT JOIN blog_categories ON $this->table.category_id = blog_categories.id
                LEFT JOIN admins ON $this->table.author_id = admins.id
                Where $this->table.status = :status
                ORDER BY {$this->colOrderBy} {$this->order}
                LIMIT {$this->limit} OFFSET {$this->offset}";
         $params = [":status" => $status];
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