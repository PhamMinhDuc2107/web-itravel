<?php
class HotelType extends Controller
{
   private $data;
   private $HotelTypeModel;
   private $jwt;
   public function __construct()
   {
      $this->HotelTypeModel = $this->model("HotelTypeModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if (!$checkAuth['success']) {
         Util::redirect("dashboard/login", Response::unauthorized($checkAuth['msg']));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("dashboard/hotelType", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index()
   {
      $this->HotelTypeModel->setBaseModel();
      $totalPages = $this->HotelTypeModel->getTotalPages();
      $hotelTypes = $this->HotelTypeModel->get();
      $this->data['hotelTypes'] = $hotelTypes;
      $this->data['totalPages'] = $totalPages;
      $this->data['page'] = "hotelType/index";
      $this->data['title'] = "Danh mục khách sạn";
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create(): void
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/hotelType", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $name = htmlspecialchars(Request::input("title")) ?? "";
      if ($name === "") {
         Util::Redirect("dashboard/hotelType", Response::badRequest("Vui lòng điền đẩy đủ thông tin"));
      }
      $data = ["name" => $name];
      $res =  $this->HotelTypeModel->insert($data);
      if (!$res) {
         Util::Redirect("dashboard/hotelType", Response::internalServerError("Tạo không thành công"));
      }
      Util::redirect("dashboard/hotelType", Response::success("Tạo thành công"));
   }
   public function update($id)
   {
      $hotelType = $this->HotelTypeModel->find(htmlspecialchars($id));
      if (empty($hotelType)) {
         Util::redirect("dashboard/hotelType", Response::notFound("Không tìm thấy"));
      }
      $this->data['page'] = 'index';
      $this->data['title'] = "Sửa danh mục khách sạn";
      $this->data['page'] = "hotelType/form";
      $this->data['hotelType'] = $hotelType;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost()
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/hotelType", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $id = htmlspecialchars(Request::input("id"));
      if ($id <= 0 || !is_numeric($id)) {
         Util::Redirect("dashboard/hotelType", Response::badRequest("Id không hợp lệ"));
      }
      $name = htmlspecialchars(Request::input("title"));
      if ($name === "") {
         Util::redirect('cpanel/category', Response::badRequest("vui lòng điền đẩy đủ thông tin"));
      }
      $data = ["name" => $name];
      $res = $this->HotelTypeModel->update($data, $id);
      if (!$res) {
         Util::Redirect("dashboard/hotelType", Response::internalServerError("Cập nhật không thành công"));
      }
      Util::redirect("dashboard/hotelType", Response::success("cập nhật thành cồng"));
   }
   public function delete(): void
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/hotelType", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/hotelType", Response::notFound("Không tìm thấy ID"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/hotelType", Response::badRequest("ID Không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $this->HotelTypeModel->delete($id);
      }
      Util::redirect("dashboard/hotelType", Response::success("Xóa thành công"));
   }
}
