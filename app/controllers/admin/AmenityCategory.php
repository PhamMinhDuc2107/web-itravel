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
      $file = Request::file("image") ?? [];
      if (!$file || empty($file['name'])) {
         Util::redirect("dashboard/amenityCategory", Response::badRequest("Vui lòng điền đầy đủ thông tin"));
      }
      $pathAsset = '/public/uploads/amenity/';
      $checkCreateImgPath = Util::createImagePath($file, $pathAsset);
      if (!$checkCreateImgPath["success"]) {
         Util::redirect('dashboard/banner', Response::badRequest($checkCreateImgPath['msg']));
      }

      $thumb = $checkCreateImgPath['name'];
      $data = ["name" => $name, "image" => $thumb];
      $res =  $this->AmenityCategoryModel->insert($data);

      if (!$res) {
         Util::Redirect("dashboard/amenityCategory", Response::internalServerError("Tạo không thành công"));
      }
      $id = $this->AmenityCategoryModel->getLastInsertId();
      $checkUpload = Util::uploadImage($file, $thumb);
      if (!$checkUpload["success"]) {
         $this->AmenityCategoryModel->delete($id);
         Util::redirect('dashboard/amenityCategory', Response::badRequest($checkUpload['msg']));
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
      $amenityCategory = $this->AmenityCategoryModel->find($id);
      if ($id <= 0 || !is_numeric($id)) {
         Util::Redirect("dashboard/amenityCategory", Response::badRequest("Id không hợp lệ"));
      }
      $name = htmlspecialchars(Request::input("title"));
      if ($name === "") {
         Util::redirect('cpanel/amenityCategory', Response::badRequest("vui lòng điền đẩy đủ thông tin"));
      }
      $data = ["name" => $name];
      $img = Request::file("image");
      $oldImagePath = $amenityCategory['image'];
      $newImagePath = null;
      if ($img && !empty($img['name'])) {
         $pathAsset = '/public/uploads/amenity/';
         $checkCreateImgPath = Util::createImagePath($img, $pathAsset);

         if (!$checkCreateImgPath["success"]) {
            Util::redirect('dashboard/amenityCategory', Response::badRequest($checkCreateImgPath['msg']));
         }
         $newImagePath = $checkCreateImgPath['name'];

         $data['image'] = $newImagePath;
      }
      $res = $this->AmenityCategoryModel->update($data, $id);
      if (!$res) {
         Util::Redirect("dashboard/amenityCategory", Response::internalServerError("Cập nhật không thành công"));
      }
      if ($newImagePath !== null) {
         $uploadSuccess = Util::uploadImage($img, $newImagePath);
         if (!$uploadSuccess["success"]) {
            Util::redirect('dashboard/amenityCategory', Response::badRequest($uploadSuccess['msg']));
         }
         if(!empty($oldImagePath) && $oldImagePath !== null) {
            $checkDeleteImg = Util::deleteImage(_DIR_ROOT . $oldImagePath);
            if (!$checkDeleteImg["success"]) {
               Util::redirect('dashboard/amenityCategory', Response::badRequest($checkDeleteImg['msg']));
            }
         } 
         
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
         $amenity = $this->AmenityCategoryModel->find($id);
         if(!empty($amenity['image']) && $amenity['image'] !== null) {
            echo 1;
            $pathImg = _DIR_ROOT . $amenity["image"];
            $checkDeleteImg = Util::deleteImage($pathImg);
            if (!$checkDeleteImg['success']) {
               Util::redirect("dashboard/amenityCategory", Response::badRequest($checkDeleteImg['message']));
            }
         } 
         $this->AmenityCategoryModel->delete($id);
         
      }
      Util::redirect("dashboard/amenityCategory", Response::success("Xóa thành công"));
   }
}