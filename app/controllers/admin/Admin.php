<?php

class Admin extends Controller
{
   private $data;
   private $AdminModel;
   private $excludedMethods = ['index'];
   public function __construct() {
      $this->AdminModel = $this->model("AdminModel");
      if(!Util::checkCsrfToken()) {
         Util::redirect("cpanel/admin",['msg' => "Thất bại! Token không hợp lệ" ,"type" => "error"]);
      }
   }
   public function index() {
      $admins = $this->AdminModel->all();
      $this->data['title'] = "List Admin";
      $this->data['heading']="Admin";
      $this->data['page'] ="admin/index";
      $this->data['admins'] = $admins;
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
         if($username == "" || $password == "" || $status == "") {
            Util::Redirect("cpanel/admin", ['msg'=> "Vui lòng điền đầy đủ thông tin","type" => "error"]);
         }
         $data = ["username" => $username, "password" => $password, "email" => $email, "status" => $status];
         $res =  $this->AdminModel->insert($data);
         if (!$res) {
            Util::Redirect("cpanel/admin", ['msg'=> "Thêm không thành công","type" => "error"]);
         }
         Util::redirect("cpanel/admin", ["msg"=>"Thêm thành công", "type" => "success"]);
      }
   }
   public function update($id) {
      $admin = $this->AdminModel->find(htmlspecialchars($id));
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
         $username =htmlspecialchars(Request::input("name"));
         $password = htmlspecialchars(Request::input("password"));
         if ($username == "") {
            Util::redirect("cpanel/admin-update/".$id, ['msg'=>"Vui lòng điền đầy đủ thông tin", "type" => "error"]);
         }
         $email = htmlspecialchars(Request::input("email"));
         $status = (int)htmlspecialchars(Request::input("status"));
         $update_at = Util::formatTimeFull(time());

         $data = ["username" =>$username,"email" => $email,"status"=>$status,"updated_at"=>$update_at];
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
         $id = (int)htmlspecialchars(Request::input("id"));
         if (!$id || $id <= 0) {
            Util::redirect("cpanel/admin", ['msg'=> "ID không hợp lệ", "type" => "error"]);
         }
         $res = $this->AdminModel->delete($id);
         if (!$res) {
            Util::redirect("cpanel/admin", ['msg'=> "Xóa thất bại", "type" => "error"]);
         }
         Util::redirect("cpanel/admin", ["msg"=>"Xóa  thành công", "type"=>"success"]);
      }
   }
}