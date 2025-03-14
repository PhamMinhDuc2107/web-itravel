<?php

class Location extends Controller
{
   private $data;
   private $LocationModel;
   private $CategoryModel;
   private $jwt;

   public function __construct()
   {
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
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
      $this->LocationModel->setBaseModel();
      $totalPages = $this->LocationModel->getTotalPages();
      $locations = $this->LocationModel->getLocations();
      $categories = $this->CategoryModel->all();
      $this->data['totalPages'] = $totalPages;
      $this->data['page'] = 'index';
      $this->data['title'] = "Quản lý địa điểm tour";
      $this->data['page'] = "location/index";
      $this->data['locations'] = $locations;
      $this->data['categories'] = $categories;
      $this->render("layouts/admin_layout", $this->data);
   }

   public function create()
   {
      if (!Request::isMethod("post")) {
         Util::Redirect("dashboard/location", Response::methodNotAllowed("Phương thức khoogn được phép"));
      }
      $file = Request::file("image") ?? [];
      if (!$file && empty($file['name'])) {
         Util::redirect("dashboard/location", Response::badRequest("Vui lòng điền đầy đủ thông tin"));
      }
      $pathAsset = '/public/uploads/location/';
      $checkCreateImgPath = Util::createImagePath($file, $pathAsset);
      if (!$checkCreateImgPath["success"]) {
         Util::redirect('dashboard/location', Response::badRequest($checkCreateImgPath['msg']));
      }

      $thumb = $checkCreateImgPath['name'];
      $data = $this->prepareLocationData();
      $data['image'] = $thumb;
      $res = $this->LocationModel->insert($data);
      $id = $this->LocationModel->getLastInsertId();
      if (!$res) {
         Util::redirect("dashboard/location", Response::internalServerError("Tạo không thành công"));
      }
      $checkUpload = Util::uploadImage($file, $thumb);
      if (!$checkUpload["success"]) {
         $this->LocationModel->delete($id);
         Util::redirect('dashboard/location', Response::badRequest($checkUpload['msg']));
      }
      Util::redirect('dashboard/location', Response::success("Tạo thành công"));
   }

   public function update($id): void
   {
      $id = (int)$id;
      $location = $this->LocationModel->find($id);
      if (empty($location)) {
         Util::redirect("dashboard/location", Response::notFound("Không tìm thấy địa điểm để cập nhật"));
      }
      $categories = $this->CategoryModel->all();
      $category= $this->CategoryModel->find($location['category']);
      $this->data['page'] = 'index';
      $this->data['title'] = "Sửa thông tin địa điểm của tour";
      $this->data['page'] = "location/form";
      $this->data['location'] = $location;
      $this->data['category'] = $category;
      $this->data['categories'] = $categories;
      $this->render("layouts/admin_layout", $this->data);
   }

   public function updatePost()
   {
      if (!Request::isMethod("POST")) {
         Util::Redirect("dashboard/location", Response::methodNotAllowed("Phương thức không được phép"));
      }

      $id = (int)(Request::input("id") ?? 0);
      $location = $this->LocationModel->find($id);
      if (!$location) {
         Util::redirect("dashboard/location", Response::badRequest("Không tìm thất địa điểm"));
      }
      $data = $this->prepareLocationData();
      $img = Request::file("image");
      $oldImagePath = $location['image'];

      $newImagePath = null;
      if ($img && !empty($img['name'])) {
         $pathAsset = '/public/uploads/location/';
         $checkCreateImgPath = Util::createImagePath($img, $pathAsset);

         if (!$checkCreateImgPath["success"]) {
            Util::redirect('dashboard/location', Response::badRequest($checkCreateImgPath['msg']));
         }
         $newImagePath = $checkCreateImgPath['name'];

         $data['image'] = $newImagePath;
      }
      $res = $this->LocationModel->update($data, $id);
      if (!$res) {
         Util::redirect("dashboard/location", Response::internalServerError("Cập nhật không thành công"));
      }
      if ($newImagePath !== null) {
         $uploadSuccess = Util::uploadImage($img, $newImagePath);
         if (!$uploadSuccess["success"]) {
            Util::redirect('dashboard/location', Response::badRequest($uploadSuccess['msg']));
         }
         $checkDeleteImg = Util::deleteImage(_DIR_ROOT . $oldImagePath);
         if (!$checkDeleteImg["success"]) {
            Util::redirect('dashboard/location', Response::badRequest($checkDeleteImg['msg']));
         }
      }
      Util::redirect("dashboard/location", Response::success("Cập nhật thành công"));
   }

   public function delete(): void
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/location", Response::methodNotAllowed("Phương thức không được phép"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/location", Response::badRequest("Id không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/location", Response::badRequest("Id không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $blog = $this->LocationModel->find($id);
         $pathImg = _DIR_ROOT . '/' . $blog["image"];
         $checkDeleteImg = Util::deleteImage($pathImg);
         if (!$checkDeleteImg['success']) {
            Util::redirect("dashboard/location", Response::badRequest($checkDeleteImg['message']));
         }
         $this->LocationModel->delete($id);
      }
      Util::redirect("dashboard/location", Response::success("Xóa thành công"));
   }

   private function prepareLocationData(): array
   {
      $name = htmlspecialchars(Request::input("title")) ?? "";
      if ($name === "") {
         Util::Redirect("dashboard/location", Response::badRequest("vui lòng điền đầy đủ thông tin"));
      }
      $slug = Util::generateSlug($name);
      $desc = htmlspecialchars(Request::input("description")) ?? "";
      $category = htmlspecialchars(Request::input("category")) ?? "";
      $displayHome  = htmlspecialchars(Request::input("display_home")) ?? "";
      $hot = htmlspecialchars(Request::input("hot")) ? 1 : 0;
      $isDeparture = Request::input("is_departure") ? 1 : 0;
      $isDestination = Request::input("is_destination") ? 1 : 0;
      $data = [
         "name" => $name, "slug" => $slug,"category"=>$category,"display_home"=>$displayHome,"hot"=>$hot, "is_departure" => $isDeparture, "is_destination" => $isDestination, "description" => $desc
      ];
      return $data;
   }
}
