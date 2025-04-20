<?php

class Result extends Controller
{
   private $data;

   public function __construct() {}
   public function index()
   {
      $this->data["title"] = "Thông tin kết quả";
      $this->data['heading'] = "Kết quả";
      $this->data["page"] = "success/index";
      $this->render("layouts/client_layout_empty", $this->data);
   }
}