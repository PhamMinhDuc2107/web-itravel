<?php

class ConsultationModel extends Model
{
   protected $table = 'consultations'   ;
   protected $allowedColumns = ['id', 'name', 'email', "phone", "tour_preference", "message","status"];
   public function getColumns() {
      return $this->allowedColumns;
   }
}