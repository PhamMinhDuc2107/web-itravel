<?php

class Admin extends Controller
{
   private $data;
   private $AdminModel;
   private $jwt;

   public function __construct()
   {
      $this->AdminModel = $this->model("AdminModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if (!$checkAuth['success']) {
         Util::redirect("dashboard/login", Response::unauthorized($checkAuth['msg']));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("dashboard/category", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index()
   {
      $this->AdminModel->setBaseModel();
      $data = $this->AdminModel->get();
      $totalPages = $this->AdminModel->getTotalPages();
      $this->data['title'] = "Quản lý admin";
      $this->data['heading'] = "Admin";
      $this->data['page'] = "admin/index";
      $this->data['totalPages'] = $totalPages;
      $this->data['admins'] = $data;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create()
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/admin", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $username = htmlspecialchars(Request::input("username") ?? "");
      $password = htmlspecialchars(Request::input("password") ?? "");

      $userExit = $this->AdminModel->find($username, "username");
      if ($userExit) {
         Util::Redirect("dashboard/admin", Response::badRequest("Tài khoản đã tồn tại"));
      }
      $password = password_hash($password, PASSWORD_DEFAULT);
      $email = htmlspecialchars(Request::input("email"));
      $status = (int)htmlspecialchars(Request::input("status"));
      $phone = htmlspecialchars(Request::input("phone")) ?? null;
      if ($username == "" || $password == "" || $status == "") {
         Util::Redirect("dashboard/admin", Response::badRequest("Vui lòng điền đầy đủ thông tin"));
      }
      $data = ["username" => $username, "password" => $password, "email" => $email, "phone" => $phone, "status" => $status];
      $res =  $this->AdminModel->insert($data);
      if (!$res) {
         Util::Redirect("dashboard/admin", Response::badRequest("Tạo không thành công"));
      }
      Util::redirect("dashboard/admin", Response::success("Tạo thành công"));
   }
   public function update($id)
   {
      $admin = $this->AdminModel->find(htmlspecialchars($id));
      if (!$admin) {
         Util::redirect("dashboard/admin", Response::notFound("Không tìm thấy Id"));
      }
      $this->data['title'] = "Chỉnh sửa thông tin admin";
      $this->data['heading'] = "Chỉnh sửa thông tin admin";
      $this->data['page'] = "admin/form";
      $this->data["admin"] = $admin;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost()
   {
      if (!Request::isMethod("POST")) {
         Util::Redirect("dashboard/category", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $id = htmlspecialchars(Request::input("id"));
      if ($id <= 0 || !is_numeric($id)) {
         Util::Redirect("dashboard/category", Response::badRequest("ID không hợp lệ"));
      }
      $username = htmlspecialchars(Request::input("username"));
      $password = htmlspecialchars(Request::input("password"));
      $email = htmlspecialchars(Request::input("email"));
      $phone  = htmlspecialchars(Request::input("phone"));
      $status = (int)htmlspecialchars(Request::input("status"));
      $update_at = Util::formatTimeFull(time());

      $data = ["username" => $username, "email" => $email, "phone" => $phone, "status" => $status, "updated_at" => $update_at];
      var_dump($data);
      if ($password !== "") {
         $password = password_hash($password, PASSWORD_DEFAULT);
         $data['password'] = $password;
      }
      $res = $this->AdminModel->update($data, $id);
      if (!$res) {
         Util::Redirect("dashboard/admin", Response::internalServerError("Tạo không thành công"));
      }
      Util::redirect("dashboard/admin", Response::success("Tạo thành công"));
   }

   public function delete()
   {

      if (!Request::isMethod("POST")) {
         Util::Redirect("dashboard/category", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $listId = Request::input("id") ?? [];
      if (empty($listId)) {
         Util::redirect("dashboard/admin", Response::badRequest("ID không hợp lẹ"));
      }
      $admin = $this->jwt->decode($_COOKIE["token_auth"]);
      $adminId = $admin->data->id;
      foreach ($listId as $id) {
         if ($id == $adminId) {
            Util::redirect("dashboard/admin", Response::badRequest("Bạn không thể xóa tài khoản đang đăng nhập"));
         }
      }
      foreach ($listId as $id) {
         $this->AdminModel->delete($id);
      }
      Util::redirect("dashboard/admin", Response::success("Bạn xóa tài khoản thành công"));
   }
}
