<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Booking extends Controller
{
   private $data = [];
   private $BookingModel;
   private $TourModel;
   /**
    * @var JwtUtil
    */
   private $jwt;

   function __construct()
   {
      $this->BookingModel = $this->model("BookingModel");
      $this->TourModel = $this->model("TourModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if (!$checkAuth['success']) {
         Util::redirect("cpanel/login", Response::unauthorized($checkAuth['msg']));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("cpanel/category", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }

   public function index(): void
   {
      Util::setBaseModel($this->BookingModel);
      $totalPages = $this->BookingModel->getTotalPages();
      $bookings = $this->BookingModel->getBookings();
      $tours = $this->TourModel->getNameTours();
      $this->data['totalPages'] = $totalPages;
      $this->data['title'] = "Quản lý đặt hàng";
      $this->data['page'] = "booking/index";
      $this->data['bookings'] = $bookings;
      $this->data['tours'] = $tours;
      $this->render("layouts/admin_layout", $this->data);
   }

   public function update($id)
   {
      $booking = $this->BookingModel->find(htmlspecialchars($id));
      if (empty($booking)) {
         Util::redirect("cpanel/booking",Response::notFound("Khoogn tìm thấy booking"));
      }
      $tours = $this->TourModel->getNameTours();

      $this->data['page'] = 'index';
      $this->data['title'] = "Chỉnh sửa thông tin đặt hàng";
      $this->data['page'] = "booking/form";
      $this->data['booking'] = $booking;
      $this->data['tours'] = $tours;
      $this->render("layouts/admin_layout", $this->data);
   }

   public function updatePost()
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("cpanel/booking", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $id = Request::input("id");
      if ($id <=  0 || !is_numeric($id)) {
         Util::Redirect("cpanel/booking", Response::badRequest("Id không hợp lệ"));
      }
      $checkId = $this->BookingModel->find($id);
      if (!$checkId) {
         Util::Redirect("cpanel/booking", Response::notFound("Không tìm thấy booking này"));
      }
      $tourId = htmlspecialchars(Request::input("tour_id") ?? "");
      $customerName = htmlspecialchars(Request::input("customer_name") ?? "");
      $customerPhone = htmlspecialchars(Request::input("customer_phone") ?? "");
      $customerEmail = htmlspecialchars(Request::input("customer_email") ?? "");
      $departureDate = htmlspecialchars(Request::input("departure_date")?? "");
      $numberAdults = (int)htmlspecialchars(Request::input("num_adults")??"");
      $numberChildren = (int)htmlspecialchars(Request::input("num_children")?? "");
      $numberInfants = (int)htmlspecialchars(Request::input("num_infants") ?? "");
      $totalPrice = (int)htmlspecialchars(Request::input("total_price") ?? "");
      $notes = htmlspecialchars(Request::input("notes") ?? "");
      $status = htmlspecialchars(Request::input("status"));
      $status = $this->getStatus($status);
      $statusPayment = htmlspecialchars(Request::input("payment_status"));
      $statusPayment = $this->getStatusPayment($statusPayment);
      $data = [
         "tour_id"=>$tourId, "customer_name"=>$customerName, "customer_phone"=>$customerPhone,"customer_email" => $customerEmail,
         "departure_date"=>$departureDate, "num_adults"=>$numberAdults,"num_children"=>$numberChildren,"num_infants"=>$numberInfants,
         "total_price"=>$totalPrice, "notes"=>$notes,"status"=>$status, "payment_status"=>$statusPayment
      ];

      $res = $this->BookingModel->update($data, $id);
      if (!$res) {
         Util::Redirect("cpanel/booking", Response::internalServerError("Cập nhật không thành công"));
      }
      Util::redirect("cpanel/booking", Response::success("Cập nhật thành công"));
   }

   public function delete(): void
   {
      if (Request::isMethod("POST")) {
         Util::redirect('cpanel/booking');
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("cpanel/booking", Response::badRequest("ID không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("cpanel/booking", Response::badRequest("ID không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $this->BookingModel->delete($id);
      }
      Util::redirect("cpanel/booking", Response::badRequest("Xóa thành công"));
   }
   private function getStatus($status): string {
      return match ($status) {
         "1" => "pending",
         "2" => "confirmed",
         default => "cancelled"
      };
   }
   private function getStatusPayment($status): string {
      return match ($status) {
         "1" => "unpaid",
         "2" => "paid",
         default => "refunded"
      };
   }


   public function exportBookingToExcel()
   {
      $bookings = $this->BookingModel->getBookings(false);
      $cleanedBookings = [];
      foreach ($bookings as $booking) {
         unset($booking["created_at"]);
         unset($booking["updated_at"]);
         unset($booking["id"]);
         unset($booking["tour_id"]);
         $cleanedBookings[] =  $booking;
      }
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $headers = $this->BookingModel->getColumns();
      $headers = array_values($headers);
      foreach ($headers as $key => $item) {
         if($item === "id" || $item === "tour_id" || $item === "created_at" || $item === "updated_at") {
            unset($headers[$key]);
         }
      }
      $col = 'A';
      foreach ($headers as $header) {
         $sheet->setCellValue($col . '1', $header);
         $col++;
      }
      $row = 2;
      foreach ($cleanedBookings as $booking) {
         $col = 'A';
         foreach ($booking as $value) {
            $sheet->setCellValue($col . $row, $value);
            $col++;
         }
         $row++;
      }

      $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="bookings.xlsx"');

      $writer->save('php://output');
   }
}

