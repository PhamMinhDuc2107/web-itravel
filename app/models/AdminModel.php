<?php

class AdminModel extends Model
{
   protected $table = 'admins'   ;
   protected $allowedColumns = ['id', 'username', 'email', 'password','phone', "created_at", "updated_at", "deleted_at"];
}