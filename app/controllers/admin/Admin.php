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
      $search = htmlspecialchars(Request::input("search", ""));
      $data = $this->AdminModel->get();
       $totalPages = $this->AdminModel->getTotalPages();
      if($search !== "") {
         $col =htmlspecialchars(Request::input("orderBy",""));
         $dataSearch = [$col => "%$search%"];
         $data = $this->AdminModel->like($dataSearch);
         $totalPages = ceil($this->AdminModel->countLike($dataSearch)/$this->AdminModel->getLimit());
      }

      $this->data['title'] = "Quản lý admin";
      $this->data['heading'] = "Admin";
      $this->data['page'] = "admin/index";
      $this->data['totalPages'] = $totalPages;
      $this->data['admins'] = $data;
      $this->data['col'] = $this->AdminModel->getColumns();
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create()
   {
      if (!Request::isMethod("POST")) {
         FlashMessage::error("admin", CrudEnum::INVALID_METHOD->value);
         Util::redirect("dashboard/admin");
      }
      $request = new AdminCreateRequest($_POST);
      if ($request->fails()) {
         FlashMessage::error("admin",$request->errors());
         Util::redirect("dashboard/admin");
      }
      $data = $request->validated();
      $username = $data['username'];
      $password = password_hash($data['password'], PASSWORD_DEFAULT);
      $email = $data['email'];
      $phone = $data['phone'];
      $status = (int)$data['status'];
      $userExit = $this->AdminModel->find($username, "username");
      if ($userExit) {
         FlashMessage::error("admin", CrudEnum::EXISTS->addMessage("username: ".$username));
         Util::redirect("dashboard/admin");
      }
      $data = ["username" => $username, "password" => $password, "email" => $email, "phone" => $phone, "status" => $status];
      $res =  $this->AdminModel->insert($data);
      if (!$res) {
         FlashMessage::error("admin",CrudEnum::CREATE_FAIL->withEntity("admin"));
         Util::redirect("dashboard/admin");
      }
      FlashMessage::success("admin",CrudEnum::CREATE_SUCCESS->withEntity("admin"));
      Util::redirect("dashboard/admin");
   }
   public function update($id)
   {
      $admin = $this->AdminModel->find($id);
      if (!$admin) {
         FlashMessage::warning("admin", CrudEnum::NOT_FOUND->addMessage("Id: ".$id));
         Util::redirect("dashboard/admin");
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
         FlashMessage::error("admin", CrudEnum::INVALID_METHOD->value);
         Util::redirect("dashboard/admin");
      }
      $request = new AdminUpdateRequest($_POST);
      if ($request->fails()) {
         FlashMessage::error("admin",$request->errors());
         Util::redirect("dashboard/admin");
      }
      $data = $request->validated();
      $id = (int)$data['id'];
      if($data['password']) {
         $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
      }
      $res = $this->AdminModel->update($data, $id);
      if (!$res) {
         FlashMessage::error("admin", CrudEnum::UPDATE_FAIL->withEntity("admin"));
         Util::Redirect("dashboard/admin");
      }
      FlashMessage::success("admin", CrudEnum::UPDATE_SUCCESS->withEntity("admin"));
      Util::redirect("dashboard/admin");
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
