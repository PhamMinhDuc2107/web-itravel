<?php

class Result extends Controller
{
   private $data;
   private $BookingModel;

   public function __construct()
   {
      $this->BookingModel = $this->model("BookingModel");
   }
   public function index()
   {
      $res = Request::input("data", null);
      if ($res !== null && isset($res['bookingCode'])) {
         $res = json_decode(base64_decode($res[0]), true);
         $booking = $this->BookingModel->find($res['bookingCode'], "booking_code");
         if ($booking) {
            $booking = $this->BookingModel->getBookingById($booking['id']);
         }
         $this->data['booking'] = $booking;
      }
      $this->data["title"] = "Thông tin kết quả";
      $this->data['heading'] = $res['title'] ?? "Cảm ơn bạn đã đặt tour du lịch";
      $this->render("layouts/client_layout_result", $this->data);
   }
}
