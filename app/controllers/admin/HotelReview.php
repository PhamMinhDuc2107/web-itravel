<?php
class HotelReview extends Controller
{
   private $data;
   private $HotelReviewModel;
   private $jwt;
   public function __construct()
   {
      $this->HotelReviewModel = $this->model("HotelReviewModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if (!$checkAuth['success']) {
         Util::redirect("dashboard/login", Response::unauthorized($checkAuth['msg']));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("dashboard/amenityCategory", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index()
   {
      $this->HotelReviewModel->setBaseModel();
      $totalPages = $this->HotelReviewModel->getTotalPages();
      $hotelReviews = $this->HotelReviewModel->get();
      $this->data['hotelReviews'] = $hotelReviews;
      $this->data['totalPages'] = $totalPages;
      $this->data['page'] = "hotelReview/index";
      $this->data['title'] = "Đánh giá của khách hàng";
      $this->render("layouts/admin_layout", $this->data);
   }
}
