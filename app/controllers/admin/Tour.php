<?php
class Tour  extends Controller{
   private $data;
   private $TourModel;
   private $LocationModel;
   private $TourLocationModel;
   private $TourImgModel;
   private $TourPriceCalendarModel;
   private $CategoryModel;
   private $jwt;
   public function __construct(){
      $this->TourModel = $this->model("TourModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->TourLocationModel = $this->model("TourLocationModel");
      $this->TourImgModel = $this->model("TourImgModel");
      $this->TourPriceCalendarModel = $this->model("TourPriceCalendarModel");
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
   public function index() {
      $this->TourModel->setBaseModel();
      $totalPages =$this->TourModel->getTotalPages();
      $departures = $this->LocationModel->where(1, "is_departure");
      $destinations = $this->LocationModel->where(1, "is_destination");
      $categories = $this->CategoryModel->where(0, "parent_id");
      $tours = $this->TourModel->getTours();
      $this->data['totalPages'] = $totalPages;
      $this->data['page']= 'index';
      $this->data['title'] = "Quản lý Tour";
      $this->data['page'] ="tour/index";
      $this->data['tours'] = $tours;
      $this->data['destinations'] = $destinations;
      $this->data['departures'] = $departures;
      $this->data['categories'] = $categories;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create() {
      if(!Request::isMethod("POST")) {
         Util::Redirect("dashboard/tour", Response::methodNotAllowed("Phương thức khoogn được phép"));
      }
      $dataTour =$this->prepareTourData();

      $res = $this->TourModel->insert($dataTour);
      $idLastInsert = $this->TourModel->getLastInsertId();
      if (!$res) {
         Util::redirect("dashboard/tour", Response::internalServerError("Thêm không thành công"));
      }
      $dataPrice = $this->prepareTourPriceData();
      $checkInsertPrice = $this->processTourPrice($idLastInsert,$dataPrice);
      if(!$checkInsertPrice['success']) {
         Util::redirect("dashboard/tour", Response::internalServerError("Đã thêm tour thành công nhưng ".$checkInsertPrice['msg']));
      }
      $checkInsertTourImg = $this->processTourImg($idLastInsert);
      if(!$checkInsertPrice['success']) {
         Util::redirect("dashboard/tour", Response::internalServerError("Đã thêm tour thành công nhưng ".$checkInsertTourImg['msg']));
      }
      Util::redirect('dashboard/tour',Response::success("Thêm thành công"));
   }


   public function update($id) {
      Util::setBaseModel($this->TourModel);
      $locations = $this->LocationModel->all();
      $categories = $this->CategoryModel->where(0, "parent_id");
      $imgs = $this->TourImgModel->where($id, "tour_id");
      $tour = $this->TourModel->find($id);
      $this->data['title'] = "Chỉnh sửa Tour";
      $this->data['page'] ="tour/form";
      $this->data['tour'] = $tour;
      $this->data['locations'] = $locations;
      $this->data['categories'] = $categories;
      $this->data['imgs'] = $imgs;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost() {
      if(!Request::isMethod("POST")) {
         Util::redirect("dashboard/tour", Response::methodNotAllowed("Phương thức không được chấp nhận"));
      }
      $id = (int)(Request::input("id") ?? 0);
      $tour = $this->TourModel->find($id);
      if (!$tour) {
         Util::redirect("dashboard/tour", Response::notFound("Không tìm thấy tour có id là ".$id));
      }
      $dataTour =$this->prepareTourData();
      $res = $this->TourModel->update($dataTour, $id);
      if(!$res) {
         Util::redirect("dashboard/tour", Response::internalServerError("Cập nhật không thành công"));
      }

      if(!empty(Request::input("date")[0]) && !empty(Request::input("price_adult")[0]) &&
         !empty(Request::input("price_baby")[0]) && !empty(Request::input("price_children")[0])) {
         $dataPrice = $this->prepareTourPriceData();
         $checkInsertPrice = $this->processTourPrice($id,$dataPrice, true);
         if(!$checkInsertPrice['success']) {
            Util::redirect("dashboard/tour", Response::internalServerError("Cập nhật thành công nhưng ".$checkInsertPrice['msg']));
         }
      }

      if(isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
         $checkInsertImg = $this->processTourImg($id, true);
         if(!$checkInsertImg['success']) {
            Util::redirect("dashboard/tour", Response::internalServerError("Cập nhật thành công nhưng ".$checkInsertImg['msg']));
         }
      }
      Util::redirect('dashboard/tour',Response::success("Cập nhật thành công"));
   }
   public function delete() {
      if(!Request::isMethod("POST")) {
         Util::redirect("dashboard/tour", Response::methodNotAllowed("Phương thức không được chấp nhận"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/tour", Response::badRequest("ID không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/tour", Response::badRequest("ID không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $tourImgs = $this->TourImgModel->where($id, "tour_id");
         var_dump($tourImgs);
         foreach ($tourImgs as $img) {
            $pathImg = _DIR_ROOT.$img["image"];
            $checkDeleteImg = Util::deleteImage($pathImg);
            if(!$checkDeleteImg['success']) {
               Util::redirect("dashboard/tour",Response::badRequest($checkDeleteImg['msg']));
            }
         }
         $this->TourModel->delete($id);
      }
      Util::redirect('dashboard/tour',Response::success("Xóa thành công"));
   }

   private function prepareTourData($isUpdate = false): array
   {
      $name = htmlspecialchars(Request::input("name")) ?? "";
      $code = htmlspecialchars(Request::input("code_tour")) ?? "";
      $slug = htmlspecialchars(Request::input("slug")) ?? "";
      $slug = Util::generateSlug($slug);
      $duration = htmlspecialchars(Request::input("duration")) ?? "";
      $description = htmlspecialchars(Request::input("desc")) ?? "";
      $status = htmlspecialchars(Request::input("status")) ?? "";
      $status = $this->getStatus($status);
      $statusHot = htmlspecialchars(Request::input("status_hot")) ? 1 : 0;
      $category = Request::input("category")?? 0;
      $departure = htmlspecialchars(Request::input("departure")) ?? "";
      $destination = htmlspecialchars(Request::input("destination")) ?? "";

      $data = [
         "name" => $name,
         "slug" => $slug,
         "duration" => $duration,
         "description" => $description,
         "category_id" => $category,
         "status" => $status,
         "status_hot" => $statusHot,
         "code_tour" => $code,
         "departure_id"=>$departure,
         "destination_id"=>$destination,
      ];
      if($isUpdate) {
         $data = Util::removeEmptyValues($data);
      }
      return $data;
   }
   private function prepareTourPriceData($isUpdate = false): array
   {
      $date =Request::input("date")?? [];
      $priceAdult = Request::input("price_adult") ?? [];
      $priceChildren = Request::input("price_children") ?? [];
      $priceBaby = Request::input("price_baby") ?? [];
      $data = [
         "date" => $date,
         "priceAdult" => $priceAdult,
         "priceChildren" => $priceChildren,
         "priceBaby" => $priceBaby,
      ];
      if($isUpdate) {
         $data = Util::removeEmptyValues($data);
      }
      return $data;
   }
   private function processTourImg(int $id, $isUpdate = false): array
   {
      if($isUpdate) {
         $tourImgs = $this->TourImgModel->where($id, "tour_id");
         foreach ($tourImgs as $img) {
            $pathImg = _DIR_ROOT.$img["image"];
            $checkDeleteImg = Util::deleteImage($pathImg);
            if(!$checkDeleteImg['success']) {
               return ['success' => false, 'msg' => $checkDeleteImg['msg']];
            }
            $this->TourImgModel->delete($img["id"]);
         }
      }
      $imgs = Request::file("image")?? [];
      $pathAsset = '/public/uploads/tour/';
      $files = $this->convertListImgToArr($imgs);

      foreach ($files as $file) {
         $data = ["tour_id" => $id];
         $checkCreateImgPath = Util::createImagePath($file, $pathAsset);
         if(!$checkCreateImgPath['success']) {
            return ['success' => false, 'msg' => $checkCreateImgPath['msg']];
         }
         $newImgName = $checkCreateImgPath['name'];
         $data['image'] = $newImgName;
         $res = $this->TourImgModel->insert($data);
         if(!$res) {
            return ['success' => false, 'msg' =>"Cập nhật ảnh cho tour không thành công"];
         }
         $checkUploadImg = Util::uploadImage($file, $newImgName);
         if(!$checkUploadImg["success"]) {
            return ['success' => false, 'msg' =>$checkUploadImg['msg']];
         }
      }
      return ["success" => true, "msg" => "Ok"];
   }
   private function processTourPrice($id, $dataPrice, $isUpdate = false): array
   {
      if($isUpdate) {
         $listPrice = $this->TourPriceCalendarModel->where($id, "tour_id");
         foreach ($listPrice as $price) {
            $this->TourPriceCalendarModel->delete($price["id"]);
         }
      }
      $list = $this->convertListPriceDateToArr($dataPrice['date'], $dataPrice['priceAdult'], $dataPrice['priceChildren'],$dataPrice['priceBaby']);
      foreach ($list as $item) {
         $item["tour_id"] = $id;
         $res = $this->TourPriceCalendarModel->insert($item);
         if(!$res) {
            return ['success' => false, "msg" => "Thêm không thành công giá của tour"];
         }
      }
      return ['success' => true, "msg" => "Thêm thành công giá của tour"];
   }

   private function convertListPriceDateToArr($date, $priceAdult, $priceChildren, $priceBaby) : array
   {
      $datas = [];
      for($i = 0; $i < count($priceAdult); $i++) {
         $arrDate = explode(",", trim($date[$i], ","));
         for($j = 0; $j < count($arrDate); $j++) {
            $item = [];
            $item["adult_price"] = (float)$priceAdult[$i];
            $item["child_price"] = (float)$priceChildren[$i];
            $item["infant_price"] = (float)$priceBaby[$i];
            $item['date'] = $arrDate[$j];
            array_push($datas, $item);
         }
      }
      return $datas ?? [];
   }
   private function convertListImgToArr(array $arr):array {
      $files = [];
      for ($i = 0; $i < count($arr['name']); $i++) {
         $files[] = [
            'name' => $arr['name'][$i],
            'type' => $arr['type'][$i],
            'tmp_name' => $arr['tmp_name'][$i],
            'error' => $arr['error'][$i],
            'size' => $arr['size'][$i]
         ];
      }
      return $files;
   }
   private function getStatus($status): string {
      return match ($status) {
         "2" => "active",
         "1" => "inactive",
         default => "draft"
      };
   }
}
