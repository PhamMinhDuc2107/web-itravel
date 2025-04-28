<?php
class Hotel extends Controller
{
   private $data;
   private $HotelModel;
   private $HotelTypeModel;
   private $HotelImageModel;
   private $AmenityModel;
   private $AmenityCategoryModel;
   private $jwt;
   public function __construct()
   {
      $this->HotelModel = $this->model("HotelModel");
      $this->HotelTypeModel = $this->model("HotelTypeModel");
      $this->HotelImageModel = $this->model("HotelImageModel");
      $this->AmenityModel = $this->model("AmenityModel");
      $this->AmenityCategoryModel = $this->model("AmenityCategoryModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if (!$checkAuth['success']) {
         Util::redirect("dashboard/login", Response::unauthorized($checkAuth['msg']));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("dashboard/hotel", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index()
   {
      $this->HotelModel->setBaseModel();
      $hotels = $this->HotelModel->get();
      $hotelTypes = $this->HotelTypeModel->all();
      $amenityCategories = $this->AmenityCategoryModel->all();
      $this->data['title'] = "Khách sạn";
      $this->data['page'] = "hotel/index";
      $this->data['hotels']  = $hotels;
      $this->data['hotelTypes'] = $hotelTypes;
      $this->data['amenityCategories'] = $amenityCategories;

      $this->render("layouts/admin_layout", $this->data);
   }
   public function create()
   {
      if (!Request::isMethod("POST")) {
         Util::Redirect("dashboard/hotel", Response::methodNotAllowed("Phương thức khoogn được phép"));
      }
      $dataHotel = $this->prepareHotelData();
      $res = $this->HotelModel->insert($dataHotel);
      $idLastInsert = $this->HotelModel->getLastInsertId();
      if (!$res) {
         Util::redirect("dashboard/hotel", Response::internalServerError("Thêm không thành công"));
      }
      $checkInsertHotelImg = $this->processHotelImg($idLastInsert);
      if (!$checkInsertHotelImg['success']) {
         Util::redirect("dashboard/hotel", Response::internalServerError("Đã thêm tour thành công nhưng " . $checkInsertHotelImg['msg']));
      }
      Util::redirect('dashboard/hotel', Response::success("Thêm thành công"));
   }
   public function update($id)
   {

      $imgs = $this->HotelImageModel->where(["hotel_id" => $id]);
      $hotel = $this->HotelModel->find($id);
      $hotelTypes = $this->HotelTypeModel->all();

      $this->data['title'] = "Chỉnh sửa thông tin khách sạn";
      $this->data['page'] = "hotel/form";
      $this->data['hotelTypes'] = $hotelTypes;
      $this->data['hotel'] = $hotel;
      $this->data['imgs'] = $imgs;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost()
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/hotel", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $id = (int)(Request::input("id") ?? 0);
      $hotel = $this->HotelModel->find($id);
      if (!$hotel) {
         Util::redirect("dashboard/hotel", Response::notFound("Không tìm thấy hotel có id là " . $id));
      }
      $dataHotel = $this->prepareHotelData(true);

      $res = $this->HotelModel->update($dataHotel, $id);
      if (!$res) {
         Util::redirect("dashboard/hotel", Response::internalServerError("Cập nhật không thành công"));
      }

      if (
         isset($_FILES['image']['tmp_name'][0]) &&
         $_FILES['image']['error'][0] !== UPLOAD_ERR_NO_FILE
      ) {
         $checkInsertImg = $this->processHotelImg($id, true);
         if (!$checkInsertImg['success']) {
            Util::redirect("dashboard/hotel", Response::internalServerError("Cập nhật thành công nhưng " . $checkInsertImg['msg']));
         }
      }

      Util::redirect('dashboard/hotel', Response::success("Cập nhật thành công"));
   }
   public function delete()
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/hotel", Response::methodNotAllowed("Phương thức không được chấp nhận"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/hotel", Response::badRequest("ID không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id)) {
            Util::redirect("dashboard/hotel", Response::badRequest("ID không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $hotelImages = $this->HotelImageModel->where(["hotel_id" => $id]);
         Util::printArr($hotelImages);
         foreach ($hotelImages as $img) {
            $pathImg = _DIR_ROOT . $img["image"];
            $checkDeleteImg = Util::deleteImage($pathImg);

            if (!$checkDeleteImg['success']) {
               Util::redirect("dashboard/hotel", Response::badRequest($checkDeleteImg['msg']));
            }
            $this->HotelImageModel->delete($img['id']);
         }
         $this->HotelModel->delete($id);
      }
      Util::redirect('dashboard/hotel', Response::success("Xóa thành công"));
   }
   private function prepareHotelData($isUpdate = false): array
   {
      $name = htmlspecialchars(Request::input("name", ""));
      $slug = Util::generateSlug($name);
      $description = htmlspecialchars(Request::input("desc", ''));
      $hotel_type_id = Request::input("category", 0);
      $address = htmlspecialchars(Request::input("address", ""));
      $city = htmlspecialchars(Request::input("city", ""));
      $country = htmlspecialchars(Request::input("country", ""));
      $phone_number = htmlspecialchars(Request::input("phone_number", ""));
      $rating = htmlspecialchars(Request::input("rating", ""));
      $email = htmlspecialchars(Request::input("email", ""));
      $price_range = htmlspecialchars(Request::input("price_range", ""));

      $data = [
         "name" => $name,
         "slug" => $slug,
         "description" => $description,
         "hotel_type_id" => $hotel_type_id,
         "city" => $city,
         "address" => $address,
         "country" => $country,
         "phone_number" => $phone_number,
         "rating" => $rating,
         "email" => $email,
         "price_range" => $price_range
      ];
      if ($isUpdate) {
         $data = Util::removeEmptyValues($data);
      }
      return $data;
   }
   private function processHotelImg(int $id, $isUpdate = false): array
   {
      if ($isUpdate) {
         $tourImgs = $this->HotelImageModel->where(["hotel_id" => $id]);
         foreach ($tourImgs as $img) {
            $pathImg = _DIR_ROOT . $img["image"];
            $checkDeleteImg = Util::deleteImage($pathImg);
            if (!$checkDeleteImg['success']) {
               return ['success' => false, 'msg' => $checkDeleteImg['msg']];
            }
            $this->HotelImageModel->delete($img["id"]);
         }
      }
      $imgs = Request::file("image") ?? [];
      $pathAsset = '/public/uploads/hotel/';
      $files = Util::convertListImgToArr($imgs);

      foreach ($files as $file) {
         $data = ["hotel_id" => $id];
         $checkCreateImgPath = Util::createImagePath($file, $pathAsset);
         if (!$checkCreateImgPath['success']) {
            return ['success' => false, 'msg' => $checkCreateImgPath['msg']];
         }
         $newImgName = $checkCreateImgPath['name'];
         $data['image'] = $newImgName;
         $res = $this->HotelImageModel->insert($data);
         if (!$res) {
            return ['success' => false, 'msg' => "Cập nhật ảnh cho tour không thành công"];
         }
         $checkUploadImg = Util::uploadImage($file, $newImgName);
         if (!$checkUploadImg["success"]) {
            return ['success' => false, 'msg' => $checkUploadImg['msg']];
         }
      }
      return ["success" => true, "msg" => "Ok"];
   }
}
