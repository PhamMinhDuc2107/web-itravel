<?php

class TourNote extends Controller
{
   private $jwt;
   private $data;
   private $TourNoteModel;
   private $TourModel;
   public function __construct()
   {
      $this->TourNoteModel = $this->model("TourNoteModel");
      $this->TourModel = $this->model("TourModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if (!$checkAuth['success']) {
         Util::redirect("dashboard/login", Response::unauthorized($checkAuth['msg']));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("dashboard/tourNote", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index()
   {
      $this->TourNoteModel->setBaseModel();
      $totalPages = $this->TourNoteModel->getTotalPages();
      $tourNotes = $this->TourNoteModel->get();
      $tours = $this->TourModel->getNameTours();
      $this->data['totalPages'] = $totalPages;
      $this->data['title'] = "Những điều cần lưu ý";
      $this->data['page'] = "tourNote/index";
      $this->data['tourNotes'] = $tourNotes;
      $this->data['tours'] = $tours;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create()
   {
      if (!Request::isMethod("post")) {
         Util::redirect("dashboard/tourNote", Response::methodNotAllowed("Phương thức không được chấp nhận"));
      }
      $tourId = htmlspecialchars(Request::input('tour_id') ?? '');
      $number = htmlspecialchars(Request::input('number') ?? "");
      $listNumber  = $this->TourNoteModel->where(['tour-id' => $tourId]);
      foreach ($listNumber as $item) {
         if ($item["number"] === $number) {
            Util::redirect("dashboard/tourNote", Response::badRequest("STT đã tồn tại"));
         }
      }
      $title = htmlspecialchars(Request::input('title') ?? "");
      $content = Request::input('content') ?? '';
      $data = ["tour_id" => $tourId, "number" => $number, "title" => $title, "content" => $content];
      if ($tourId === "" || $number === "" || $title === "" || $content === "") {
         Util::redirect("dashboard/tourNote", Response::badRequest("Vui lòng điền đầy đủ thông tin"));
      }
      $res = $this->TourNoteModel->insert($data);
      if (!$res) {
         Util::redirect("dashboard/tourNote", Response::internalServerError("Tạo không thành công"));
      }
      Util::redirect("dashboard/tourNote", Response::success("Taạo thành công"));
   }
   public function update($id)
   {
      if ($id <= 0 || !is_numeric($id)) {
         Util::redirect("dashboard/tourNote", Response::badRequest("Id không hợp lệ"));
      }
      $tourNote = $this->TourNoteModel->find($id);
      $tours = $this->TourModel->getNameTours();
      $this->data['title'] = "Chỉnh sửa  những điều cần lưu ý";
      $this->data['page'] = "tourNote/form";
      $this->data['tours'] = $tours;
      $this->data['tourNote'] = $tourNote;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost()
   {
      $id = (Request::input('id') ?? 0);
      if ($id <= 0 || !is_numeric($id)) {
         Util::redirect("dashboard/tourNote", Response::badRequest("Id không hợp lệ"));
      }
      $tourNote = $this->TourNoteModel->find($id);
      if (!$tourNote) {
         Util::redirect("dashboard/tourNote", Response::notFound("Không tìm thấy"));
      }
      $tourId = htmlspecialchars(Request::input('tour_id') ?? "");
      $dayNumber = htmlspecialchars(Request::input('day_number') ?? "");
      $title = htmlspecialchars(Request::input('title') ?? "");
      $content = Request::input('content') ?? "";
      if ($tourId === "" && $dayNumber === "" && $title === "" && $content === "") {
         Util::redirect('dashboard/tourNote', Response::badRequest("không có sự thay đổi nào"));
      }
      $data = ['tour_id' => $tourId, "day_number" => $dayNumber, "title" => $title, "content" => $content];
      $data = Util::removeEmptyValues($data);
      var_dump($data);
      $res = $this->TourNoteModel->update($data, $id);
      if (!$res) {
         Util::redirect("dashboard/tourNote", Response::internalServerError("Cập nhật không thành công"));
      }
      Util::redirect("dashboard/tourNote", Response::success("Cập nhật thành công"));
   }
   public function delete()
   {
      if (!Request::isMethod("post")) {
         Util::redirect("dashboard/tourNote", Response::methodNotAllowed("Phương thức không được chấp nhận"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/tourNote", Response::badRequest("ID không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/tourNote", Response::badRequest("ID không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $this->TourNoteModel->delete($id);
      }
      Util::redirect('dashboard/tourNote', Response::success("Xóa thành công"));
   }
}
