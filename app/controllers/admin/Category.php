<?php

class Category extends Controller
{
   private $data = [];
   private $CategoryModel;
   /**
    * @var JwtUtil
    */
   private $jwt;

   function __construct(){
      $this->CategoryModel = $this->model("CategoryModel");
      $this->jwt = new JwtUtil();
      if(!$this->jwt->checkAuth("token_auth")) {
         Util::redirect("cpanel/login",ErrorResponse::unauthorized("Vui lòng đăng nhập lại"));
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("cpanel/category",ErrorResponse::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index(): void
   {
      Util::setBaseModel($this->CategoryModel);
      $totalPages =$this->CategoryModel->getTotalPages();
      $categories = $this->CategoryModel->get();
      $getCategories = $this->CategoryModel->all();
      $this->data['totalPages'] = $totalPages;
      $this->data['page']= 'index';
      $this->data['title'] = "Danh mục";
      $this->data['page'] ="category/index";
      $this->data['categories'] = $categories;
      $this->data['getCategories'] = $getCategories;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create(): void
   {
      if (Request::isMethod("POST")) {
         $name = htmlspecialchars(Request::input("title")) ?? "";
         $parentId = (int)htmlspecialchars(Request::input("createdParentId")) ?? "";
         if ($name === "") {
            Util::Redirect("cpanel/category", ['msg'=> "Vui lòng điền đầy đủ thông tin", "type" => "error"]);
         }
         $data = ["name" => $name];
         if ($parentId !== "") {
            $data["parent_id"] = $parentId;
         }
         $res =  $this->CategoryModel->insert($data);
         if (!$res) {
            Util::Redirect("cpanel/category", ['msg'=> "Thêm danh mục không thành công" , "type" => "error"]);
         }
         Util::redirect("cpanel/category", ["msg"=>"Thêm danh mục thành công" , "type" => "success"]);
      }
   }
   public function update($id) {
      $category = $this->CategoryModel->find(htmlspecialchars($id));
      if(empty($category)) {
         Util::redirect("cpanel/category",['msg'=>"Id không tồn tại", "type"=>"error"]);
      }
      $categories = $this->CategoryModel->get();
      $parentId = $category["parent_id"];
      if ($parentId > 0 && is_numeric($parentId)) {
         $parent = $this->CategoryModel->find($parentId);
         $this->data['parent'] = $parent['name'];
      }
      $this->data['page']= 'index';
      $this->data['title'] = "Danh mục";
      $this->data['page'] ="category/form";
      $this->data['category'] = $category;
      $this->data['categories'] = $categories;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost() {
      if(Request::isMethod("POST")) {
         $id = (int)htmlspecialchars(Request::input("id"));
         if ($id <= 0) {
            Util::Redirect("cpanel/admin", ['msg' => "ID không hợp lệ", "type" => "error"]);
         }
         $name =htmlspecialchars(Request::input("title"));
         $parentId = htmlspecialchars(Request::input("parent"));
         $update_at = Util::formatTimeFull(time());

         $data = ["name" =>$name,"updated_at"=>$update_at];
         if ($parentId !== "") {
            $data['parent_id'] = $parentId;
         }
         $res = $this->CategoryModel->update($data, $id);
         if (!$res) {
            Util::Redirect("cpanel/category", ['msg'=> "Cập nhật thông tin không thành công", "type" => "error"]);
         }
         Util::redirect("cpanel/category", ["msg"=>"Cập nhật thông tin thành công", "type"=>"success"]);
      }
   }
   public function delete(): void
   {
      if(Request::isMethod("POST")) {
         $listID = Request::input("id") ?? [];
         if (empty($listID)) {
            Util::redirect("cpanel/category", ['msg'=> "ID không hợp lệ", "type" => "error"]);
         }
         foreach ($listID as $id) {
            if (!is_numeric($id) || $id < 0) {
               Util::redirect("cpanel/category", ['msg'=> "ID không hợp lệ", "type" => "error"]);
            }
         }
         foreach ($listID as $id) {
            $this->CategoryModel->delete($id);
         }
         Util::redirect("cpanel/category", ["msg"=>"Xóa  thành công", "type" => "success"]);
      }
   }
}