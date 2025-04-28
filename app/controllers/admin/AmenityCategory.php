<?php
class AmenityCategory extends Controller
{
   private $data;
   private $AmenityCategoryModel;
   private $jwt;
   public function __construct()
   {
      $this->AmenityCategoryModel = $this->model("AmenityCategoryModel");
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
      $this->AmenityCategoryModel->setBaseModel();
      $totalPages = $this->AmenityCategoryModel->getTotalPages();
      $amenityCategories = $this->AmenityCategoryModel->get();
      $this->data['amenityCategories'] = $amenityCategories;
      $this->data['totalPages'] = $totalPages;
      $this->data['page'] = "amenityCategory/index";
      $this->data['title'] = "Danh mục tiện ích";
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create(): void
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/amenityCategory", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $name = htmlspecialchars(Request::input("title")) ?? "";
      if ($name === "") {
         Util::Redirect("dashboard/amenityCategory", Response::badRequest("Vui lòng điền đẩy đủ thông tin"));
      }
      $data = ["name" => $name];
      $res =  $this->AmenityCategoryModel->insert($data);
      if (!$res) {
         Util::Redirect("dashboard/amenityCategory", Response::internalServerError("Tạo không thành công"));
      }
      Util::redirect("dashboard/amenityCategory", Response::success("Tạo thành công"));
   }
   public function update($id)
   {
      $amenityCategory = $this->AmenityCategoryModel->find(htmlspecialchars($id));
      if (empty($amenityCategory)) {
         Util::redirect("dashboard/amenityCategory", Response::notFound("Không tìm thấy"));
      }
      $this->data['page'] = 'index';
      $this->data['title'] = "Sửa danh mục tiện ích";
      $this->data['page'] = "amenityCategory/form";
      $this->data['amenityCategory'] = $amenityCategory;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost()
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/amenityCategory", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $id = htmlspecialchars(Request::input("id"));
      if ($id <= 0 || !is_numeric($id)) {
         Util::Redirect("dashboard/amenityCategory", Response::badRequest("Id không hợp lệ"));
      }
      $name = htmlspecialchars(Request::input("title"));
      if ($name === "") {
         Util::redirect('cpanel/category', Response::badRequest("vui lòng điền đẩy đủ thông tin"));
      }
      $data = ["name" => $name];
      $res = $this->AmenityCategoryModel->update($data, $id);
      if (!$res) {
         Util::Redirect("dashboard/amenityCategory", Response::internalServerError("Cập nhật không thành công"));
      }
      Util::redirect("dashboard/amenityCategory", Response::success("cập nhật thành cồng"));
   }
   public function delete(): void
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/amenityCategory", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/amenityCategory", Response::notFound("Không tìm thấy ID"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/amenityCategory", Response::badRequest("ID Không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $this->AmenityCategoryModel->delete($id);
      }
      Util::redirect("dashboard/amenityCategory", Response::success("Xóa thành công"));
   }
}
