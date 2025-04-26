<?php
class Hotel extends Controller
{
   private $data;
   private $HotelModel;
   public function __construct()
   {
      $this->HotelModel = $this->model("HotelModel");
   }
   public function index() {}
}
