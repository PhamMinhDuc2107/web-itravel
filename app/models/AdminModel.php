<?php

class AdminModel extends Model
{
   protected $table = 'admins'   ;
   protected $allowedColumns = ['id', 'username', 'email', 'password','phone', "created_at", "updated_at", "deleted_at"];
   public function getTotalAdminByLike($username) {
      $sql = " username LIKE :username OR email LIKE :email;";
      $params = [":username" => "%$username%", ":email" => "%$username%"];
      $count = $this->getTotalPages(true, $params,$sql);
      return $count;
   }
}