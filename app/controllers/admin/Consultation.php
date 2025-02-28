<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Consultation extends Controller
{
   private $data = [];
   private $ConsultationModel;
   private $jwt;

   function __construct()
   {
      $this->ConsultationModel = $this->model("ConsultationModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if (!$checkAuth['success']) {
         Util::redirect("dashboard/login", Response::unauthorized($checkAuth['msg']));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("dashboard/consultation", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }

   public function index(): void
   {
      Util::setBaseModel($this->ConsultationModel);
      $totalPages = $this->ConsultationModel->getTotalPages();
      $consultations = $this->ConsultationModel->get();
      $this->data['totalPages'] = $totalPages;
      $this->data['title'] = "Danh sách khách hàng cần tư vấn";
      $this->data['page'] = "consultation/index";
      $this->data['consultations'] = $consultations;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function update($id): void
   {

      $id = (int)$id ?? 0;
      if($id <=0 || ! is_numeric($id)) {
         Util::redirect("dashboard/consultation", Response::badRequest("ID không hợp lệ"));
      }
      $consultation = $this->ConsultationModel->find($id);
      if(!$consultation) {
         Util::redirect("dashboard/consultation", Response::notFound("Không tìm thấy"));
      }
      $data=  ['status' => 1];
      $res = $this->ConsultationModel->update($data, $id);
      if (!$res) {
         Util::redirect("dashboard/consultation", Response::internalServerError("Cập nhật không thành công"));
      }
      Util::redirect("dashboard/consultation", Response::success("Cập nhật thành công"));
   }
   public function delete(): void
   {
      if(!Request::isMethod("POST")) {
         Util::redirect('dashboard/consultation', Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/consultation", Response::badRequest("Id không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/consultation", Response::badRequest("Id không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $this->ConsultationModel->delete($id);
      }
      Util::redirect("dashboard/consultation",Response::success("Xóa thành công"));
   }
   public function exportConsultationToExcel()
   {
      $bookings = $this->ConsultationModel->all(false);
      $cleanedBookings = [];
      foreach ($bookings as $booking) {
         unset($booking["created_at"]);
         unset($booking["id"]);
         $cleanedBookings[] =  $booking;
      }
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $headers = $this->ConsultationModel->getColumns();
      $headers = array_values($headers);
      foreach ($headers as $key => $item) {
         if($item === "id" || $item === "created_at" ) {
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

