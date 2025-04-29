<?php
class Hotel extends Controller
{
   private $data;
   private $HotelModel;
   private $HotelTypeModel;
   private $HotelImageModel;
   private $AmenityModel;
   private $AmenityCategoryModel;
   private $HotelAmenityModel;
   private $jwt;
   public function __construct()
   {
      $this->HotelModel = $this->model("HotelModel");
      $this->HotelTypeModel = $this->model("HotelTypeModel");
      $this->HotelImageModel = $this->model("HotelImageModel");
      $this->AmenityModel = $this->model("AmenityModel");
      $this->HotelAmenityModel = $this->model("HotelAmenityModel");
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

      if (!$res) {
         Util::redirect("dashboard/hotel", Response::internalServerError("Thêm không thành công"));
      }
      $idLastInsert = $this->HotelModel->getLastInsertId();

      $checkInsertHotelImg = $this->processHotelImg($idLastInsert);
      if (!$checkInsertHotelImg['success']) {
         $this->HotelModel->delete($idLastInsert);
         Util::redirect("dashboard/hotel", Response::internalServerError("Đã thêm hotel thành công nhưng " . $checkInsertHotelImg['msg']));
      }
      $checkProcessHotelAmenity = $this->processHotelAmenity($idLastInsert);
      if (!$checkProcessHotelAmenity['success']) {
         Util::redirect('dashboard/hotel', Response::internalServerError("Đã thêm hotel thành công nhưng " . $checkProcessHotelAmenity['msg']));
      }
      Util::redirect('dashboard/hotel', Response::success("Thêm thành công"));
   }
   public function update($id)
   {

      $imgs = $this->HotelImageModel->where(["hotel_id" => $id]);
      $hotel = $this->HotelModel->find($id);
      if (!$hotel) {
         Util::redirect("dashboard/hotel", Response::notFound("Không tìm thấy hotel có id là " . $id));
      }
      $hotelTypes = $this->HotelTypeModel->all();
      $this->HotelAmenityModel->setColOrderBy("hotel_id");
      $hotelAmenities = $this->HotelAmenityModel->getAmenitiesByHotelId($id);
      $amenityCategories = $this->AmenityCategoryModel->all();
      $this->data['title'] = "Chỉnh sửa thông tin khách sạn";
      $this->data['page'] = "hotel/form";
      $this->data['hotelTypes'] = $hotelTypes;
      $this->data['hotel'] = $hotel;
      $this->data['imgs'] = $imgs;
      $this->data['amenityCategories'] = $amenityCategories;
      $this->data['hotelAmenities'] = $hotelAmenities;
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

      $this->HotelModel->beginTransaction();

      try {
         $res = $this->HotelModel->update($dataHotel, $id);

         $updateHotelSuccess = $res ? true : false;
         $updateImageSuccess = false;
         $updateHotelAmenitySuccess = false;
         if (Request::input("selected_amenities") && Request::input("selected_amenities") !== "") {
            $checkProcessHotelAmenity = $this->processHotelAmenity($id, true);
            if (!$checkProcessHotelAmenity['success']) {
               $this->HotelModel->rollBack();
               throw new \Exception($checkProcessHotelAmenity['msg']);
            }
            $updateHotelAmenitySuccess = true;
         }
         if (isset($_FILES['image']['tmp_name'][0]) && $_FILES['image']['error'][0] !== UPLOAD_ERR_NO_FILE) {
            $checkInsertImg = $this->processHotelImg($id, true);
            if (!$checkInsertImg['success']) {
               $this->HotelModel->rollBack();
               throw new \Exception($checkInsertImg['msg']);
            }
            $updateImageSuccess = true;
         }

         if (!$updateHotelSuccess && !$updateImageSuccess && !$updateHotelAmenitySuccess) {
            $this->HotelModel->rollBack();
            throw new \Exception("Không có thay đổi nào để cập nhật");
         }

         $this->HotelModel->commit();

         Util::redirect('dashboard/hotel', Response::success("Cập nhật thành công"));
      } catch (\Exception $e) {
         $this->HotelModel->rollBack();
         Util::redirect("dashboard/hotel", Response::internalServerError("Có lỗi xảy ra: " . $e->getMessage()));
      }
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

      try {
         $this->HotelModel->beginTransaction();
         $this->HotelImageModel->beginTransaction();

         foreach ($listID as $id) {
            $hotelImages = $this->HotelImageModel->where(["hotel_id" => $id]);

            foreach ($hotelImages as $img) {
               $pathImg = _DIR_ROOT . $img["image"];
               $checkDeleteImg = Util::deleteImage($pathImg);

               if (!$checkDeleteImg['success']) {
                  $this->HotelImageModel->rollBack();
                  $this->HotelModel->rollBack();
                  Util::redirect("dashboard/hotel", Response::internalServerError("Xóa file ảnh thất bại: " . $checkDeleteImg['msg']));
               }

               $deleteImgRecord = $this->HotelImageModel->delete($img['id']);
               if (!$deleteImgRecord) {
                  $this->HotelImageModel->rollBack();
                  $this->HotelModel->rollBack();
                  Util::redirect("dashboard/hotel", Response::internalServerError("Xóa bản ghi ảnh thất bại"));
               }
            }

            $deleteHotel = $this->HotelModel->delete($id);
            if (!$deleteHotel) {
               $this->HotelImageModel->rollBack();
               $this->HotelModel->rollBack();
               Util::redirect("dashboard/hotel", Response::internalServerError("Xóa khách sạn thất bại"));
            }
         }

         $this->HotelImageModel->commit();
         $this->HotelModel->commit();

         Util::redirect('dashboard/hotel', Response::success("Xóa thành công"));
      } catch (\Exception $e) {
         $this->HotelImageModel->rollBack();
         $this->HotelModel->rollBack();
         Util::redirect("dashboard/hotel", Response::internalServerError("Có lỗi xảy ra: " . $e->getMessage()));
      }
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
   private function processHotelAmenity(int $hotelId, bool $isUpdate = false): array
   {
      $amenities = Request::input("selected_amenities", "");

      if (empty($amenities)) {
         return ['success' => true, 'msg' => "Không có tiện nghi nào được chọn."];
      }

      $amenityArray = array_filter(array_map('trim', explode(',', $amenities)));

      if ($isUpdate) {
         $deleteResult = $this->HotelAmenityModel->delete($hotelId, 'hotel_id');
         if ($deleteResult === false) {
            return ['success' => false, 'msg' => "Lỗi khi xóa các tiện nghi hiện có của khách sạn."];
         }
      }

      foreach ($amenityArray as $amenityId) {
         if (!is_numeric($amenityId)) {
            return ['success' => false, 'msg' => "ID tiện nghi không hợp lệ: " . $amenityId];
         }
         $dataHotelAmenity = [
            'hotel_id' => $hotelId,
            'amenity_id' => (int)$amenityId
         ];
         $checkInsertHotelAmenity = $this->HotelAmenityModel->insert($dataHotelAmenity);
         if (!$checkInsertHotelAmenity) {
            return ['success' => false, 'msg' => "Lỗi khi thêm tiện nghi có ID: " . $amenityId];
         }
      }

      return ['success' => true, 'msg' => "Cập nhật tiện nghi thành công."];
   }
}
