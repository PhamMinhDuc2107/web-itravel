<?php

class Admin extends Controller
{
   private $data;
   private $AdminModel;
   /**
    * @var JwtUtil
    */
   private $jwt;

   public function __construct() {
      $this->AdminModel = $this->model("AdminModel");
      $this->jwt = new JwtUtil();
      if(!$this->jwt->checkAuth("token_auth")) {
         Util::redirect("cpanel/login",['invalid' => "Vui lòng đăng nhập lại","type"=>"error"]);
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("cpanel/admin",['msg' => "Thất bại! Token không hợp lệ" ,"type" => "error"]);
      }
   }
   public function index() {
      Util::setBaseModel($this->AdminModel);
      $totalPages =$this->AdminModel->getTotalPages();
      $admins = $this->AdminModel->get();
      $this->data['title'] = "List Admin";
      $this->data['heading']="Admin";
      $this->data['page'] ="admin/index";
      $this->data['admins'] = $admins;
      $this->data['totalPages'] = $totalPages;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create() {
      if (Request::isMethod("POST")) {
         $username = htmlspecialchars(Request::input("username"));
         $password = htmlspecialchars(Request::input("password"));

         $userExit = $this->AdminModel->find($username, "username");
         if ($userExit) {
            Util::Redirect("cpanel/admin", ['msg'=> "Thất bại! Tài khoản đã tồn tại","type" => "error"]);
         }
         $password = password_hash($password, PASSWORD_DEFAULT);
         $email = htmlspecialchars(Request::input("email"));
         $status = (int)htmlspecialchars(Request::input("status"));
         $phone = htmlspecialchars(Request::input("phone")) ??null;
         if($username == "" || $password == "" || $status == "") {
            Util::Redirect("cpanel/admin", ['msg'=> "Vui lòng điền đầy đủ thông tin","type" => "error"]);
         }
         $data = ["username" => $username, "password" => $password, "email" => $email,"phone"=>$phone, "status" => $status];
         $res =  $this->AdminModel->insert($data);
         if (!$res) {
            Util::Redirect("cpanel/admin", ['msg'=> "Thêm không thành công","type" => "error"]);
         }
         Util::redirect("cpanel/admin", ["msg"=>"Thêm thành công", "type" => "success"]);
      }
   }
   public function update($id) {
      $admin = $this->AdminModel->find(htmlspecialchars($id));
      if(!$admin) {
         Util::redirect("cpanel/admin", ["msg"=>"Không tìm thấy admin này", "type" => "error"]);
      }
      $this->data['title'] = "Edit Admin";
      $this->data['heading']="Edit Admin";
      $this->data['page'] ="admin/form";
      $this->data["admin"] = $admin;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost() {
      if(Request::isMethod("POST")) {
         $id = (int)htmlspecialchars(Request::input("id"));
         if ($id <= 0) {
            Util::Redirect("cpanel/category", ['msg' => "ID không hợp lệ"]);
         }
         $username =htmlspecialchars(Request::input("username"));
         $password = htmlspecialchars(Request::input("password"));
         $email = htmlspecialchars(Request::input("email"));
         $phone  =htmlspecialchars(Request::input("phone"));
         $status = (int)htmlspecialchars(Request::input("status"));
         $update_at = Util::formatTimeFull(time());

         $data = ["username" =>$username,"email" => $email,"phone"=>$phone,"status"=>$status,"updated_at"=>$update_at];
         var_dump($data);
         if ($password !== "") {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $data['password'] = $password;
         }
         $res = $this->AdminModel->update($data, $id);
         if (!$res) {
            Util::Redirect("cpanel/admin", ['msg'=> "Cập nhật thông tin không thành công"]);
         }
         Util::redirect("cpanel/admin", ["msg"=>"Cập nhật thông tin thành công"]);
      }
   }

   public function delete() {

      if(Request::isMethod("POST")) {
         $listId = Request::input("id") ?? [];
         if (empty($listId)) {
            Util::redirect("cpanel/admin",['msg'=>"ID không hợp lệ", "type" => "error"]);
         }
         $admin = $this->jwt->decode($_COOKIE["token_auth"]);
         $adminId = $admin->data->id;
         foreach ($listId as $id) {
            if ($id == $adminId) {
               Util::redirect("cpanel/admin",['msg'=>"Bạn không thể xóa tài khoản đang đăng nhập", "type" => "error"]);
            }
         }
         foreach ($listId as $id) {
            $this->AdminModel->delete($id);
         }
         Util::redirect("cpanel/admin", ["msg"=>"Xóa  thành công", "type"=>"success"]);
      }
   }
}