<?php
class Tour  extends Controller{
   private $data;
   private $TourModel;
   private $jwt;
   public function __construct(){
      $this->TourModel = $this->model("TourModel");
      $this->jwt = new JwtUtil();
      if(!$this->jwt->checkAuth("token_auth")) {
         Util::redirect("cpanel/login",ErrorResponse::unauthorized("Vui lòng đăng nhập lại"));
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("cpanel/category",ErrorResponse::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index() {
         
   }
}
