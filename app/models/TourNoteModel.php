<?php

class TourNoteModel extends Model
{
   protected $table = 'tour_notes'   ;
   protected $allowedColumns = ['id', 'tour_id', "number","title","content","created_at", "updated_at"];
   protected $hiddenColumns = ['created_at','updated_at'];
}