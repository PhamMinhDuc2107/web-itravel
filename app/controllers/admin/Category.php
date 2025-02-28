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
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if(!$checkAuth['success']) {
         Util::redirect("dashboard/login",Response::unauthorized($checkAuth['msg']));
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("dashboard/category",Response::forbidden("Thất bại! Token không hợp lệ"));
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
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/category", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $name = htmlspecialchars(Request::input("title")) ?? "";
      $parentId = (int)htmlspecialchars(Request::input("createdParentId")) ?? "";
      if ($name === "") {
         Util::Redirect("dashboard/category", Response::badRequest("Vui lòng điền đẩy đủ thông tin"));
      }
      $data = ["name" => $name];
      if ($parentId !== "") {
         $data["parent_id"] = $parentId;
      }
      $res =  $this->CategoryModel->insert($data);
      if (!$res) {
         Util::Redirect("dashboard/category", Response::internalServerError("Tạo không thành công"));
      }
      Util::redirect("dashboard/category", Response::success("Tạo thành công"));
   }
   public function update($id) {
      $category = $this->CategoryModel->find(htmlspecialchars($id));
      if(empty($category)) {
         Util::redirect("dashboard/category",Response::notFound("Không tìm thấy"));
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
      if(!Request::isMethod("POST")) {
         Util::redirect("dashboard/category", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $id = htmlspecialchars(Request::input("id"));
      if ($id <= 0 || !is_numeric($id)) {
         Util::Redirect("dashboard/category", Response::badRequest("Id không hợp lệ"));
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
         Util::Redirect("dashboard/category", Response::internalServerError("Cập nhật không thành công"));
      }
      Util::redirect("dashboard/category", Response::success("cập nhật thành cồng"));

   }
   public function delete(): void
   {
      if(!Request::isMethod("POST")) {
         Util::redirect("dashboard/category", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/category", Response::notFound("Không tìm thấy ID"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/category", Response::badRequest("ID Không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $this->CategoryModel->delete($id);
      }
      Util::redirect("dashboard/category", Response::success("Xóa thành công"));
   }
}
