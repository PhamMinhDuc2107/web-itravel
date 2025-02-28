<?php

class BlogCategory extends Controller
{
   private $data;
   private $BlogCategoryModel;
   private $jwt;
   function __construct()
   {
      $this->BlogCategoryModel = $this->Model("BlogCategoryModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if(!$checkAuth['success']) {
         Util::redirect("dashboard/login",Response::unauthorized($checkAuth['msg']));
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("dashboard/category",Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }


   function index() {
      Util::setBaseModel($this->BlogCategoryModel);
      $totalPages =$this->BlogCategoryModel->getTotalPages();
      $blogCategories = $this->BlogCategoryModel->get();
      $this->data['totalPages'] = $totalPages;
      $this->data['page']= 'index';
      $this->data['title'] = "Quản lý danh mục tin tức";
      $this->data['page'] ="blog_category/index";
      $this->data['blogCategories'] = $blogCategories;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create() {
      if (Request::isMethod("POST")) {
         $name = htmlspecialchars(Request::input("name"));
         $checkName= $this->BlogCategoryModel->find($name,"name");
         if ($checkName) {
            Util::Redirect("dashboard/blogCategory", ['msg' => "Tên danh mục không được dể giống nhau", "type" => "error"]);
         }
         $slug = Util::generateSlug($name);
         $data = ["name" => $name, "slug" => $slug];

         $res =  $this->BlogCategoryModel->insert($data);
         if (!$res) {
            Util::Redirect("dashboard/blogCategory", ['msg'=> "Thêm danh mục không thành công" , "type" => "error"]);
         }
         Util::redirect("dashboard/blogCategory", ["msg"=>"Thêm danh mục thành công" , "type" => "success"]);
      }
   }
   public function update($id) {
      if ($id <= 0 || !is_numeric($id)) {
         Util::Redirect("dashboard/blogCategory", ['msg' => "ID không hợp lệ", "type" => "error"]);
      }
      $blogCategory = $this->BlogCategoryModel->find(htmlspecialchars($id)) ??[];
      if(empty($blogCategory)) {
         Util::redirect("dashboard/blogCategory",['msg'=>"Id không tồn tại", "type"=>"error"]);
      }
      $this->data['page']= 'index';
      $this->data['title'] = "Sửa thông tin danh mục tin tức";
      $this->data['page'] ="blog_category/form";
      $this->data['blogCategory'] = $blogCategory;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost() {
      if(Request::isMethod("POST")) {
         $id = (int)htmlspecialchars(Request::input("id")) ?? 0;
         $name =htmlspecialchars(Request::input("name"));
         $slug = Util::generateSlug($name);
         $checkName = $this->BlogCategoryModel->find($name, "name");
         if ($checkName) {
            Util::Redirect("dashboard/blogCategory", ['msg' => "name hoặc slug đã tồn tại", "type" => "error"]);
         }
         $data = ["name" =>$name,"slug" => $slug];
         $res = $this->BlogCategoryModel->update($data, $id);
         if (!$res) {
            Util::Redirect("dashboard/blogCategory", ['msg'=> "Cập nhật thông tin không thành công", "type" => "error"]);
         }
         Util::redirect("dashboard/blogCategory", ["msg"=>"Cập nhật thông tin thành công", "type"=>"success"]);
      }
   }
   public function delete(): void
   {
      if(Request::isMethod("POST")) {
         $listID = Request::input("id") ?? [];
         if (empty($listID)) {
            Util::redirect("dashboard/blogCategory", ['msg'=> "ID không hợp lệ", "type" => "error"]);
         }
         foreach ($listID as $id) {
            if (!is_numeric($id) || $id < 0) {
               Util::redirect("dashboard/blogCategory", ['msg'=> "ID không hợp lệ", "type" => "error"]);
            }
         }
         foreach ($listID as $id) {
              $this->BlogCategoryModel->delete($id);
         }
         Util::redirect("dashboard/blogCategory", ["msg"=>"Xóa  thành công", "type" => "success"]);
      }
   }
}